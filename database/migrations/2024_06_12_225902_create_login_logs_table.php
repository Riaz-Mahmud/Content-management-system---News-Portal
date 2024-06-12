<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('login_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('ip_address')->nullable();
            $table->string('user_agent')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->enum('platform' , ['Windows', 'Mac', 'Linux', 'Android', 'iOS', 'Other'])->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('latitude')->nullable();
            $table->string('longitude')->nullable();
            $table->string('timezone')->nullable();
            $table->string('postal_code')->nullable();

            $table->enum('status', ['Active', 'Blocked'])->default('Active');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('login_logs');
    }
};
