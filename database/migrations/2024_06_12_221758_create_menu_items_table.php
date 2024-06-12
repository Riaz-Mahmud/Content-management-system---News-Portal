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
        Schema::create('menu_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('label');
            $table->string('href')->nullable();
            $table->unsignedBigInteger('parent_id')->nullable()->default(null)->comment('Parent MenuItems id');
            $table->integer('order')->nullable()->default(0);
            $table->string('icon')->nullable();
            $table->string('description')->nullable();

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
        Schema::dropIfExists('menu_items');
    }
};
