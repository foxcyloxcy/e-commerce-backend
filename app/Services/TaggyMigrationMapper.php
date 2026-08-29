<?php

namespace App\Services;

use App\Models\MigrationCase;
use App\Models\MigrationItem;
use App\Models\MigrationProfile;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class TaggyMigrationMapper
{
    public const STATUS_COMPLETE = 'complete';
    public const STATUS_INCOMPLETE = 'incomplete';
    public const STATUS_EXCLUDED = 'excluded';

    public function prepareCase(MigrationCase $case): void
    {
        $case->loadMissing(['profile', 'items']);

        if ($case->profile) {
            $this->prepareProfile($case->profile);
        }

        foreach ($case->items as $item) {
            $this->prepareItem($item);
        }
    }

    public function prepareProfile(MigrationProfile $profile): array
    {
        $errors = [];
        $snapshot = $profile->source_snapshot ?: [];
        $fullName = trim(implode(' ', array_filter([$profile->first_name, $profile->last_name])));

        $userPayload = $this->withoutNulls([
            'name' => $fullName ?: null,
            'first_name' => $profile->first_name,
            'last_name' => $profile->last_name,
            'email' => $profile->email,
            'phone' => $profile->mobile_number,
            'gender' => $this->gender($profile->gender),
            'dob' => optional($profile->date_of_birth)->format('Y-m-d'),
            'profile_image' => data_get($snapshot, 'photo'),
        ]);

        foreach (['first_name', 'last_name', 'email'] as $required) {
            if (empty($userPayload[$required])) {
                $errors[] = $this->error($required, 'missing_required_value', "Taggy users.{$required} is not available.");
            }
        }

        $addressPayload = null;
        if ($profile->address) {
            $addressPayload = $this->withoutNulls([
                'full_name' => $fullName ?: null,
                'email' => $profile->email,
                'phone' => $profile->mobile_number,
                'address' => $profile->address,
                'country_id' => config('taggy_migration.address_reference_ids.country_id'),
                'state_id' => config('taggy_migration.address_reference_ids.state_id'),
                'city_id' => config('taggy_migration.address_reference_ids.city_id'),
                'area_id' => config('taggy_migration.address_reference_ids.area_id'),
                'is_default' => 1,
                'status' => 1,
            ]);

            foreach (['country_id', 'state_id', 'city_id', 'area_id'] as $field) {
                if (!array_key_exists($field, $addressPayload)) {
                    $errors[] = $this->error("user_adresses.{$field}", 'unresolved_reference', "No verified Taggy {$field} is configured for the Reloved address.");
                }
            }
        }

        $bankPayload = $this->bankPayload($profile);
        $result = [
            'taggy_user_payload' => $userPayload,
            'taggy_address_payload' => $addressPayload,
            'taggy_bank_payload' => $bankPayload,
            'mapping_status' => empty($errors) ? self::STATUS_COMPLETE : self::STATUS_INCOMPLETE,
            'mapping_errors' => $errors ?: null,
            'prepared_at' => now(),
        ];
        $profile->update($result);

        return $result;
    }

    public function prepareItem(MigrationItem $item): array
    {
        if (!$item->eligible) {
            $result = [
                'taggy_product_payload' => null,
                'taggy_images_payload' => null,
                'taggy_categories_payload' => null,
                'taggy_colors_payload' => null,
                'mapping_status' => self::STATUS_EXCLUDED,
                'mapping_errors' => [[
                    'field' => 'eligible',
                    'code' => 'not_eligible',
                    'message' => $item->eligibility_reason ?: 'This Reloved listing is not eligible for Taggy.',
                ]],
                'prepared_at' => now(),
            ];
            $item->update($result);
            return $result;
        }

        $snapshot = $item->source_snapshot ?: [];
        $properties = collect(data_get($snapshot, 'properties', []));
        $errors = [];

        $categoryId = $this->mappedId('categories', $item->source_sub_category_id ?: $item->source_category_id, 'default_category_id', $errors);
        $brand = $this->property($properties, ['brand']);
        $size = $this->property($properties, ['size']);
        $condition = $this->property($properties, ['condition']);
        $fabric = $this->property($properties, ['fabric', 'material']);
        $color = $this->property($properties, ['color', 'colour']);

        $brandId = $this->mappedPropertyId('brands', $brand, 'product_brand_id', $errors, true);
        $sizeId = $this->mappedPropertyId('sizes', $size, 'size_id', $errors, true);
        $conditionId = $this->mappedPropertyId('conditions', $condition, 'condition_id', $errors, true);
        $fabricId = $this->mappedPropertyId('fabrics', $fabric, 'fabric_id', $errors, false);
        $uniqueIdentifier = config("taggy_migration.product_unique_identifiers.{$item->source_item_id}");

        if (!$uniqueIdentifier) {
            $errors[] = $this->error('product_unique_iden', 'unresolved_generation_rule', 'No established Taggy product_unique_iden value or generation rule is configured.');
        }

        $price = data_get($snapshot, 'price');
        $name = data_get($snapshot, 'item_name');
        if ($name === null || $name === '') {
            $errors[] = $this->error('product_name', 'missing_required_value', 'The Reloved item name is not available.');
        }
        if ($price === null || !is_numeric($price)) {
            $errors[] = $this->error('price', 'missing_required_value', 'The Reloved AED price is not available.');
        }

        $productPayload = $this->withoutNulls([
            'listing_id' => data_get($snapshot, 'uuid'),
            'product_name' => $name,
            'product_desc_full' => data_get($snapshot, 'item_description'),
            'product_unique_iden' => $uniqueIdentifier,
            'product_brand_id' => $brandId,
            'size_id' => $sizeId,
            'default_category_id' => $categoryId,
            'condition_id' => $conditionId,
            'fabric_id' => $fabricId,
            'price' => is_numeric($price) ? (float) $price : null,
            'my_price' => is_numeric($price) ? (float) $price : null,
            'regular_price' => is_numeric($price) ? (float) $price : null,
            'stock_quantity' => 1,
            'created_at' => $this->utcTimestamp(data_get($snapshot, 'created_at')),
        ]);

        $imagesPayload = $this->imagesPayload(collect(data_get($snapshot, 'images', [])), $errors);
        $categoriesPayload = $categoryId ? [['category_id' => $categoryId]] : null;
        $colorsPayload = null;
        if ($color) {
            $colorId = $this->mappedPropertyId('colors', $color, 'product_colors.color_id', $errors, false);
            $colorsPayload = $colorId ? [['color_id' => $colorId]] : null;
        }

        $result = [
            'taggy_product_payload' => $productPayload,
            'taggy_images_payload' => $imagesPayload ?: null,
            'taggy_categories_payload' => $categoriesPayload,
            'taggy_colors_payload' => $colorsPayload,
            'mapping_status' => empty($errors) ? self::STATUS_COMPLETE : self::STATUS_INCOMPLETE,
            'mapping_errors' => $errors ?: null,
            'prepared_at' => now(),
        ];
        $item->update($result);

        return $result;
    }

    private function bankPayload(MigrationProfile $profile): ?array
    {
        if (!config('taggy_migration.include_bank_payload')) {
            return null;
        }

        $bank = DB::table('vendor_banks')->where('user_id', $profile->source_user_id)->first();
        if (!$bank) {
            return null;
        }

        return $this->withoutNulls([
            'account_holder_name' => $bank->account_fullname ?? null,
            'account_number' => $bank->account_number ?? null,
            'bank_name' => $bank->bank_name ?? null,
            'iban_code' => $bank->iban ?? null,
            'address_line_2' => $bank->bank_address ?? null,
        ]) ?: null;
    }

    private function imagesPayload(Collection $images, array &$errors): array
    {
        return $images->values()->map(function ($image, $index) use (&$errors) {
            $source = data_get($image, 'image_url');
            if (!$source) {
                return null;
            }

            $path = parse_url($source, PHP_URL_PATH) ?: $source;
            $errors[] = $this->error("product_images.{$index}.original_file", 'requires_s3_import', 'The Reloved image reference must be copied to an approved Taggy S3 object path by the future importer.');

            return [
                'image_name' => basename($path),
                'thumb_image' => $source,
                'original_file' => $source,
                'is_main' => $index === 0 ? 1 : 0,
                'is_visible' => 1,
            ];
        })->filter()->values()->all();
    }

    private function property(Collection $properties, array $names): ?array
    {
        return $properties->first(function ($property) use ($names) {
            return in_array(strtolower((string) data_get($property, 'property_name')), $names, true);
        });
    }

    private function mappedPropertyId(string $map, ?array $property, string $targetField, array &$errors, bool $required): ?int
    {
        if (!$property) {
            if ($required) {
                $errors[] = $this->error($targetField, 'missing_source_value', "No Reloved source value is available to map {$targetField}.");
            }
            return null;
        }

        return $this->mappedId($map, data_get($property, 'value_id'), $targetField, $errors);
    }

    private function mappedId(string $map, mixed $sourceId, string $targetField, array &$errors): ?int
    {
        $mapped = $sourceId === null ? null : config("taggy_migration.reference_mappings.{$map}.{$sourceId}");
        if (!$mapped) {
            $errors[] = $this->error($targetField, 'unresolved_reference', "No verified Taggy {$map} mapping exists for Reloved source ID ".($sourceId ?? 'unknown').'.');
            return null;
        }

        return (int) $mapped;
    }

    private function gender(?int $gender): ?string
    {
        return match ($gender) {
            1 => 'Male',
            2 => 'Female',
            default => null,
        };
    }

    private function utcTimestamp(?string $value): ?string
    {
        return $value ? Carbon::parse($value)->utc()->toISOString() : null;
    }

    private function withoutNulls(array $values): array
    {
        return array_filter($values, fn ($value) => $value !== null && $value !== '');
    }

    private function error(string $field, string $code, string $message): array
    {
        return compact('field', 'code', 'message');
    }
}
