<?php

namespace App\Services;

use App\Models\MigrationCase;
use App\Models\MigrationConsentVersion;
use App\Models\MigrationItem;
use App\Models\MigrationProfile;

class TaggyMigrationExportValidator
{
    public function profileIsTaggyReady(?MigrationProfile $profile): bool
    {
        return $profile !== null
            && $profile->mapping_status === TaggyMigrationMapper::STATUS_COMPLETE
            && !empty($profile->taggy_user_payload);
    }

    public function itemIsTaggyReady(MigrationItem $item): bool
    {
        return $item->eligible
            && $item->mapping_status === TaggyMigrationMapper::STATUS_COMPLETE
            && !empty($item->taggy_product_payload);
    }

    public function validateCase(MigrationCase $case): array
    {
        $case->loadMissing(['profile', 'items', 'audits']);
        $errors = [];
        $accepted = in_array($case->status, [
            MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS,
            MigrationCase::STATUS_CONSENT_ACCOUNT_ONLY,
        ], true);

        if (!$accepted) {
            $errors[] = 'The final decision does not permit a Taggy export.';
        }
        if (!$case->submitted_at) {
            $errors[] = 'The migration case has not been finally submitted.';
        }

        $audit = $case->audits->sortByDesc('id')->first();
        if (!$audit) {
            $errors[] = 'No migration decision audit exists.';
        } elseif (!$this->hasValidConsentVersion($audit)) {
            $errors[] = 'The decision audit does not reference a valid matching consent version.';
        }

        if (!$this->profileIsTaggyReady($case->profile)) {
            $errors[] = 'The migration profile has incomplete Taggy mapping.';
        }

        $selected = $case->items->where('selected', true)->where('eligible', true);
        if ($case->status === MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS) {
            if ($selected->isEmpty()) {
                $errors[] = 'Account-and-items consent has no selected eligible listings.';
            }
            if ($selected->contains(fn (MigrationItem $item) => !$this->itemIsTaggyReady($item))) {
                $errors[] = 'One or more selected eligible listings has incomplete Taggy mapping.';
            }
        }

        return [
            'legally_exportable' => $accepted && $case->submitted_at !== null && $audit && $this->hasValidConsentVersion($audit),
            'taggy_ready' => empty($errors),
            'errors' => $errors,
            'profile_mapping_errors' => $case->profile?->mapping_errors ?: [],
            'item_mapping_errors' => $selected->mapWithKeys(fn (MigrationItem $item) => [
                $item->source_item_id => $item->mapping_errors ?: [],
            ])->all(),
        ];
    }

    public function exportPayload(MigrationCase $case): array
    {
        $validation = $this->validateCase($case);
        if (!$validation['taggy_ready']) {
            return ['exportable' => false, 'validation' => $validation, 'payload' => null];
        }

        $profile = $case->profile;
        $items = $case->status === MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS
            ? $case->items->filter(fn (MigrationItem $item) => $item->selected && $this->itemIsTaggyReady($item))->values()
            : collect();

        return [
            'exportable' => true,
            'validation' => $validation,
            'payload' => [
                'users' => $profile->taggy_user_payload,
                'user_adresses' => $profile->taggy_address_payload,
                'seller_banks' => $profile->taggy_bank_payload,
                'temp_products' => $items->map(fn (MigrationItem $item) => [
                    'product' => $item->taggy_product_payload,
                    'product_images' => $item->taggy_images_payload,
                    'product_categories' => $item->taggy_categories_payload,
                    'product_colors' => $item->taggy_colors_payload,
                ])->all(),
            ],
        ];
    }

    private function hasValidConsentVersion($audit): bool
    {
        if (!$audit->consent_version_id || !$audit->consent_version || !$audit->consent_content_hash) {
            return false;
        }

        $version = MigrationConsentVersion::find($audit->consent_version_id);
        if (!$version || $version->version !== $audit->consent_version || !hash_equals($version->content_hash, $audit->consent_content_hash)) {
            return false;
        }

        return (!$version->effective_from || $version->effective_from->lte($audit->submitted_at))
            && (!$version->effective_until || $version->effective_until->gte($audit->submitted_at));
    }
}
