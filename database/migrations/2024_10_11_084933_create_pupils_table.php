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
        Schema::create('pupils', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('middle_name');
            $table->string('last_name');
            $table->string('full_name')->virtualAs('concat(first_name, \'  \', middle_name, \'  \', last_name)')->nullable()->unique();
            $table->string('postal_address')->nullable();
            $table->foreignId('ward_id')->constrained('wards');
            $table->foreignId('district_id')->constrained('districts');
            $table->foreignId('region_id')->constrained('regions');
            $table->string('street')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->nullable()->unique();
            $table->string('gender');
            $table->string('pupil_reg_number')->unique()->index();
            $table->date('date_birth')->nullable();
            $table->foreignId('stream_id')->constrained('streams')->onDelete('cascade');
            $table->boolean('has_paid')->default(false);
            $table->boolean('is_active')->default(false);
            $table->timestamps();

            $table->unique(['first_name', 'middle_name', 'last_name']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pupils', function (Blueprint $table) {
            $table->dropUnique(['first_name', 'middle_name', 'last_name']);
            $table->dropForeign(['stream_id']);
        });
        Schema::dropIfExists('pupils');
    }
};
