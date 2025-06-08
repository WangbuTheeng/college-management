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
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('guardian_name');
            $table->date('dob'); // Date of Birth
            $table->text('address')->nullable();
            // Consider adding other fields from User if students can also be users,
            // or a user_id foreign key if a student is always linked to a user account.
            // For now, keeping it as per the distinct list in the issue.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
