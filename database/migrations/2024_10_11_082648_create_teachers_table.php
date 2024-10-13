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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('gender')->nullable();
            $table->foreignId('ward_id')->constrained('wards');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('region_id')->constrained('regions');
            $table->string('street')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('role')->default('teacher');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->foreignId('school_id')->constrained('schools')->onDelete('cascade');
            $table->string('password')->nullable();
            $table->string('profile_picture')->nullable();
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            // Add unique constraint for the combination of first_name, middle_name, and last_name
            $table->unique(['first_name', 'middle_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->dropUnique(['first_name', 'middle_name', 'last_name']);
            $table->dropForeign(['school_registration_number']);
        });
        Schema::dropIfExists('teachers');
    }
};
