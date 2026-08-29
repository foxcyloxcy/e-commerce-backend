<?php

namespace App\Services;

use App\Models\Item;
use App\Models\MigrationCampaign;
use App\Models\MigrationCase;
use App\Models\MigrationItem;
use App\Models\MigrationProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

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
        return DB::transaction(function () use ($user) {
            $campaign = $this->activeCampaign();
            $vendorId = DB::table('vendors')->where('user_id', $user->id)->value('id');
            $now = now();

            $case = MigrationCase::firstOrCreate(
                ['campaign_id' => $campaign->id, 'source_user_id' => $user->id],
                [
                    'source_vendor_id' => $vendorId,
                    'status' => MigrationCase::STATUS_IN_PROGRESS,
                    'started_at' => $now,
                    'last_activity_at' => $now,
                ]
            );

            if (!$case->submitted_at) {
                $case->fill([
                    'source_vendor_id' => $vendorId,
                    'status' => $case->status === MigrationCase::STATUS_PENDING ? MigrationCase::STATUS_IN_PROGRESS : $case->status,
                    'started_at' => $case->started_at ?: $now,
                    'last_activity_at' => $now,
                ])->save();
            }

            // Repair older/incomplete cases independently of case status. firstOrCreate
            // preserves an existing migration draft and never writes back to Reloved.
            $this->ensureProfileSnapshot($case, $user);
            $this->ensureItemSnapshots($case, $user, $vendorId);

            return $case->fresh(['campaign', 'profile', 'items']);
        });
    }

    public function touch(MigrationCase $case): void
    {
        if (!$case->submitted_at) {
            $case->update(['last_activity_at' => now()]);
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
        MigrationProfile::firstOrCreate(
            ['migration_case_id' => $case->id],
            [
                'source_user_id' => $user->id,
                'first_name' => $user->first_name,
                'last_name' => $user->last_name,
                'email' => $user->email,
                'mobile_number' => $user->mobile_number,
                'address' => $user->address,
                'gender' => $user->gender,
                'date_of_birth' => $user->date_of_birth,
                'source_snapshot' => $this->userSourceSnapshot($user),
                'source_updated_at' => $user->updated_at,
                'snapshot_at' => now(),
            ]
        );
    }

    private function ensureItemSnapshots(MigrationCase $case, User $user, ?int $vendorId): void
    {
        $items = Item::withTrashed()->where('user_id', $user->id)->get();

        foreach ($items as $item) {
            if (MigrationItem::where('migration_case_id', $case->id)->where('source_item_id', $item->id)->exists()) {
                continue;
            }

            $eligibility = $this->eligibilityService->evaluate($item);
            $categoryId = $this->eligibilityService->categoryIdFor($item);

            MigrationItem::firstOrCreate([
                'migration_case_id' => $case->id,
                'source_item_id' => $item->id,
            ], [
                'source_user_id' => $user->id,
                'source_vendor_id' => $vendorId,
                'source_category_id' => $categoryId,
                'source_sub_category_id' => $item->sub_category_id,
                'source_status' => $item->status,
                'eligible' => $eligibility['eligible'],
                'eligibility_reason' => $eligibility['reason'],
                'selected' => false,
                'source_snapshot' => $this->itemSourceSnapshot($item, $categoryId),
                'source_updated_at' => $item->updated_at,
                'snapshot_at' => now(),
            ]);
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
