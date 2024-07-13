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
        Schema::create('tasks_details', function (Blueprint $table) {
            $table->id();
            $table->text('description')->nullable();
            $table->string('file');
            $table->float('result')->nullable();

            $table->unsignedBigInteger('students_id');
            $table->foreign('students_id')->references('id')->on('students')->cascadeOnDelete();

            $table->unsignedBigInteger('tasks_id');
            $table->foreign('tasks_id')->references('id')->on('tasks')->cascadeOnDelete();

            $table->timestamps();
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
