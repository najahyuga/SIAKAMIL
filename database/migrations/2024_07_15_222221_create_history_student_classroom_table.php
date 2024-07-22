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
        Schema::create('history_student_classroom', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('classrooms_id'); // Foreign Key to classrooms table
            $table->foreign('classrooms_id')->references('id')->on('classrooms')->cascadeOnDelete();

            $table->unsignedBigInteger('students_id'); // Foreign Key to students table
            $table->foreign('students_id')->references('id')->on('students')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('history_student_classroom');
    }
};
