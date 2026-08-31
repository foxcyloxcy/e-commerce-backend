<?php

namespace App\Http\Controllers;

use App\Models\MigrationCase;
use App\Models\MigrationDecisionAudit;
use App\Models\MigrationItem;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminMigrationController extends Controller
{
    private const CONSENTED_DECISIONS = [
        MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
        MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY,
    ];

    public function index(Request $request)
    {
        $size = max(1, min((int) ($request->size ?: 10), 100));
        $query = $this->consentedCasesQuery()->with([
            'profile',
            'audits' => fn ($auditQuery) => $auditQuery
                ->whereIn('decision', self::CONSENTED_DECISIONS)
                ->whereNotNull('submitted_at')
                ->orderByDesc('submitted_at'),
        ]);

        $keyword = trim((string) ($request->search ?: data_get($request->filter, 'keyword', '')));
        if ($keyword !== '') {
            $query->whereHas('profile', function (Builder $profileQuery) use ($keyword) {
                $profileQuery->where(function (Builder $searchQuery) use ($keyword) {
                    $searchQuery->where('first_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('last_name', 'LIKE', "%{$keyword}%")
                        ->orWhere('email', 'LIKE', "%{$keyword}%")
                        ->orWhereRaw("concat(first_name, ' ', last_name) LIKE ?", ["%{$keyword}%"]);
                });
            });
        }

        if (in_array($request->decision, self::CONSENTED_DECISIONS, true)) {
            $query->where('status', $request->decision);
        }

        if (in_array($request->mapping_status, ['complete', 'incomplete'], true)) {
            $query->whereHas('profile', fn (Builder $profileQuery) => $profileQuery->where('mapping_status', $request->mapping_status)
            );
        }

        if (is_string($request->submitted_date) && preg_match('/^\d{4}-\d{2}-\d{2}$/', $request->submitted_date)) {
            $query->whereDate('submitted_at', $request->submitted_date);
        }

        $data = $query->orderByDesc('submitted_at')->paginate($size)->through(
            fn (MigrationCase $case) => $this->listPayload($case)
        );

        return response(['data' => $data], 200);
    }

    public function show(int $migrationCase)
    {
        $case = $this->consentedCasesQuery()
            ->with(['profile', 'audits', 'items'])
            ->findOrFail($migrationCase);
        $audit = $this->matchingAudit($case);
        $profile = $case->profile;

        abort_unless($profile && $audit, 404);

        $items = $case->status === MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS
            ? $case->items
                ->where('source_user_id', $case->source_user_id)
                ->where('selected', true)
                ->where('eligible', true)
                ->map(fn (MigrationItem $item) => $this->itemPayload($item))
                ->values()
                ->all()
            : [];

        return response(['data' => [
            'id' => $case->id,
            'status' => $case->status,
            'submitted_at' => optional($case->submitted_at)->toISOString(),
            'profile' => [
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
                'prepared_at' => optional($profile->prepared_at)->toISOString(),
                'exported_at' => optional($profile->exported_at)->toISOString(),
                'taggy_user_id' => $profile->taggy_user_id,
            ],
            'consent' => [
                'decision' => $audit->decision,
                'submitted_at' => optional($audit->submitted_at)->toISOString(),
                'consent_version_id' => $audit->consent_version_id,
                'consent_version' => $audit->consent_version,
                'consent_content_hash' => $audit->consent_content_hash,
                'selected_item_count' => $audit->selected_item_count,
                'selected_source_item_ids' => $audit->selected_source_item_ids ?: [],
                'campaign_deadline' => optional($audit->campaign_deadline)->toISOString(),
            ],
            'items' => $items,
        ]], 200);
    }

    private function consentedCasesQuery(): Builder
    {
        return MigrationCase::query()
            ->whereIn('status', self::CONSENTED_DECISIONS)
            ->whereNotNull('submitted_at')
            ->whereHas('profile', fn (Builder $profileQuery) => $profileQuery->whereColumn('migration_profiles.source_user_id', 'migration_cases.source_user_id')
            )
            ->whereHas('audits', function (Builder $auditQuery) {
                $auditQuery->whereIn('decision', self::CONSENTED_DECISIONS)
                    ->whereColumn('migration_decision_audits.decision', 'migration_cases.status')
                    ->whereColumn('migration_decision_audits.source_user_id', 'migration_cases.source_user_id')
                    ->whereColumn('migration_decision_audits.campaign_id', 'migration_cases.campaign_id')
                    ->whereColumn('migration_decision_audits.submitted_at', 'migration_cases.submitted_at')
                    ->whereNotNull('migration_decision_audits.submitted_at')
                    ->whereNotNull('migration_decision_audits.consent_version_id')
                    ->whereNotNull('migration_decision_audits.consent_version')
                    ->whereNotNull('migration_decision_audits.consent_content_hash');
            });
    }

    private function matchingAudit(MigrationCase $case): ?MigrationDecisionAudit
    {
        return $case->audits
            ->filter(fn (MigrationDecisionAudit $audit) => (int) $audit->source_user_id === (int) $case->source_user_id
                && (int) $audit->campaign_id === (int) $case->campaign_id
                && $audit->decision === $case->status
                && $audit->submitted_at?->equalTo($case->submitted_at)
                && $audit->consent_version_id
                && $audit->consent_version
                && $audit->consent_content_hash
            )
            ->sortByDesc('submitted_at')
            ->first();
    }

    private function listPayload(MigrationCase $case): array
    {
        $profile = $case->profile;
        $audit = $this->matchingAudit($case);

        return [
            'id' => $case->id,
            'user' => [
                'name' => trim("{$profile->first_name} {$profile->last_name}"),
                'email' => $profile->email,
            ],
            'status' => $case->status,
            'selected_item_count' => (int) $audit->selected_item_count,
            'submitted_at' => optional($audit->submitted_at)->toISOString(),
            'mapping_status' => $profile->mapping_status,
            'prepared_at' => optional($profile->prepared_at)->toISOString(),
        ];
    }

    private function itemPayload(MigrationItem $item): array
    {
        $snapshot = $item->source_snapshot ?: [];

        return [
            'source_item_id' => $item->source_item_id,
            'item_name' => data_get($snapshot, 'item_name'),
            'item_description' => data_get($snapshot, 'item_description'),
            'price' => data_get($snapshot, 'price'),
            'status_name' => data_get($snapshot, 'status_name'),
            'images' => data_get($snapshot, 'images', []),
            'properties' => data_get($snapshot, 'properties', []),
            'snapshot_at' => optional($item->snapshot_at)->toISOString(),
            'mapping_status' => $item->mapping_status,
            'mapping_errors' => $item->mapping_errors ?: [],
            'prepared_at' => optional($item->prepared_at)->toISOString(),
            'exported_at' => optional($item->exported_at)->toISOString(),
        ];
    }
}
