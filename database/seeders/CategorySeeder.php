<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
