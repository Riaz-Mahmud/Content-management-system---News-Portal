<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menus')->insert(
            array(
                'label' => 'Main Menu',
                'href' => null,
                'description' => 'Home page menu',
                'status' => 'Active',
                'is_deleted' => 0,
            )
        );
    }
}
