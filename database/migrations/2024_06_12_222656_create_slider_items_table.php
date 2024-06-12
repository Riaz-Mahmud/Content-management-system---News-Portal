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
        Schema::create('slider_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('slider_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('label')->nullable();
            $table->text('description')->nullable();

            $table->string('src')->nullable();
            $table->string('thumbnail')->nullable();

            $table->foreignId('newses_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('font_family')->nullable();
            $table->string('font_size')->nullable();
            $table->string('font_color')->nullable();

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
        Schema::dropIfExists('slider_items');
    }
};
