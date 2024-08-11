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
        Schema::create('newses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('content')->nullable();
            $table->string('image_src')->nullable();
            $table->string('attachment_src')->nullable();
            $table->enum('attachment_type', ['image', 'video', 'audio', 'file'])->nullable();

            $table->integer('comment_count')->default(0);
            $table->integer('view_count')->default(0);

            $table->enum('is_featured', ['yes', 'no'])->default('no');
            $table->enum('can_comment', ['yes', 'no'])->default('yes');

            $table->string('source_url')->nullable();
            $table->enum('source_backup', ['done', 'processing', 'pending','failed', 'queue'])->default('pending');

            $table->enum('status', ['Active', 'Pending', 'Inactive'])->default('Active');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamps();
        });

        Schema::create('categories_newses', function (Blueprint $table) {
            $table->foreignId('category_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
            $table->foreignId('newses_id')->constrained()->onUpdate('cascade')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newses');
    }
};
