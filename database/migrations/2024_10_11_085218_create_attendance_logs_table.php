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
        Schema::create('attendence_logs', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_present');
            $table->date('date');
            $table->foreignId('pupil_id')->constrained('pupils')->onDelete('cascade');
            $table->foreignId('stream_id')->constrained('streams')->onDelete('cascade');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('attendence_logs', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['stream_id']);
        });
        Schema::dropIfExists('attendence_logs');
    }
};
