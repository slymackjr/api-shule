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
        Schema::create('student_parents', function (Blueprint $table) {
            $table->id();
            $table->string('pupil_registration_number');
            $table->boolean('payment_status')->default(false);
            $table->string('term');
            $table->foreignId('pupil_id')->constrained('pupils')->onDelete('cascade');
            $table->foreignId('parent_id')->constrained('parents')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('student_parents', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['parent_id']);
        });
        Schema::dropIfExists('student_parents');
    }
};
