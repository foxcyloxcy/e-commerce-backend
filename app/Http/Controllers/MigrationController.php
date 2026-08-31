<?php

namespace App\Http\Controllers;

use App\Http\Requests\Migration\SubmitMigrationDecisionRequest;
use App\Http\Requests\Migration\UpdateMigrationItemsRequest;
use App\Http\Requests\Migration\UpdateMigrationProfileRequest;
use App\Models\Item;
use App\Models\MigrationCase;
use App\Models\MigrationConsentVersion;
use App\Models\MigrationDecisionAudit;
use App\Models\MigrationProfile;
use App\Services\MigrationCaseService;
use App\Services\TaggyMigrationEligibilityService;
use App\Services\TaggyMigrationExportValidator;
use App\Services\TaggyMigrationMapper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class MigrationController extends Controller
{
    public function __construct(
        private MigrationCaseService $caseService,
        private TaggyMigrationEligibilityService $eligibilityService,
        private TaggyMigrationMapper $taggyMapper,
        private TaggyMigrationExportValidator $exportValidator
    ) {
    }

    public function show(Request $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user());

        return response(['data' => $this->casePayload($case)], 200);
    }

    public function profile(Request $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user());
        $this->caseService->touch($case);
        if ($this->caseService->isDraft($case)) {
            $this->taggyMapper->prepareProfile($this->migrationProfile($case));
        }

        return response(['data' => $this->profilePayload($case->fresh('profile'))], 200);
    }

    public function updateProfile(UpdateMigrationProfileRequest $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user());

        if (!$this->caseService->isDraft($case)) {
            return response(['message' => 'Your migration preference has already been finalized and is locked.'], 409);
        }

        $profile = $this->migrationProfile($case);
        $profile->update($request->validated());
        $this->taggyMapper->prepareProfile($profile->fresh());
        $this->caseService->touch($case);

        return response(['data' => $this->profilePayload($case->fresh('profile')), 'message' => 'Migration profile draft saved.'], 200);
    }

    public function items(Request $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user());
        $this->caseService->touch($case);
        if ($this->caseService->isDraft($case)) {
            foreach ($case->items as $item) {
                $this->taggyMapper->prepareItem($item);
            }
        }

        return response(['data' => $this->itemsPayload($case->fresh())], 200);
    }

    public function updateItems(UpdateMigrationItemsRequest $request)
    {
        $user = auth('auth-api')->user();
        $case = $this->caseService->ensureCaseFor($user);

        if (!$this->caseService->isDraft($case)) {
            return response(['message' => 'Your migration preference has already been finalized and is locked.'], 409);
        }

        $selectedIds = collect($request->validated()['selected_item_ids'])->map(fn ($id) => (int) $id)->unique()->values();

        $validSelectedCount = DB::transaction(function () use ($case, $user, $selectedIds) {
            $migrationItems = $case->items()->get();
            $migrationItemIds = $migrationItems->pluck('source_item_id')->map(fn ($id) => (int) $id);

            $invalidIds = $selectedIds->diff($migrationItemIds);
            if ($invalidIds->isNotEmpty()) {
                abort(response(['message' => 'One or more selected listings do not belong to the authenticated user.'], 422));
            }

            $eligibleIds = $migrationItems->where('eligible', true)->pluck('source_item_id')->map(fn ($id) => (int) $id);
            $unsupportedIds = $selectedIds->diff($eligibleIds);
            if ($unsupportedIds->isNotEmpty()) {
                abort(response(['message' => 'Unsupported listings cannot be selected for Taggy migration.'], 422));
            }

            $case->items()->update(['selected' => false]);
            if ($selectedIds->isNotEmpty()) {
                $case->items()->whereIn('source_item_id', $selectedIds)->where('eligible', true)->where('source_user_id', $user->id)->update(['selected' => true]);
            }
            $this->caseService->touch($case);
            foreach ($case->items()->get() as $migrationItem) {
                $this->taggyMapper->prepareItem($migrationItem);
            }

            return $selectedIds->count();
        });

        return response(['data' => ['selected_item_count' => $validSelectedCount, 'items' => $this->itemsPayload($case->fresh())], 'message' => 'Listing selection draft saved.'], 200);
    }

    public function consent(Request $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user());
        $this->caseService->touch($case);

        return response(['data' => [
            'case' => $this->casePayload($case),
            'consent_versions' => MigrationConsentVersion::where('active', true)->get(),
        ]], 200);
    }

    public function submitDecision(SubmitMigrationDecisionRequest $request)
    {
        $user = auth('auth-api')->user();
        $decision = $request->validated()['decision'];

        $case = DB::transaction(function () use ($user, $decision) {
            $case = $this->caseService->ensureCaseFor($user)->fresh(['campaign', 'profile', 'items']);

            if ($case->submitted_at) {
                return $case;
            }

            if (!$this->caseService->isDraft($case)) {
                abort(response(['message' => 'This migration case is finalized and cannot be changed.'], 409));
            }

            if ($case->campaign->response_deadline && $case->campaign->response_deadline->isPast()) {
                abort(response(['message' => 'The migration response deadline has passed.'], 422));
            }

            if (in_array($decision, [
                MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
                MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY,
            ], true)) {
                $this->validateRequiredMigrationProfile($case);
            }

            $this->taggyMapper->prepareCase($case);

            $consentType = $this->consentTypeForDecision($decision);
            $consentVersion = MigrationConsentVersion::where('active', true)->where('consent_type', $consentType)->orderByDesc('id')->first();
            if (!$consentVersion) {
                abort(response(['message' => 'No active consent wording version is configured for this decision.'], 422));
            }

            if ($decision === MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS) {
                $this->validateSelectedItemsStillAllowed($case, $user->id);
                $selectedIds = $case->items()->where('selected', true)->where('eligible', true)->pluck('source_item_id')->map(fn ($id) => (int) $id)->values();
                if ($selectedIds->isEmpty()) {
                    abort(response(['message' => 'Please select at least one eligible listing, or choose account-only migration.'], 422));
                }
                $selectedCount = $selectedIds->count();
            } else {
                if ($decision === MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY) {
                    $case->items()->update(['selected' => false]);
                }
                $selectedIds = collect();
                $selectedCount = 0;
            }

            $now = now();
            $case->update([
                'status' => $decision,
                'submitted_at' => $now,
                'last_activity_at' => $now,
            ]);

            MigrationDecisionAudit::create([
                'migration_case_id' => $case->id,
                'source_user_id' => $user->id,
                'campaign_id' => $case->campaign_id,
                'decision' => $decision,
                'consent_version_id' => $consentVersion->id,
                'consent_version' => $consentVersion->version,
                'consent_content_hash' => $consentVersion->content_hash,
                'selected_item_count' => $selectedCount,
                'selected_source_item_ids' => $selectedIds->all(),
                'campaign_deadline' => $case->campaign->response_deadline,
                'submitted_at' => $now,
                'created_at' => $now,
            ]);

            return $case->fresh(['campaign', 'profile', 'items', 'audits']);
        });

        return response(['data' => $this->confirmationPayload($case), 'message' => 'Your migration preference has been saved.'], 200);
    }

    public function confirmation(Request $request)
    {
        $case = $this->caseService->ensureCaseFor(auth('auth-api')->user())->fresh(['campaign', 'profile', 'items', 'audits']);

        if (!$case->submitted_at) {
            return response(['message' => 'No submitted migration preference was found.'], 404);
        }

        return response(['data' => $this->confirmationPayload($case)], 200);
    }

    private function validateSelectedItemsStillAllowed(MigrationCase $case, int $userId): void
    {
        $selected = $case->items()->where('selected', true)->get();

        foreach ($selected as $migrationItem) {
            $item = Item::withTrashed()->where('id', $migrationItem->source_item_id)->where('user_id', $userId)->first();
            if (!$item) {
                abort(response(['message' => 'One or more selected listings no longer belongs to the authenticated user.'], 422));
            }

            $eligibility = $this->eligibilityService->evaluate($item);
            if (!$migrationItem->eligible || !$eligibility['eligible']) {
                abort(response(['message' => 'Unsupported listings cannot be submitted for Taggy migration.'], 422));
            }
        }
    }

    private function validateRequiredMigrationProfile(MigrationCase $case): void
    {
        $profile = $this->migrationProfile($case);

        Validator::make($profile->only(['address', 'date_of_birth']), [
            'address' => 'required|string|max:2000',
            'date_of_birth' => 'required|date',
        ], [
            'address.required' => 'Address is required before agreeing to migrate.',
            'date_of_birth.required' => 'Date of birth is required before agreeing to migrate.',
        ])->validate();
    }

    private function consentTypeForDecision(string $decision): string
    {
        return match ($decision) {
            MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS => 'ACCOUNT_AND_ITEMS',
            MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY => 'ACCOUNT_ONLY',
            MigrationCase::STATUS_DECLINED_KEEP_RELOVED => 'DECLINE_KEEP',
            MigrationCase::STATUS_DELETE_REQUESTED => 'DELETE_REQUEST',
        };
    }

    private function casePayload(MigrationCase $case): array
    {
        $case->loadMissing(['campaign', 'profile', 'items', 'audits']);

        return [
            'id' => $case->id,
            'campaign_id' => $case->campaign_id,
            'source_user_id' => $case->source_user_id,
            'source_vendor_id' => $case->source_vendor_id,
            'status' => $case->status,
            'derived_status' => $case->derived_status,
            'started_at' => optional($case->started_at)->toISOString(),
            'last_activity_at' => optional($case->last_activity_at)->toISOString(),
            'submitted_at' => optional($case->submitted_at)->toISOString(),
            'response_deadline' => optional($case->campaign?->response_deadline)->toISOString(),
            'selected_item_count' => $case->items->where('selected', true)->where('eligible', true)->count(),
            'audit_count' => $case->audits->count(),
            'export_validation' => $case->submitted_at ? $this->exportValidator->validateCase($case) : null,
        ];
    }

    private function profilePayload(MigrationCase $case): array
    {
        $profile = $this->migrationProfile($case);

        return [
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'email' => $profile->email,
            'mobile_number' => $profile->mobile_number,
            'address' => $profile->address,
            'gender' => $profile->gender,
            'date_of_birth' => optional($profile->date_of_birth)->format('Y-m-d'),
            'member_since' => data_get($profile->source_snapshot, 'created_at'),
            'source_user_id' => $profile->source_user_id,
            'source_updated_at' => optional($profile->source_updated_at)->toISOString(),
            'snapshot_at' => optional($profile->snapshot_at)->toISOString(),
            'mapping_status' => $profile->mapping_status,
            'mapping_errors' => $profile->mapping_errors ?: [],
        ];
    }

    private function migrationProfile(MigrationCase $case): MigrationProfile
    {
        $case->loadMissing('profile');

        if (!$case->profile) {
            Log::error('Migration profile relation missing after initialization.', [
                'migration_case_id' => $case->id,
                'user_id' => $case->source_user_id,
            ]);

            abort(response([
                'message' => 'The migration profile could not be initialized for this account.',
                'code' => 'MIGRATION_SNAPSHOT_INTEGRITY_ERROR',
            ], 409));
        }

        return $case->profile;
    }

    private function itemsPayload(MigrationCase $case): array
    {
        $currentSourceItemIds = Item::where('user_id', $case->source_user_id)
            ->where('status', Item::STATUS_PUBLISHED)
            ->pluck('id');

        return $case->items()
            ->whereIn('source_item_id', $currentSourceItemIds)
            ->orderBy('eligible', 'desc')
            ->orderBy('source_item_id')
            ->get()
            ->map(function ($migrationItem) {
                $snapshot = $migrationItem->source_snapshot ?: [];
                $properties = collect(data_get($snapshot, 'properties', []));
                $images = collect(data_get($snapshot, 'images', []));

                return [
                    'source_item_id' => $migrationItem->source_item_id,
                    'source_user_id' => $migrationItem->source_user_id,
                    'source_vendor_id' => $migrationItem->source_vendor_id,
                    'source_category_id' => $migrationItem->source_category_id,
                    'source_sub_category_id' => $migrationItem->source_sub_category_id,
                    'source_status' => $migrationItem->source_status,
                    'status_name' => Item::STATUSES[Item::STATUS_PUBLISHED],
                    'active' => true,
                    'eligible' => $migrationItem->eligible,
                    'eligibility_reason' => $migrationItem->eligibility_reason,
                    'selected' => $migrationItem->selected,
                    'item_name' => data_get($snapshot, 'item_name'),
                    'price' => data_get($snapshot, 'price'),
                    'thumbnail_url' => data_get($images->first(), 'image_url'),
                    'size' => data_get($properties->firstWhere('property_name', 'Size'), 'value_name'),
                    'condition' => data_get($properties->firstWhere('property_name', 'Condition'), 'value_name'),
                    'source_updated_at' => optional($migrationItem->source_updated_at)->toISOString(),
                    'snapshot_at' => optional($migrationItem->snapshot_at)->toISOString(),
                    'mapping_status' => $migrationItem->mapping_status,
                    'mapping_errors' => $migrationItem->mapping_errors ?: [],
                ];
            })->values()->all();
    }

    private function confirmationPayload(MigrationCase $case): array
    {
        $case->loadMissing('audits');
        $audit = $case->audits()->orderByDesc('id')->first();

        return [
            'case' => $this->casePayload($case),
            'decision' => $case->status,
            'selected_item_count' => $audit?->selected_item_count ?? 0,
            'selected_source_item_ids' => $audit?->selected_source_item_ids ?? [],
            'submitted_at' => optional($case->submitted_at)->toISOString(),
            'consent_version_id' => $audit?->consent_version_id,
            'consent_version' => $audit?->consent_version,
            'consent_content_hash' => $audit?->consent_content_hash,
        ];
    }
}
