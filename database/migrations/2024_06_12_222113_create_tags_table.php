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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();

            $table->string('label')->unique();
            $table->string('description')->nullable();
            $table->string('image')->nullable();
            $table->integer('count')->default(0);

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
        Schema::dropIfExists('tags');
    }
};
