<?php

namespace App\Services;

use App\Models\MigrationCase;
use App\Models\MigrationDecisionAudit;
use App\Models\MigrationItem;

class TaggyMigrationExportService
{
    private const COLUMNS = [
        'migration_case_id',
        'campaign_id',
        'source_user_id',
        'source_vendor_id',
        'decision',
        'migration_started_at',
        'migration_last_activity_at',
        'submitted_at',
        'consent_version_id',
        'consent_version',
        'consent_content_hash',
        'campaign_deadline',
        'selected_item_count',
        'selected_source_item_ids',
        'users.name',
        'users.first_name',
        'users.last_name',
        'users.email',
        'users.phone',
        'users.gender',
        'users.dob',
        'users.profile_image',
        'user_adresses.full_name',
        'user_adresses.email',
        'user_adresses.phone',
        'user_adresses.address',
        'user_adresses.country_id',
        'user_adresses.state_id',
        'user_adresses.city_id',
        'user_adresses.area_id',
        'user_adresses.is_default',
        'user_adresses.status',
        'seller_banks.account_holder_name',
        'seller_banks.account_number',
        'seller_banks.bank_name',
        'seller_banks.iban_code',
        'seller_banks.address_line_2',
        'source_item_id',
        'source_category_id',
        'source_sub_category_id',
        'source_status',
        'eligible',
        'eligibility_reason',
        'selected',
        'temp_products.listing_id',
        'temp_products.product_name',
        'temp_products.product_desc_full',
        'temp_products.product_unique_iden',
        'temp_products.product_brand_id',
        'temp_products.size_id',
        'temp_products.default_category_id',
        'temp_products.condition_id',
        'temp_products.fabric_id',
        'temp_products.price',
        'temp_products.my_price',
        'temp_products.regular_price',
        'temp_products.stock_quantity',
        'temp_products.created_at',
        'product_images',
        'product_categories',
        'product_colors',
        'profile_mapping_status',
        'profile_mapping_errors',
        'profile_source_updated_at',
        'profile_snapshot_at',
        'profile_prepared_at',
        'profile_exported_at',
        'taggy_user_id',
        'item_mapping_status',
        'item_mapping_errors',
        'item_source_updated_at',
        'item_snapshot_at',
        'item_prepared_at',
        'item_exported_at',
        'taggy_temp_product_id',
        'taggy_product_id',
        'profile_source_snapshot',
        'item_source_snapshot',
    ];

    public function columns(): array
    {
        return self::COLUMNS;
    }

