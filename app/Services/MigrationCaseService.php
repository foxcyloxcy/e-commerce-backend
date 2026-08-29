<?php

namespace App\Services;

use App\Models\Item;
use App\Models\MigrationCampaign;
use App\Models\MigrationCase;
use App\Models\MigrationItem;
use App\Models\MigrationProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MigrationCaseService
{
    public function __construct(private TaggyMigrationEligibilityService $eligibilityService)
    {
    }

    public function activeCampaign(): MigrationCampaign
    {
        $campaign = MigrationCampaign::where('active', true)->orderByDesc('id')->first();

        $deadline = Carbon::parse(config('taggy_migration.response_deadline'))->utc();

        if (!$campaign) {
            $campaign = MigrationCampaign::create([
                'name' => 'Reloved to Taggy',
                'response_deadline' => $deadline,
                'active' => true,
            ]);
        } elseif (!$campaign->response_deadline) {
            $campaign->update(['response_deadline' => $deadline]);
        }

        return $campaign;
    }

    public function ensureCaseFor(User $user): MigrationCase
    {
        $campaign = $this->activeCampaign();
        $vendorId = DB::table('vendors')->where('user_id', $user->id)->value('id');
        $case = $this->resolveOrCreateCase($campaign, $user, $vendorId);

        return DB::transaction(function () use ($case, $user, $vendorId) {
            // Serialize draft snapshot initialization for this one canonical case.
            // This locking read also avoids a stale repeatable-read snapshot after
            // waiting for another request to finish initialization.
            $lockedCase = MigrationCase::whereKey($case->id)->lockForUpdate()->first();
            if (!$lockedCase) {
                abort(response([
                    'message' => 'The migration case could not be resolved for this account.',
                    'code' => 'MIGRATION_CASE_INITIALIZATION_ERROR',
                ], 409));
            }

            if ($this->isDraft($lockedCase)) {
                $this->ensureProfileSnapshot($lockedCase, $user);
                $this->ensureItemSnapshots($lockedCase, $user, $vendorId);
            }

            $lockedCase = $lockedCase->fresh(['campaign', 'profile', 'items', 'audits']);
            $this->assertSnapshotIntegrity($lockedCase, $user);

            return $lockedCase;
        });
    }

    private function resolveOrCreateCase(MigrationCampaign $campaign, User $user, ?int $vendorId): MigrationCase
    {
        $case = MigrationCase::where('campaign_id', $campaign->id)
            ->where('source_user_id', $user->id)
            ->first();

        if ($case) {
            return $case;
        }

        $now = now();
        try {
            return MigrationCase::create([
                'campaign_id' => $campaign->id,
                'source_user_id' => $user->id,
                'source_vendor_id' => $vendorId,
                'status' => MigrationCase::STATUS_IN_PROGRESS,
                'started_at' => $now,
                'last_activity_at' => $now,
            ]);
        } catch (QueryException $exception) {
            if (!$this->isMigrationCaseUniqueConflict($exception)) {
                throw $exception;
            }

            // A duplicate insert returns only after the winning transaction releases
            // its unique-key lock. Retry briefly in case visibility lags that commit.
            for ($attempt = 0; $attempt < 3; $attempt++) {
                $case = MigrationCase::where('campaign_id', $campaign->id)
                    ->where('source_user_id', $user->id)
                    ->lockForUpdate()
                    ->first();

                if ($case) {
                    return $case;
                }

                if ($attempt < 2) {
                    usleep(20000);
                }
            }

            throw $exception;
        }
    }

    private function isMigrationCaseUniqueConflict(QueryException $exception): bool
    {
        return (int) ($exception->errorInfo[1] ?? 0) === 1062
            && str_contains($exception->getMessage(), 'migration_cases_campaign_user_unique');
    }

    public function isDraft(MigrationCase $case): bool
    {
        return !$case->submitted_at
            && in_array($case->status, [MigrationCase::STATUS_PENDING, MigrationCase::STATUS_IN_PROGRESS], true)
            && $case->derived_status !== MigrationCase::STATUS_NO_RESPONSE;
    }

    public function touch(MigrationCase $case): void
    {
        if ($this->isDraft($case)) {
            $case->update(['last_activity_at' => now()]);
        }
    }

    private function assertSnapshotIntegrity(MigrationCase $case, User $user): void
    {
        $errors = [];

        if (!$case->profile) {
            $errors[] = 'migration_profile_missing';
        } elseif ((int) $case->profile->source_user_id !== (int) $user->id
            || (int) data_get($case->profile->source_snapshot, 'id') !== (int) $user->id) {
            $errors[] = 'migration_profile_owner_mismatch';
        } elseif (!$this->isDraft($case) && empty($case->profile->source_snapshot)) {
            $errors[] = 'migration_profile_source_snapshot_missing';
        }

        if ($case->items->contains(fn (MigrationItem $item) =>
            (int) $item->source_user_id !== (int) $user->id
            || (int) data_get($item->source_snapshot, 'user_id') !== (int) $user->id
        )) {
            $errors[] = 'migration_item_owner_mismatch';
        }

        if (!$this->isDraft($case)) {
            if ($case->items->contains(fn (MigrationItem $item) => empty($item->source_snapshot))) {
                $errors[] = 'migration_item_source_snapshot_missing';
            }

            $snapshotCutoff = $case->submitted_at ?: $case->campaign?->response_deadline;
            if ($snapshotCutoff) {
                $expectedItemIds = Item::withTrashed()
                    ->where('user_id', $user->id)
                    ->where('created_at', '<=', $snapshotCutoff)
                    ->pluck('id')
                    ->map(fn ($id) => (int) $id);
                $storedItemIds = $case->items->pluck('source_item_id')->map(fn ($id) => (int) $id);

                if ($expectedItemIds->diff($storedItemIds)->isNotEmpty()) {
                    $errors[] = 'migration_item_snapshots_missing';
                }
            }
        }

        if ($errors) {
            Log::error('Migration snapshot integrity check failed.', [
                'migration_case_id' => $case->id,
                'user_id' => $user->id,
                'errors' => $errors,
            ]);

            abort(response([
                'message' => 'The stored migration snapshot is incomplete or does not belong to this account.',
                'code' => 'MIGRATION_SNAPSHOT_INTEGRITY_ERROR',
            ], 409));
        }
    }

    private function userSourceSnapshot(User $user): array
    {
        return [
            'id' => $user->id,
            'uuid' => $user->uuid,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile_number' => $user->mobile_number,
            'address' => $user->address,
            'photo' => $user->photo,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth,
            'status' => $user->status,
            'created_at' => optional($user->created_at)->toISOString(),
            'updated_at' => optional($user->updated_at)->toISOString(),
        ];
    }

    private function ensureProfileSnapshot(MigrationCase $case, User $user): void
    {
        if (MigrationProfile::where('migration_case_id', $case->id)->exists()) {
            return;
        }

        $now = now();
        DB::table('migration_profiles')->insert([
            'migration_case_id' => $case->id,
            'source_user_id' => $user->id,
            'first_name' => $user->first_name,
            'last_name' => $user->last_name,
            'email' => $user->email,
            'mobile_number' => $user->mobile_number,
            'address' => $user->address,
            'gender' => $user->gender,
            'date_of_birth' => $user->date_of_birth,
            'source_snapshot' => json_encode($this->userSourceSnapshot($user), JSON_THROW_ON_ERROR),
            'source_updated_at' => $user->updated_at,
            'snapshot_at' => $now,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

    private function ensureItemSnapshots(MigrationCase $case, User $user, ?int $vendorId): void
    {
        $existingItemIds = MigrationItem::where('migration_case_id', $case->id)
            ->pluck('source_item_id')
            ->map(fn ($id) => (int) $id)
            ->all();
        $items = Item::withTrashed()
            ->where('user_id', $user->id)
            ->whereNotIn('id', $existingItemIds)
            ->get();
        $now = now();
        $rows = [];

        foreach ($items as $item) {
            $eligibility = $this->eligibilityService->evaluate($item);
            $categoryId = $this->eligibilityService->categoryIdFor($item);
            $rows[] = [
                'migration_case_id' => $case->id,
                'source_user_id' => $user->id,
                'source_vendor_id' => $vendorId,
                'source_item_id' => $item->id,
                'source_category_id' => $categoryId,
                'source_sub_category_id' => $item->sub_category_id,
                'source_status' => $item->status,
                'eligible' => $eligibility['eligible'],
                'eligibility_reason' => $eligibility['reason'],
                'selected' => false,
                'source_snapshot' => json_encode($this->itemSourceSnapshot($item, $categoryId), JSON_THROW_ON_ERROR),
                'source_updated_at' => $item->updated_at,
                'snapshot_at' => $now,
                'created_at' => $now,
                'updated_at' => $now,
            ];
        }

        if ($rows) {
            DB::table('migration_items')->insert($rows);
        }
    }

    public function itemSourceSnapshot(Item $item, ?int $categoryId = null): array
    {
        $images = DB::table('item_images')->where('item_id', $item->id)->get(['id', 'item_id', 'image_url', 'status', 'created_at', 'updated_at']);
        $properties = DB::table('item_properties')
            ->join('sub_category_property_values', 'item_properties.sub_property_value_id', '=', 'sub_category_property_values.id')
            ->join('sub_category_properties', 'sub_category_property_values.sub_category_property_id', '=', 'sub_category_properties.id')
            ->where('item_properties.item_id', $item->id)
            ->get([
                'item_properties.id as item_property_id',
                'sub_category_properties.id as property_id',
                'sub_category_properties.name as property_name',
                'sub_category_property_values.id as value_id',
                'sub_category_property_values.name as value_name',
            ]);

        return [
            'id' => $item->id,
            'uuid' => $item->uuid,
            'user_id' => $item->user_id,
            'category_id' => $categoryId,
            'sub_category_id' => $item->sub_category_id,
            'item_name' => $item->item_name,
            'item_description' => $item->item_description,
            'price' => $item->price,
            'address' => $item->address,
            'status' => $item->status,
            'status_name' => Item::STATUSES[$item->status] ?? '',
            'is_bid' => $item->is_bid,
            'is_featured' => $item->is_featured,
            'deleted_at' => optional($item->deleted_at)->toISOString(),
            'created_at' => optional($item->created_at)->toISOString(),
            'updated_at' => optional($item->updated_at)->toISOString(),
            'images' => $images->map(fn ($image) => (array) $image)->values()->all(),
            'properties' => $properties->map(fn ($property) => (array) $property)->values()->all(),
        ];
    }
}
