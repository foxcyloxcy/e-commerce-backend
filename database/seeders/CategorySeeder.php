<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        // truncate all
        Category::truncate();

        DB::table('categories')->insert([
            'id' => 1,
            'name' => 'Women'
        ]);

        DB::table('categories')->insert([
            'id' => 2,
            'name' => 'Men'
        ]);

        DB::table('categories')->insert([
            'id' => 3,
            'name' => 'Baby and Childred'
        ]);

        DB::table('categories')->insert([
            'id' => 4,
            'name' => 'Furniture and Home'
        ]);

        DB::table('categories')->insert([
            'id' => 5,
            'name' => 'Pets'
        ]);
    }
}
