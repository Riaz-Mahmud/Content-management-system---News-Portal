<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            [
                'title' => 'Technology',
                'slug' => 'technology',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Lifestyle',
                'slug' => 'lifestyle',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Fashion',
                'slug' => 'fashion',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Health',
                'slug' => 'health',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Travel',
                'slug' => 'travel',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Food',
                'slug' => 'food',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Sports',
                'slug' => 'sports',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Entertainment',
                'slug' => 'entertainment',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Business',
                'slug' => 'business',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Science',
                'slug' => 'science',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Education',
                'slug' => 'education',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Automotive',
                'slug' => 'automotive',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Politics',
                'slug' => 'politics',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Real Estate',
                'slug' => 'real-estate',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Gaming',
                'slug' => 'gaming',
                'parent_id' => null,
                'star' => 1,
            ],
            [
                'title' => 'Others',
                'slug' => 'others',
                'parent_id' => null,
                'star' => 1,
            ],
        ]);
    }
}
