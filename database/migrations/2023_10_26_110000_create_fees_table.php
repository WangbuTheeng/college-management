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
        Schema::create('fees', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Tuition Fee", "Lab Fee"
            $table->decimal('amount', 10, 2); // Max 99,999,999.99
            $table->unsignedBigInteger('academic_year_id');
            $table->timestamps();

            $table->foreign('academic_year_id')
                  ->references('id')
                  ->on('academic_years')
                  ->onDelete('restrict'); // Prevent accidental deletion of fees

            // A fee name should be unique for a given academic year
            $table->unique(['name', 'academic_year_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fees');
    }
};
