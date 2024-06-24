<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SlideSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sliders')->insert(
            array(
                'label' => 'Home Page Slider',
                'description' => 'It will show on frontend home page slider',
                'status' => 'Active',
                'is_deleted' => 0,
            )
        );
    }
}
