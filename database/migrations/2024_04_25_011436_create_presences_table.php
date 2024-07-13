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
        Schema::create('presences', function (Blueprint $table) {
            $table->id();
            $table->date('deadline');

            $table->unsignedBigInteger('courses_id');
            $table->foreign('courses_id')
                ->references('id')->on('courses')->cascadeOnDelete();

            $table->unsignedBigInteger('created_by'); // ID yang membuat daftar presensi
            $table->foreign('created_by')
                ->references('id')->on('users')->cascadeOnDelete();
            $table->boolean('is_for_teacher')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presences');
    }
};
