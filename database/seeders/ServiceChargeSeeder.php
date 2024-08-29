<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\ServiceCharge;

class ServiceChargeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ServiceCharge::truncate();

        DB::table('service_charges')->insert([
            'id' => 1,
            'system_fee' => 20,
            'updated_by' => 1,
            'status' => 1
        ]);
    }
}
