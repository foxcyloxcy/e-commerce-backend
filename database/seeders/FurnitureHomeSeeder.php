<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class FurnitureHomeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         *  Accessories
         */

        // for accessories option
        $accessoriesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 16,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesOptionData = collect([
            ["sub_category_property_id" => $accessoriesOption, "name" => "Bedding", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Curtains", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Rug", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Pillow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Towels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesOptionData->toArray());

        // for accessories color
        $accessoriesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 16,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesColorData = collect([
            ["sub_category_property_id" => $accessoriesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesColorData->toArray());

        // for accessories brands
        $accessoriesBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 16,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesBrandsData = collect([
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesBrandsData->toArray());

        // for accessories condition
        $accessoriesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 16,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesConditionData = collect([
            ["sub_category_property_id" => $accessoriesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesConditionData->toArray());

        /**
         *  Bed
         */

        // for bed option
        $bedOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 17,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bedOptionData = collect([
            ["sub_category_property_id" => $bedOption, "name" => "Single Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Double Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Queen Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "King Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Superking Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Bunk beds", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Superking Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Children Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Cot", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Moses basket", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($bedOptionData->toArray());

        // for bed color
        $bedColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 17,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bedColorData = collect([
            ["sub_category_property_id" => $bedColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($bedColorData->toArray());

        // for bed brands
        $bedBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 17,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bedBrandsData = collect([
            ["sub_category_property_id" => $bedBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($bedBrandsData->toArray());

        // for bed condition
        $bedCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 17,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bedConditionData = collect([
            ["sub_category_property_id" => $bedCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bedCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($bedConditionData->toArray());

        /**
         *  Kitchenwear
         */

        // for kitchenwear option
        $kitchenOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 18,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $kitchenOptionData = collect([
            ["sub_category_property_id" => $kitchenOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenOption, "name" => "Glasswear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenOption, "name" => "Plates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenOption, "name" => "Utensils", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($kitchenOptionData->toArray());

        // for kitchenwear color
        $kitchebColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 18,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $kitchebColorData = collect([
            ["sub_category_property_id" => $kitchebColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchebColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($kitchebColorData->toArray());

        // for kitchen brands
        $kitchenBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 18,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $kitchenBrandsData = collect([
            ["sub_category_property_id" => $kitchenBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($kitchenBrandsData->toArray());

        // for kitchen condition
        $kitchenCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 18,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $kitchenConditionData = collect([
            ["sub_category_property_id" => $kitchenCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $kitchenCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($kitchenConditionData->toArray());

        /**
         *  Outside
         */

        // for outside option
        $outsideOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 19,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $outsideOptionData = collect([
            ["sub_category_property_id" => $outsideOption, "name" => "Dinning", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Kitchen", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Plants", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Sun lounger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Parasols", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Pool accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($outsideOptionData->toArray());

        // for outside color
        $outsideColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 19,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $outsideColorData = collect([
            ["sub_category_property_id" => $outsideColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($outsideColorData->toArray());

        // for outside brands
        $outsideBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 19,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $outsideBrandsData = collect([
            ["sub_category_property_id" => $outsideBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($outsideBrandsData->toArray());

        // for outside condition
        $outsideCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 19,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $outsideConditionData = collect([
            ["sub_category_property_id" => $outsideCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $outsideCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($outsideConditionData->toArray());

        /**
         *  Seating
         */

        // for seating option
        $seatingOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 20,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $seatingOptionData = collect([
            ["sub_category_property_id" => $seatingOption, "name" => "Armchair", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Baby", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Chair", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Children", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Office Chair", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Sofa", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($seatingOptionData->toArray());

        // for seating color
        $seatingColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 20,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $seatingColorData = collect([
            ["sub_category_property_id" => $seatingColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($seatingColorData->toArray());

        // for seating brands
        $seatingBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 20,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $seatingBrandsData = collect([
            ["sub_category_property_id" => $seatingBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($seatingBrandsData->toArray());

        // for seaating condition
        $seatingCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 20,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $seatingConditionData = collect([
            ["sub_category_property_id" => $seatingCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $seatingCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($seatingConditionData->toArray());

        /**
         *  Storage and Wardrobes
         */

        // for storage option
        $wardrobesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 21,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $wardrobesOptionData = collect([
            ["sub_category_property_id" => $wardrobesOption, "name" => "Bed side table", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Chest of Drawers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Cupboard", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Drawers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Dressing Table", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Wardobe", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($wardrobesOptionData->toArray());

        // for wardrobes color
        $wardrobesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 21,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $wardrobesColorData = collect([
            ["sub_category_property_id" => $wardrobesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($wardrobesColorData->toArray());

        // for wardrobes brands
        $wardrobesBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 21,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $wardrobesBrandsData = collect([
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($wardrobesBrandsData->toArray());

        // for wardrobes condition
        $wardrobesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 21,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $wardrobesConditionData = collect([
            ["sub_category_property_id" => $wardrobesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $wardrobesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($wardrobesConditionData->toArray());

        /**
         *  Tables
         */

        // for tables option
        $tablesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 22,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tablesOptionData = collect([
            ["sub_category_property_id" => $tablesOption, "name" => "Desk", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesOption, "name" => "Dinning", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesOption, "name" => "Dressing table", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesOption, "name" => "Side Table ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tablesOptionData->toArray());

        // for tables color
        $tablesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 22,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tablesColorData = collect([
            ["sub_category_property_id" => $tablesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Grey", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Metal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Neutrals", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "White", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Wood", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Yellow", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tablesColorData->toArray());

        // for tables brands
        $tablesBrands = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 22,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tablesBrandsData = collect([
            ["sub_category_property_id" => $tablesBrands, "name" => "Bloomr", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Crate and Barel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "H&M Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Home Centre", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Homes R Us", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Ikea", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Jo Malone", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Marina Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Next Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Palm Living", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Pan Emirates", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Pottery Barn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "The One", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Zara Home", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesBrands, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tablesBrandsData->toArray());

        // for tables condition
        $tablesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 22,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tablesConditionData = collect([
            ["sub_category_property_id" => $tablesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tablesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tablesConditionData->toArray());
    }
}
