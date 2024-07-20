<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Webpatser\Uuid\Uuid;

class UserAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'id' => 1,
            'uuid' => Uuid::generate(),
            'first_name' => 'Ian Joseph',
            'last_name' => 'Navarro',
            'email' => 'navarroian1991@gmail.com',
            'mobile_number' => '9171130042',
            'password' => Hash::make('password'),
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
