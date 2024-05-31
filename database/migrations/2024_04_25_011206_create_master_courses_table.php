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
        Schema::create('master_courses', function (Blueprint $table) {
            $table->id();
            $table->string('name');

            $table->unsignedBigInteger('master_category_courses_id');
            $table->foreign('master_category_courses_id')->references('id')->on('master_category_courses')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_courses');
    }
};
