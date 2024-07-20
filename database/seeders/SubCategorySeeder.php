<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SubCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('sub_categories')->insert([
            'id' => 1,
            'category_id' => 1,
            'name' => 'Men Shoes'
        ]);

        DB::table('sub_categories')->insert([
            'id' => 2,
            'category_id' => 2,
            'name' => 'Womens Bag'
        ]);
    }
}
