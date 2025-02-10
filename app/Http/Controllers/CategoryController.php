<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategoryPropertyValue;

class CategoryController extends Controller
{
    /**
     * Get list of Category
     *
     * @param  mixed $request
     * @return void
     */
    protected function index(Request $request)
    {

        try {
            $data = Category::with('subCategory', 'subCategory.subCategoryProperty', 'subCategory.subCategoryProperty.subCategoryPropertyValue')->where('status', 1)->orderBy('id')->get();
            
            // Sort only the subCategoryPropertyValue by name
            $data->transform(function ($category) {
                $category->subCategory->transform(function ($subCategory) {
                    $subCategory->subCategoryProperty->transform(function ($property) {
                        // Assign the sorted collection back
                        $property->setRelation('subCategoryPropertyValue', $property->subCategoryPropertyValue->sortBy('name')->values());
                        return $property;
                    });
                    return $subCategory;
                });
                return $category;
            });
            
            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
