<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class BabyChildrenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         *  Baby Clothes (0-4yrs)
         */

        // for category/clothes option
        $babyClothesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 8,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyClothesOptionData = collect([
                ["sub_category_property_id" => $babyClothesOption, "name" => "Babygrows", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Bibs", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "T-shirts and Shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Trousers & Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Coords", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Dungarees", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Sleepwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Coats & Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyClothesOptionData->toArray());

        // for color option
        $babyClothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 8,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyClothesColorData = collect([
                ["sub_category_property_id" => $babyClothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $babyClothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyClothesColorData->toArray());

        // for sizes
        $babyClothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 8,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $babyClothesSizeData = collect([
            ["sub_category_property_id" => $babyClothesSize, "name" => "Premature", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "Tiny baby", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "Newborn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "Up to 3 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "3 - 6 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "6 - 9 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "9 - 12 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "12 - 18 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "2 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "3 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesSize, "name" => "4 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyClothesSizeData->toArray());

         // for brands
         $babyClothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 8,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $babyClothesBrandData = collect([
            ["sub_category_property_id" => $babyClothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Hugo Boss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Joie Baby", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Jojo Maman Bebe", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Maxi Cosi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Mini Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Monsoon", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Next", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Petit Bateau", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Purebaby", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Ted Baker", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "The Little Tailor", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Timberland", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Trotters", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Zara", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyClothesBrandData->toArray());

        // for baby clothes condition
        $babyClothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 8,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyClothesConditionData = collect([
            ["sub_category_property_id" => $babyClothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyClothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyClothesConditionData->toArray());

        /**
         *  Girls Clothes
         */

        // for category/clothes option
        $girlsClothesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 9,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $girlsClothesOptionData = collect([
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Babygrows", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Bibs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "T-shirts and Shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Trousers & Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Coords", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Dungarees", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Sleepwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Coats & Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($girlsClothesOptionData->toArray());

        // for color option
        $girlsClothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 9,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $girlsClothesColorData = collect([
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $girlsClothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($girlsClothesColorData->toArray());

        // for sizes
        $girlsClothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 9,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $girlsClothesSizeData = collect([
            ["sub_category_property_id" => $girlsClothesSize, "name" => "5 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "6 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "7 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "8 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "9 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "10 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "11 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesSize, "name" => "12 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($girlsClothesSizeData->toArray());

        // for girls clothes brands
        $girlsClothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 9,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $girlsClothesBrandData = collect([
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Chicos", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Country Road", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Hobbs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "J. Crew", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Jack & Jones", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Jasper Conran London", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Jigsaw", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Jojo Maman Beb", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "La Chique", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Petit Bateau", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($girlsClothesBrandData->toArray());

        // girls clothes condition
        $girlsClothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 9,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $girlsClothesConditionData = collect([
            ["sub_category_property_id" => $girlsClothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $girlsClothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($girlsClothesConditionData->toArray());

        /**
         *  Boys Clothes
         */

        // for category/clothes option
        $boysClothesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 10,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $boysClothesOptionData = collect([
            ["sub_category_property_id" => $boysClothesOption, "name" => "Babygrows", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Bibs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "T-shirts and Shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Trousers & Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Coords", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Dungarees", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Sleepwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Coats & Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($boysClothesOptionData->toArray());

        // for color option
        $boysClothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 10,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $boysClothesColorData = collect([
                ["sub_category_property_id" => $boysClothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $boysClothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($boysClothesColorData->toArray());

        // for sizes
        $boysClothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 10,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $boysClothesSizeData = collect([
            ["sub_category_property_id" => $boysClothesSize, "name" => "5 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "6 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "7 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "8 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "9 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "10 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "11 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesSize, "name" => "12 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($boysClothesSizeData->toArray());

        // for boys clothes brands
        $boysClothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 10,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $boysClothesBrandData = collect([
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Chicos", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Country Road", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Hobbs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "J. Crew", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Jack & Jones", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Jasper Conran London", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Jigsaw", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Jojo Maman Beb", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "La Chique", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Petit Bateau", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($boysClothesBrandData->toArray());

        // boys clothes condition
        $boysClothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 10,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $boysClothesConditionData = collect([
            ["sub_category_property_id" => $boysClothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $boysClothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($boysClothesConditionData->toArray());

        /**
         *  Teenage Girls Clothes
         */

        // for category/clothes option
        $teenageGirlsClothesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 11,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageGirlsClothesOptionData = collect([
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Babygrows", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Bibs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "T-shirts and Shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Trousers & Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Coords", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Dungarees", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Sleepwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Coats & Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageGirlsClothesOptionData->toArray());

        // for color option
        $teenageGirlsClothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 11,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageGirlsClothesColorData = collect([
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageGirlsClothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageGirlsClothesColorData->toArray());

        // for sizes
        $teenageGirlsClothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 11,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageGirlsClothesSizeData = collect([
            ["sub_category_property_id" => $teenageGirlsClothesSize, "name" => "13 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesSize, "name" => "14 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesSize, "name" => "15 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesSize, "name" => "16 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesSize, "name" => "17 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageGirlsClothesSizeData->toArray());

        // for teen girls clothes brands
        $teenageGirlsClothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 11,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $teenageGirlsClothesBrandData = collect([
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Chicos", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Country Road", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Hobbs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "J. Crew", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Jack & Jones", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Jasper Conran London", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Jigsaw", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Jojo Maman Beb", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "La Chique", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Petit Bateau", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($teenageGirlsClothesBrandData->toArray());

         // teenage girls clothes condition
         $teenageGirlsClothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 11,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageGirlsClothesConditionData = collect([
            ["sub_category_property_id" => $teenageGirlsClothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageGirlsClothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageGirlsClothesConditionData->toArray());

        /**
         *  Teenage Boys Clothes
         */

        // for category/clothes option
        $teenageBoysClothesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 12,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageBoysClothesOptionData = collect([
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Babygrows", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Bibs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "T-shirts and Shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Trousers & Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Coords", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Dungarees", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Sleepwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Coats & Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageBoysClothesOptionData->toArray());

        // for color option
        $teenageBoysClothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 12,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageBoysClothesColorData = collect([
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $teenageBoysClothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageBoysClothesColorData->toArray());

        // for sizes
        $teenageBoysClothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 12,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageBoysClothesSizeData = collect([
            ["sub_category_property_id" => $teenageBoysClothesSize, "name" => "13 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesSize, "name" => "14 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesSize, "name" => "15 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesSize, "name" => "16 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesSize, "name" => "17 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageBoysClothesSizeData->toArray());

        // for teen boys clothes brands
        $teenageBoysClothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 12,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);
        $teenageBoysClothesBrandData = collect([
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Chicos", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Country Road", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Hobbs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "J. Crew", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Jack & Jones", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Jasper Conran London", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Jigsaw", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Jojo Maman Beb", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "La Chique", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Petit Bateau", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($teenageBoysClothesBrandData->toArray());

        // teenage boys clothes condition
        $teenageBoysClothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 12,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $teenageBoysClothesConditionData = collect([
            ["sub_category_property_id" => $teenageBoysClothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $teenageBoysClothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($teenageBoysClothesConditionData->toArray());


        /**
         *  Toys and Game
         */

        // for category/clothes option
        $toysOptions = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 13,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $toysOptionsData = collect([
            ["sub_category_property_id" => $toysOptions, "name" => "Dolls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Education", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Kitchen", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Lego", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Music", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Outdoor", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Soft Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Plastic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Wooden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysOptions, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($toysOptionsData->toArray());

        // for color option
        $toysColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 13,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $toysColorData = collect([
                ["sub_category_property_id" => $toysColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Blue", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Cream", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Lilac", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Mustard", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $toysColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($toysColorData->toArray());

        // for age option
        $toysAge = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 13,
            "name" => "Age", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $toysAgeData = collect([
            ["sub_category_property_id" => $toysAge, "name" => "0-1 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "2-3 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "3-4 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "4-5 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "5 years +", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "6-7 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "8-9 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysAge, "name" => "10 years +", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($toysAgeData->toArray());

        // toys condition
        $toysCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 13,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $toysConditionData = collect([
            ["sub_category_property_id" => $toysCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $toysCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($toysConditionData->toArray());

        /**
         *  Baby Care
         */

        // for category/clothes option
        $babyCareOptions = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 14,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyCareOptionsData = collect([
            ["sub_category_property_id" => $babyCareOptions, "name" => "Nursing & feedng", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareOptions, "name" => "Baby accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareOptions, "name" => "Potties", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareOptions, "name" => "Sleep accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareOptions, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyCareOptionsData->toArray());

        // for age option
        $babyCareAge = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 14,
            "name" => "Age", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyCareAgeData = collect([
            ["sub_category_property_id" => $babyCareAge, "name" => "Newborn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "Up to 3 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "3 - 6 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "6 - 9 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "9 - 12 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "12 - 18 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareAge, "name" => "2 years", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyCareAgeData->toArray());

        // babycare condition
        $babyCareCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 14,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $babyCareConditionData = collect([
            ["sub_category_property_id" => $babyCareCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $babyCareCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($babyCareConditionData->toArray());

        /**
         *  Buggies and Travel
         */

        // for buggies category option
        $buggysOptions = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 15,
            "name" => "Buggies Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $buggysOptionsData = collect([
            ["sub_category_property_id" => $buggysOptions, "name" => "Sports", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysOptions, "name" => "For Twins", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysOptions, "name" => "Universal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysOptions, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($buggysOptionsData->toArray());

        // for buggies brand
        $buggysBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 15,
            "name" => "Buggies Brand", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $buggysBrandData = collect([
            ["sub_category_property_id" => $buggysBrand, "name" => "Asalvo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Babyzen", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Belecoo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Bizzi Growin", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Bugaboo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Bumble & Bird", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Bumprider", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Good baby", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Jikel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Joie", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Kinderkraft", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Leclerc", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Mamas and Papas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Mothercare", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Silvercross", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Teknum", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $buggysBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($buggysBrandData->toArray());

        // for trabel category option
        $travelOptions = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 15,
            "name" => "Travel Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $travelOptionsData = collect([
            ["sub_category_property_id" => $travelOptions, "name" => "Car seat", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $travelOptions, "name" => "Car accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $travelOptions, "name" => "Travel accessories ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $travelOptions, "name" => "Suitcases", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $travelOptions, "name" => "Changing mats and accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $travelOptions, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($travelOptionsData->toArray());

        // for buggies travel age
        $btages = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 15,
            "name" => "Ages", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $btagesData = collect([
            ["sub_category_property_id" => $btages, "name" => "Newborn", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "Up to 3 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "3 - 6 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "6 - 9 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "9 - 12 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "12 - 18 months", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btages, "name" => "2 years ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($btagesData->toArray());

        //  condition
        $btCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 15,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $btConditionData = collect([
            ["sub_category_property_id" => $btCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $btCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($btConditionData->toArray());

    }
}
