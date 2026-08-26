<?php

namespace App\Services;

use App\Models\Item;
use Illuminate\Support\Facades\DB;

class TaggyMigrationEligibilityService
{
    public function evaluate(Item $item): array
    {
        $subCategory = DB::table('sub_categories')->where('id', $item->sub_category_id)->first();

        if (!$subCategory) {
            return ['eligible' => false, 'reason' => 'Subcategory not found'];
        }

        $supportedCategoryIds = config('taggy_migration.supported_category_ids', []);
        $supportedSubCategoryIds = config('taggy_migration.supported_sub_category_ids', []);

        if (in_array((int) $subCategory->category_id, $supportedCategoryIds, true)) {
            return ['eligible' => true, 'reason' => 'Supported fashion category'];
        }

        if (in_array((int) $item->sub_category_id, $supportedSubCategoryIds, true)) {
            return ['eligible' => true, 'reason' => 'Supported clothing subcategory'];
        }

        return ['eligible' => false, 'reason' => 'Not eligible for Taggy'];
    }

    public function categoryIdFor(Item $item): ?int
    {
        $subCategory = DB::table('sub_categories')->where('id', $item->sub_category_id)->first();
        return $subCategory ? (int) $subCategory->category_id : null;
    }
}
