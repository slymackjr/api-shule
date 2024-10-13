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
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->integer('score');
            $table->string('remark');
            $table->foreignId('pupil_id')->constrained('pupils')->onDelete('cascade');
            $table->char('grade', 1);
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('subject_stream_id')->constrained('subject_streams')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('results', function (Blueprint $table) {
            $table->dropForeign(['pupil_id']);
            $table->dropForeign(['exam_id']);
            $table->dropForeign(['subject_stream_id']);
        });
        Schema::dropIfExists('results');
    }
};
