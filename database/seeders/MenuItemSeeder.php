<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('menu_items')->insert([
            [
                'menu_id' => 1,
                'label' => 'Home',
                'href' => '/',
                'parent_id' => null,
                'order' => 1,
                'icon' => 'fas fa-home',
                'description' => 'Home page',
                'status' => 'Active',
                'is_deleted' => 0,
            ],
            [
                'menu_id' => 1,
                'label' => 'About',
                'href' => '/about',
                'parent_id' => null,
                'order' => 2,
                'icon' => 'fas fa-info-circle',
                'description' => 'About page',
                'status' => 'Active',
                'is_deleted' => 0,
            ],
            [
                'menu_id' => 1,
                'label' => 'Contact',
                'href' => '/contact',
                'parent_id' => null,
                'order' => 4,
                'icon' => 'fas fa-envelope',
                'description' => 'Contact page',
                'status' => 'Active',
                'is_deleted' => 0,
            ],
        ]);
    }
}
