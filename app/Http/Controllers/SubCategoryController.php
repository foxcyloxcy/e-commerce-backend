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
            $data = SubCategory::where('category_id', $request->category_id)->get();

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
            $data = SubCategoryProperty::with('subCategoryPropertyValue')
                ->where('sub_category_id', $request->sub_category_id)
                ->get();

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
