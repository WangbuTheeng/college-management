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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('enrollment_id'); // Links to student in a class
            $table->unsignedBigInteger('exam_id');
            $table->decimal('theory_marks', 8, 2)->nullable();
            $table->decimal('practical_marks', 8, 2)->nullable();
            // Consider adding a total_marks_obtained if it's frequently calculated
            $table->timestamps();

            $table->foreign('enrollment_id')
                  ->references('id')
                  ->on('enrollments')
                  ->onDelete('cascade');

            $table->foreign('exam_id')
                  ->references('id')
                  ->on('exams')
                  ->onDelete('cascade');

            // Unique constraint: a student should have one grade entry per exam for a specific enrollment.
            $table->unique(['enrollment_id', 'exam_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('grades');
    }
};
