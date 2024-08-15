<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // truncate all
        SubCategory::truncate();
        SubCategoryProperty::truncate();
        SubCategoryPropertyValue::truncate();

        $women = collect([
            ["id" => 1, "category_id" => 1, "name" => "Clothes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 2, "category_id" => 1, "name" => "Shoes",  "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 3, "category_id" => 1, "name" => "Bags",  "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 4, "category_id" => 1, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        $men = collect([
            ["id" => 5, "category_id" => 2,"name" => "Clothes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 6, "category_id" => 2, "name" => "Shoes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 7, "category_id" => 2, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]); 

        $babyAndChildren = collect([
            ["id" => 8, "category_id" => 3, "name" => "Baby Clothes (0-4yrs)", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 9, "category_id" => 3, "name" => "Girls Clothing", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 10, "category_id" => 3, "name" => "Boys Clothing", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 11, "category_id" => 3, "name" => "Teenage Girls Clothes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 12, "category_id" => 3, "name" => "Teenage Boys Clothes", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 13, "category_id" => 3, "name" => "Toys and Games", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 14, "category_id" => 3, "name" => "Baby Care", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["id" => 15, "category_id" => 3, "name" => "Buggies and Travel", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

      

        $data = $women->merge($men)
                ->merge($babyAndChildren);
                // ->merge($furniture);

        SubCategory::insert($data->toArray());

        
      
    }
}
