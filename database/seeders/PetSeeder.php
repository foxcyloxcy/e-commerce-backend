<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubCategoryProperty;
use App\Models\SubCategoryPropertyValue;

class PetSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /**
         *  Birds
         */

        // for options
        $birdsOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 23,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $birdsOptionData = collect([
            ["sub_category_property_id" => $birdsOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($birdsOptionData->toArray());

         // for birds condition
         $birdsCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 23,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $birdsConditionData = collect([
            ["sub_category_property_id" => $birdsCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $birdsCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($birdsConditionData->toArray());

        /**
         *  Cats
         */

        // for options
        $catsOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 24,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $catsOptionData = collect([
            ["sub_category_property_id" => $catsOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($catsOptionData->toArray());

         // for cats condition
         $catsCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 24,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $catsConditionData = collect([
            ["sub_category_property_id" => $catsCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $catsCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($catsConditionData->toArray());

        /**
         *  Dogs
         */

        // for options
        $dogsOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 25,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $dogsOptionData = collect([
            ["sub_category_property_id" => $dogsOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($dogsOptionData->toArray());

         // for dogs condition
         $dogsCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 25,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $dogsConditionData = collect([
            ["sub_category_property_id" => $dogsCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $dogsCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($dogsConditionData->toArray());

        /**
         *  Fish
         */

        // for options
        $fishOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 26,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $fishOptionData = collect([
            ["sub_category_property_id" => $fishOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($fishOptionData->toArray());

         // for fish condition
         $fishCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 26,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $fishConditionData = collect([
            ["sub_category_property_id" => $fishCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $fishCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($fishConditionData->toArray());

        /**
         *  Tortoise
         */

        // for options
        $tortoiseOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 27,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tortoiseOptionData = collect([
            ["sub_category_property_id" => $tortoiseOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tortoiseOptionData->toArray());

         // for tortoise condition
         $tortoiseCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 27,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $tortoiseConditionData = collect([
            ["sub_category_property_id" => $tortoiseCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $tortoiseCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($tortoiseConditionData->toArray());

        /**
         *  Others
         */

        // for options
        $otherOption = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 28,
            "name" => "Categories", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $otherOptionData = collect([
            ["sub_category_property_id" => $otherOption, "name" => "Accessories", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $otherOption, "name" => "Bed", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $otherOption, "name" => "Bowls", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $otherOption, "name" => "Toys", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $otherOption, "name" => "Other", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($otherOptionData->toArray());

         // for other condition
         $othersCondition = DB::table('sub_category_properties')->insertGetId([
            "sub_category_id" => 28,
            "name" => "Condition", 
            "status" => 1,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        $othersConditionData = collect([
            ["sub_category_property_id" => $othersCondition, "name" => "New with labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $othersCondition, "name" => "New without labels", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $othersCondition, "name" => "Pre-loved good condition", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $othersCondition, "name" => "Pre-loved with defects", "status" => 1, "created_at" => now(), "updated_at" => now()],
            ["sub_category_property_id" => $othersCondition, "name" => "Pre-loved frequently used", "status" => 1, "created_at" => now(), "updated_at" => now()],
        ]);

        SubCategoryPropertyValue::insert($othersConditionData->toArray());
    }
}
