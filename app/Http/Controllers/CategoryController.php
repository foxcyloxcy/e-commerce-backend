<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

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
            $data = Category::with('subCategory', 'subCategory.subCategoryProperty', 'subCategory.subCategoryProperty.subCategoryPropertyValue')->orderBy('id')->get();

            return response(['data' =>  $data], 200);

        } catch (\Exception $e) {
            #error message
            return response(['message' => $e->getMessage()], 400);
        }
    }
}
