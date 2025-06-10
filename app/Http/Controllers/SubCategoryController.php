<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class SubCategoryController extends Controller
{
    /**
     * Get list of Sub Category
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {
        // return 's';
        try {
            $data = SubCategory::with('subCategoryProperty', 'subCategoryProperty.subCategoryPropertyValue')->where('category_id', $request->category_id)->where('status', 1)->get();
            
            // Sort only the subCategoryPropertyValue by name
            $data->transform(function ($subCategory) {
                $subCategory->subCategoryProperty->transform(function ($property) {
                    // Sort the subCategoryPropertyValue collection by name
                    $property->setRelation(
                        'subCategoryPropertyValue',
                        $property->subCategoryPropertyValue->sortBy('name')->values()
                    );
                    return $property;
                });
                return $subCategory;
            });

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }

    /**
     * Get list of Sub Category Properties
     *
     * @param  mixed $request
     * @return void
     */
    protected function properties(Request $request)
    {

        try {
            $data = SubCategory::with('subCategoryProperty', 'subCategoryProperty.subCategoryPropertyValue')
                ->where('status', 1)
                ->whereHas('subCategoryProperty', function ($q) use ($request) {
                    $q->where('sub_category_id', $request->sub_category_id)
                    ->where('status', 1);
                })
                ->get();    

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
