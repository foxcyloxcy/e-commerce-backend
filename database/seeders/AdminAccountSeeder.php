<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\AdminUser;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class AdminAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('admin_users')->insert([
            'id' => 1,
            'uuid' => Uuid::generate(),
            'first_name' => 'Lucky',
            'last_name' => 'Llemos',
            'email' => 'potandglai@gmail.com',
            'mobile_number' => '9095942202',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
