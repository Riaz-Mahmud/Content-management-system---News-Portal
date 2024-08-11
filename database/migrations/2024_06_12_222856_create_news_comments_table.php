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
        Schema::create('news_comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('newses_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('name')->nullable();
            $table->text('content')->nullable();
            $table->string('image')->nullable();
            $table->string('video')->nullable();

            $table->enum('status', ['Active', 'Pending', 'Inactive'])->default('Active');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('news_comments');
    }
};
