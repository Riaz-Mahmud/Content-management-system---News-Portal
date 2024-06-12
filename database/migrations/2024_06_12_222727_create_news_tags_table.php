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
        Schema::create('news_tags', function (Blueprint $table) {
            $table->foreignId('newses_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('tags_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_tags');
    }
};
