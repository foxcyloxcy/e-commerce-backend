<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class MenCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         *  Clothes
         */

        // for category/clothes option
        $clothingOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 5,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

         $clothingOptionData = collect([
                ["sub_category_property_id" => $clothingOption, "name" => "Activewear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Tops & T-shirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Jumpers", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Shorts", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Trousers", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Jeans", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Suits & Blazers", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Swimwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Kandura", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Ghutra", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($clothingOptionData->toArray());

        // for clothes color
        $clothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 5,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesColorData = collect([
            ["sub_category_property_id" => $clothesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Blue and Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Cream and Knitwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Lilac and Tops", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Mustard and Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($clothesColorData->toArray());

        // for clothes size
        $clothesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 5,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesSizeData = collect([
            ["sub_category_property_id" => $clothesSize, "name" => "XXS", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "XS", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "S", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "L", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "XXL", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "XXXL", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "29", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "31", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "33", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "35", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "37", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "39", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "41", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "43", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "45", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "47", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "49", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "51", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($clothesSizeData->toArray());

        // for clothes brand
        $clothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 5,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesBrandData = collect([
            ["sub_category_property_id" => $clothesBrand, "name" => "Abercrombie and Fitch", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "All Saints", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Amani", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "American Eagle", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Arni", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Diesal", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Farrah", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Fat face", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Hugo Boss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Mango Man", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Michael Kors", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Nike", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "North face", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Orlebar Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Reiss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "River Island", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "The Giving Movement", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Topman", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "White company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Zara", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],

        ]);

        SubCategoryPropertyValue::insert($clothesBrandData->toArray());

        // for clothes condition
        $clothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 5,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesConditionData = collect([
            ["sub_category_property_id" => $clothesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($clothesConditionData->toArray());

        /**
         * Shoes
         */

        // for category/shoes option
        $shoesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 6,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesOptionData = collect([
            ["sub_category_property_id" => $shoesOption, "name" => "Boots", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Shoes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Trainers", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Flip-Flops / Sandals / Sliders  ", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($shoesOptionData->toArray());

        // for shoes size
        $shoesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 6,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesSizeData = collect([
            ["sub_category_property_id" => $shoesSize, "name" => "EU 38", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 39", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 39.5 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 40", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 40.5 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 41", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 41.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 42", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 42.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 43", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 43.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 44 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 44.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 45", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 45.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 46", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 46.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($shoesSizeData->toArray());

        // for shoes brands
        $shoesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 6,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesBrandData = collect([
            ["sub_category_property_id" => $shoesBrand, "name" => "Aldo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Axel Aregato", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Havianas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Hugo Boss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "J,Lindeberg", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Lyle and Scott", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "New Balance", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Nike", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Puma", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Sebago", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ted Baker", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Timberland", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Titleist", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Under Armor", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($shoesBrandData->toArray());

        // for shoes color
        $shoesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 6,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesColorData = collect([
            ["sub_category_property_id" => $shoesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Blue and Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Cream and Knitwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Lilac and Tops", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Mustard and Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($shoesColorData->toArray());

        // for shoes condition
        $shoesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 6,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesConditionData = collect([
            ["sub_category_property_id" => $shoesCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($shoesConditionData->toArray());

        /**
         * Accessories
         */

        // for accessories option
        $accessoriesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 7,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesOptionData = collect([
            ["sub_category_property_id" => $accessoriesOption, "name" => "Bags", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Belts", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Hats", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Jewellery", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Travel bags ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Sunglasses", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Wallets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Golf", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Paddel Tennis", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Other ", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($accessoriesOptionData->toArray());

        // for accessories brands
        $accessoriesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 7,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesBrandData = collect([
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Air Jordan", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Allsaints", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Ben Sherman", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Boss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Braun", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Callaway", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Casio", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Coach", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Common Line", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Converse", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Daniel Wellington", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Diesel", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Dsqaured2", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Farah", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Farah Golf", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Firetrap", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Fossil", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Hugo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "J. Lindeberg", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "J. Lindeberg Golf ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Jack and Jones", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Jack Wills", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Lacoste", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Nike", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Paul Smith", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Ray-Ban", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Ted Baker", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Umbro", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Under armour", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Vans ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesBrandData->toArray());

        // for accessories color
        $accessoriesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 7,
            "name" => "Color", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesColorData = collect([
            ["sub_category_property_id" => $accessoriesColor, "name" => "Beige", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Black", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Blue and Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Brown", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Burgundy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Cream and Knitwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Gold", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Green", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Khaki", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Lilac and Tops", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Mint", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Mustard and Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Navy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Nude", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Orange", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Pink", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Purple", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Red", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Silver", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Tan", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Turqouise", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Multi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesColor, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($accessoriesColorData->toArray());

        // for shoes condition
        $accessoriesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 7,
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

        
    }
}
