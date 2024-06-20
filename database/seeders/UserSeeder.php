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
        // Schema::create('users', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->string('email')->unique();
        //     $table->timestamp('email_verified_at')->nullable();
        //     $table->string('password');
        //     $table->rememberToken();
        //     $table->timestamps();
        // });

        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
            ],
            [
                'name' => 'Admin2',
                'email' => 'admin2@gmai.com',
                'email_verified_at' => now(),
                'password' => Hash::make('pass'),
            ]
        ]);

        // Schema::create('profiles', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

        //     $table->string('first_name')->nullable();
        //     $table->string('last_name')->nullable();
        //     $table->string('email');
        //     $table->string('image')->nullable();
        //     $table->string('about')->nullable();
        //     $table->date('date_of_birth')->nullable();
        //     $table->string('phone')->nullable();
        //     $table->string('country')->nullable();
        //     $table->string('mailing_address')->nullable();

        //     $table->enum('status', ['Pending', 'Active', 'Blocked'])->default('Pending');
        //     $table->tinyInteger('is_deleted')->nullable()->default(0);
        //     $table->timestamps();
        // });

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
