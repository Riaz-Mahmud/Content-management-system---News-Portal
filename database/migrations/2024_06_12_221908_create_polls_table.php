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
        Schema::create('polls', function (Blueprint $table) {
            $table->id();

            $table->string('question');
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();
            $table->string('audio')->nullable();
            $table->string('file')->nullable();
            $table->string('link')->nullable();
            $table->string('icon')->nullable();
            $table->integer('order')->nullable()->default(0);

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
        Schema::dropIfExists('polls');
    }
};
