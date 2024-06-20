<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('settings')->insert([
            [
                'settings_key' => 'facebook_icon',
                'settings_value' => 'fab fa-facebook-f',
            ],
            [
                'settings_key' => 'facebook_href',
                'settings_value' => 'https://www.facebook.com/',
            ],
            [
                'settings_key' => 'twitter_icon',
                'settings_value' => 'fab fa-twitter',
            ],
            [
                'settings_key' => 'twitter_href',
                'settings_value' => 'https://twitter.com/',
            ],
            [
                'settings_key' => 'instagram_icon',
                'settings_value' => 'fab fa-instagram',
            ],
            [
                'settings_key' => 'instagram_href',
                'settings_value' => 'https://www.instagram.com/',
            ],
            [
                'settings_key' => 'linkedin_icon',
                'settings_value' => 'fab fa-linkedin-in',
            ],
            [
                'settings_key' => 'linkedin_href',
                'settings_value' => 'https://www.linkedin.com/',
            ],
            [
                'settings_key' => 'youtube_icon',
                'settings_value' => 'fab fa-youtube',
            ],
            [
                'settings_key' => 'youtube_href',
                'settings_value' => 'https://www.youtube.com/',
            ],
            [
                'settings_key' => 'site_title',
                'settings_value' => 'Energy Chronicles',
            ],
            [
                'settings_key' => 'contact_us_phone',
                'settings_value' => '+1 234 567 890',
            ],
            [
                'settings_key' => 'contact_us_email',
                'settings_value' => 'info@newsportal.com',
            ],
            [
                'settings_key' => 'contact_us_address',
                'settings_value' => 'Cardiff, Wales, United Kingdom',
            ]
        ]);
    }
}
