<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('settings_key')->unique();
            $table->text('settings_value')->nullable();

            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamps();
        });

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
                'settings_value' => 'info@ec.com',
            ],
            [
                'settings_key' => 'contact_us_address',
                'settings_value' => '123, Main Street, Dhaka, Bangladesh',
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
