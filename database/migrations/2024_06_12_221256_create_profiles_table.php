<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onUpdate('cascade')->onDelete('restrict');

            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('email');
            $table->string('image')->nullable();
            $table->string('about')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('phone')->nullable();
            $table->string('country')->nullable();
            $table->string('profession')->nullable();
            $table->string('field_of_profession')->nullable();
            $table->string('current_job')->nullable();
            $table->string('job_experience')->nullable();
            $table->string('mailing_address')->nullable();
            $table->string('organization')->nullable();
            $table->string('organization_address')->nullable();
            $table->string('lat')->nullable();
            $table->string('lng')->nullable();

            $table->enum('status', ['Pending', 'Active', 'Blocked'])->default('Pending');
            $table->tinyInteger('is_deleted')->nullable()->default(0);
            $table->timestamp('created_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
