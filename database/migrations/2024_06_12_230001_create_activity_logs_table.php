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
        Schema::create('activity_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->text('description')->nullable();
            $table->text('url')->nullable();
            $table->text('method')->nullable();
            $table->text('route')->nullable();

            $table->string('ip')->nullable();
            $table->text('ip_info')->nullable();
            $table->string('city')->nullable();
            $table->string('region')->nullable();
            $table->string('country')->nullable();
            $table->text('agent')->nullable();
            $table->text('device_data')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activity_logs');
    }
};
