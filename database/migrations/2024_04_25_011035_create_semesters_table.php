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
        Schema::create('semesters', function (Blueprint $table) {
            $table->id();
            // $table->string('name');
            $table->enum('name', ['Semester 1 Ganjil', 'Semester 2 Genap']);
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('education_levels_id');
            $table->foreign('education_levels_id')
                ->references('id')->on('education_levels')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('semesters');
    }
};
