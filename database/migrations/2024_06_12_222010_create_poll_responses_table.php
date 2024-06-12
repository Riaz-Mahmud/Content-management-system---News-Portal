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
        Schema::create('poll_responses', function (Blueprint $table) {
            $table->id();

            $table->foreignId('poll_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('poll_item_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->string('ip_address')->nullable();

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
        Schema::dropIfExists('poll_responses');
    }
};