    public function rows(MigrationCase $case, MigrationDecisionAudit $audit): array
    {
        $profile = $case->profile;
        $user = $profile->taggy_user_payload ?: [];
        $address = $profile->taggy_address_payload ?: [];
        $bank = $profile->taggy_bank_payload ?: [];
        $items = $case->status === MigrationCase::STATUS_CONSENT_ACCOUNT_AND_ITEMS
            ? $case->items->filter(fn (MigrationItem $item) => $item->selected && $item->eligible)->values()
            : collect();

        if ($items->isEmpty()) {
            $items = collect([null]);
        }

        return $items->map(function (?MigrationItem $item) use ($case, $audit, $profile, $user, $address, $bank) {
            $product = $item?->taggy_product_payload ?: [];

            return $this->ordered([
                'migration_case_id' => $case->id,
                'campaign_id' => $case->campaign_id,
                'source_user_id' => $case->source_user_id,
                'source_vendor_id' => $case->source_vendor_id,
                'decision' => $audit->decision,
                'migration_started_at' => optional($case->started_at)->toISOString(),
                'migration_last_activity_at' => optional($case->last_activity_at)->toISOString(),
                'submitted_at' => optional($audit->submitted_at)->toISOString(),
                'consent_version_id' => $audit->consent_version_id,
                'consent_version' => $audit->consent_version,
                'consent_content_hash' => $audit->consent_content_hash,
                'campaign_deadline' => optional($audit->campaign_deadline)->toISOString(),
                'selected_item_count' => $audit->selected_item_count,
                'selected_source_item_ids' => $this->json($audit->selected_source_item_ids),
                'users.name' => data_get($user, 'name'),
                'users.first_name' => data_get($user, 'first_name', $profile->first_name),
                'users.last_name' => data_get($user, 'last_name', $profile->last_name),
                'users.email' => data_get($user, 'email', $profile->email),
                'users.phone' => data_get($user, 'phone', $profile->mobile_number),
                'users.gender' => strtolower((string) data_get($user, 'gender')) ?: null,
                'users.dob' => data_get($user, 'dob', optional($profile->date_of_birth)->format('Y-m-d')),
                'users.profile_image' => data_get($user, 'profile_image'),
                'user_adresses.full_name' => data_get($address, 'full_name'),
                'user_adresses.email' => data_get($address, 'email'),
                'user_adresses.phone' => data_get($address, 'phone'),
                'user_adresses.address' => data_get($address, 'address', $profile->address),
                'user_adresses.country_id' => data_get($address, 'country_id'),
                'user_adresses.state_id' => data_get($address, 'state_id'),
                'user_adresses.city_id' => data_get($address, 'city_id'),
                'user_adresses.area_id' => data_get($address, 'area_id'),
                'user_adresses.is_default' => data_get($address, 'is_default'),
                'user_adresses.status' => data_get($address, 'status'),
                'seller_banks.account_holder_name' => data_get($bank, 'account_holder_name'),
                'seller_banks.account_number' => data_get($bank, 'account_number'),
                'seller_banks.bank_name' => data_get($bank, 'bank_name'),
                'seller_banks.iban_code' => data_get($bank, 'iban_code'),
                'seller_banks.address_line_2' => data_get($bank, 'address_line_2'),
                'source_item_id' => $item?->source_item_id,
                'source_category_id' => $item?->source_category_id,
                'source_sub_category_id' => $item?->source_sub_category_id,
                'source_status' => $item?->source_status,
                'eligible' => $item === null ? null : (int) $item->eligible,
                'eligibility_reason' => $item?->eligibility_reason,
                'selected' => $item === null ? null : (int) $item->selected,
                'temp_products.listing_id' => data_get($product, 'listing_id'),
                'temp_products.product_name' => data_get($product, 'product_name'),
                'temp_products.product_desc_full' => data_get($product, 'product_desc_full'),
                'temp_products.product_unique_iden' => data_get($product, 'product_unique_iden'),
                'temp_products.product_brand_id' => data_get($product, 'product_brand_id'),
                'temp_products.size_id' => data_get($product, 'size_id'),
                'temp_products.default_category_id' => data_get($product, 'default_category_id'),
                'temp_products.condition_id' => data_get($product, 'condition_id'),
                'temp_products.fabric_id' => data_get($product, 'fabric_id'),
                'temp_products.price' => data_get($product, 'price'),
                'temp_products.my_price' => data_get($product, 'my_price'),
                'temp_products.regular_price' => data_get($product, 'regular_price'),
                'temp_products.stock_quantity' => data_get($product, 'stock_quantity'),
                'temp_products.created_at' => data_get($product, 'created_at'),
                'product_images' => $this->json($item?->taggy_images_payload),
                'product_categories' => $this->json($item?->taggy_categories_payload),
                'product_colors' => $this->json($item?->taggy_colors_payload),
                'profile_mapping_status' => $profile->mapping_status,
                'profile_mapping_errors' => $this->json($profile->mapping_errors),
                'profile_source_updated_at' => optional($profile->source_updated_at)->toISOString(),
                'profile_snapshot_at' => optional($profile->snapshot_at)->toISOString(),
                'profile_prepared_at' => optional($profile->prepared_at)->toISOString(),
                'profile_exported_at' => optional($profile->exported_at)->toISOString(),
                'taggy_user_id' => $profile->taggy_user_id,
                'item_mapping_status' => $item?->mapping_status,
                'item_mapping_errors' => $this->json($item?->mapping_errors),
                'item_source_updated_at' => optional($item?->source_updated_at)->toISOString(),
                'item_snapshot_at' => optional($item?->snapshot_at)->toISOString(),
                'item_prepared_at' => optional($item?->prepared_at)->toISOString(),
                'item_exported_at' => optional($item?->exported_at)->toISOString(),
                'taggy_temp_product_id' => $item?->taggy_temp_product_id,
                'taggy_product_id' => $item?->taggy_product_id,
                'profile_source_snapshot' => $this->json($profile->source_snapshot),
                'item_source_snapshot' => $this->json($item?->source_snapshot),
            ]);
        })->all();
    }

    private function ordered(array $row): array
    {
        return array_map(fn (string $column) => $row[$column] ?? null, self::COLUMNS);
    }

    private function json(mixed $value): ?string
    {
        return empty($value) ? null : json_encode($value, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_THROW_ON_ERROR);
    }
}
