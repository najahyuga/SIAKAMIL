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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('teachers_id');
            $table->foreign('teachers_id')
            ->references('id')->on('teachers')->cascadeOnDelete();

            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')
                ->references('id')->on('classrooms')->cascadeOnDelete();

            $table->unsignedBigInteger('category_courses_id');
            $table->foreign('category_courses_id')
                ->references('id')->on('category_courses')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
