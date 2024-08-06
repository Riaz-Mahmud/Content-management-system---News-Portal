<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
            ]
        ]);

        DB::table('profiles')->insert([
            [
                'user_id' => 1,
                'first_name' => 'Admin',
                'last_name' => 'Admin',
                'email' => 'admin@gmail.com',
                'image' => 'null',
                'about' => 'Hi, I am Admin',
                'date_of_birth' => '1999-10-01',
                'phone' => '1234567890',
                'country' => 'United kingdom',
                'mailing_address' => 'London, United kingdom',

                'status' => 'Active',
            ],
            [
                'user_id' => 2,
                'first_name' => 'Admin2',
                'last_name' => 'Admin2',
                'email' => 'admin2@gmail.com',
                'image' => 'null',
                'about' => 'Hi, I am Admin2',
                'date_of_birth' => '1999-10-01',
                'phone' => '1234567890',
                'country' => 'United kingdom',
                'mailing_address' => 'London, United kingdom',
                'status' => 'Active',
            ]
        ]);
    }
}
