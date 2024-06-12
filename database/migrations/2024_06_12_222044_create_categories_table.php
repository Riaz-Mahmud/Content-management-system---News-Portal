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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();

            $table->string('title')->unique();
            $table->string('slug',)->unique();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null)->comment('Parent category id');
            $table->string('description')->nullable();
            $table->string('image')->nullable();

            $table->enum('status', ['Active', 'Inactive'])->default('Active');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
