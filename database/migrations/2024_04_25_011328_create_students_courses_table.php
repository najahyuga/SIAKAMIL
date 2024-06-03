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
        Schema::create('students_courses', function (Blueprint $table) {
            $table->id();
            $table->float('result_value')->nullable();
            $table->enum('status', ['A', 'B', 'C', 'D', 'E', 'F'])->nullable();

            $table->unsignedBigInteger('students_id');
            $table->foreign('students_id')->references('id')->on('students');

            $table->unsignedBigInteger('courses_id');
            $table->foreign('courses_id')->references('id')->on('courses');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_courses');
    }
};
