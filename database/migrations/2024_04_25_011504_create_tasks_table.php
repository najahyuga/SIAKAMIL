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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->timestamp('deadline');
            $table->string('file');

            $table->unsignedBigInteger('courses_id');
            $table->foreign('courses_id')
                ->references('id')->on('courses')->cascadeOnDelete();

            $table->unsignedBigInteger('master_courses_id');
            $table->foreign('master_courses_id')->references('id')->on('master_courses')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tasks');
    }
};
