<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class WomenCategorySeeder extends Seeder
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
            "sub_category_id" => 1,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothingOptionData = collect([
                ["sub_category_property_id" => $clothingOption, "name" => "Activewear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Blazers", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Coats and Jackets", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Dresses", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Jeans", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Jumpers and Knitwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Jumpsuits and Playsuits", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Loungewear", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Maternity", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Shirts and Tops", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Skirts", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Trousers and Leggings", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Abaya", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Hijab", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Bridal", "status" => 1, "created_at" => now(), "updated_at" => now()],
                ["sub_category_property_id" => $clothingOption, "name" => "Occasionwear", "status" => 1, "created_at" => now(), "updated_at" => now()],
            
        ]);

        SubCategoryPropertyValue::insert($clothingOptionData->toArray());

        // for clothes color
        $clothesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 1,
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
            "sub_category_id" => 1,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesSizeData = collect([
            ["sub_category_property_id" => $clothesSize, "name" => "XS", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "S", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "L", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "XXL", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "XXXL", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 4", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 6", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 8", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 10", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 12", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 14", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 16", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 18", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 20", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesSize, "name" => "UK 22", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($clothesSizeData->toArray());

        // for clothes brand
        $clothesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 1,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $clothesBrandData = collect([
            ["sub_category_property_id" => $clothesBrand, "name" => "Adidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "All Saints", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Arni", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Banana Republic", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Beach City", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Boden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Calvin Klein", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Chicos", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Country Road", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "French Connection", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Gant", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Guess", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "H&M", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Hobbs", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "J. Crew", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Jasper Conran London", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Jigsaw", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "La Chique", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "L'couture", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Levi", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Lipsy", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Mango", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Michael Kors", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Mint Velvet", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Monsoon", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Never Fully Dressed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Nike", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Pretty Little Thing", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Rat & Bou", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Reiss", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "River Island", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Seed Heritge", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "The Giving Movement", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Whistles", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "White Company", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Witchery", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Zara", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $clothesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($clothesBrandData->toArray());

        // for clothes condition
        $clothesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 1,
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
            "sub_category_id" => 2,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesOptionData = collect([
            ["sub_category_property_id" => $shoesOption, "name" => "Boots", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Flats", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Heels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Sandals ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesOption, "name" => "Trainers ", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($shoesOptionData->toArray());

        // for shoes size
        $shoesSize = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 2,
            "name" => "Size", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesSizeData = collect([
            ["sub_category_property_id" => $shoesSize, "name" => "EU 36", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 36.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 37", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 37.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 38", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 38.5 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 39", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 39.5 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 40", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 40.5 ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 41", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesSize, "name" => "EU 41.5", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($shoesSizeData->toArray());

        // for shoes brands
        $shoesBrand = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 2,
            "name" => "Brands", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $shoesBrandData = collect([
            ["sub_category_property_id" => $shoesBrand, "name" => "Addidas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Aldo", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Carvela", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Dune", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ella", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Fitflop", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ginger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Havianas", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Kurt Geiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "New Balance", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Nike", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Public Desire", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Puma", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ralph Lauren", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Steve Madden", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ted Baker", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Tommy Hilfiger", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Ugg", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $shoesBrand, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($shoesBrandData->toArray());

        // for shoes color
        $shoesColor = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 2,
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
            "sub_category_id" => 2,
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
         * Bags
         */

        // for category/bags option
        $bagsOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 3,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bagsOptionData = collect([
            ["sub_category_property_id" => $bagsOption, "name" => "Clutch Bag", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsOption, "name" => "Handbag", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsOption, "name" => "Travel Bags", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsOption, "name" => "Purses", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsOption, "name" => "Sport ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsOption, "name" => "Other ", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($bagsOptionData->toArray());

        // for bags condition
        $bagsCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 3,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $bagsConditionData = collect([
            ["sub_category_property_id" => $bagsCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $bagsCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($bagsConditionData->toArray());

        /**
         * Accessories
         */

        // for accessories option
        $accessoriesOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 4,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $accessoriesOptionData = collect([
            ["sub_category_property_id" => $accessoriesOption, "name" => "Hats", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Jewellery", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Sunglasses", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Sport", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Golf ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Padel Tennis ", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $accessoriesOption, "name" => "Other ", "status" => 1, "created_at" => now(), "updated_at" => now()]
        ]);

        SubCategoryPropertyValue::insert($accessoriesOptionData->toArray());

        // for accessories condition
        $accessoriesCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 4,
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
