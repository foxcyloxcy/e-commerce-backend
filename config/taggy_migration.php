<?php

return [
    'supported_category_ids' => array_values(array_filter(array_map('intval', explode(',', env('TAGGY_MIGRATION_SUPPORTED_CATEGORY_IDS', '1,2'))))),
    'supported_sub_category_ids' => array_values(array_filter(array_map('intval', explode(',', env('TAGGY_MIGRATION_SUPPORTED_SUB_CATEGORY_IDS', '8,9,10,11,12'))))),
];
