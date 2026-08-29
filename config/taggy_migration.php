<?php

return [
    'response_deadline' => env('TAGGY_MIGRATION_RESPONSE_DEADLINE', '2026-09-30 23:59:00 Asia/Dubai'),
    'supported_category_ids' => array_values(array_filter(array_map('intval', explode(',', env('TAGGY_MIGRATION_SUPPORTED_CATEGORY_IDS', '1,2'))))),
    'supported_sub_category_ids' => array_values(array_filter(array_map('intval', explode(',', env('TAGGY_MIGRATION_SUPPORTED_SUB_CATEGORY_IDS', '8,9,10,11,12'))))),

    // Only verified Reloved-source => Taggy-target IDs belong in these maps.
    // Empty maps deliberately produce an incomplete mapping rather than guessing IDs.
    'reference_mappings' => [
        'categories' => [],
        'brands' => [],
        'sizes' => [],
        'conditions' => [],
        'fabrics' => [],
        'colors' => [],
        'parcel_sizes' => [],
        'shipping_from' => [],
        'delivery_options' => [],
        'delivery_durations' => [],
    ],
    'address_reference_ids' => [
        'country_id' => null,
        'state_id' => null,
        'city_id' => null,
        'area_id' => null,
    ],
    'product_unique_identifiers' => [],
    'include_bank_payload' => false,
];
