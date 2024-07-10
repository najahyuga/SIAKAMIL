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
        Schema::create('presence_details', function (Blueprint $table) {
            $table->id();
            $table->enum('status', ['hadir', 'alpha', 'sakit', 'izin']);

            $table->unsignedBigInteger('presences_id');
            $table->foreign('presences_id')
                ->references('id')->on('presences')->cascadeOnDelete();

            $table->unsignedBigInteger('students_id');
            $table->foreign('students_id')->references('id')->on('students')->cascadeOnDelete();
    
            $table->boolean('marked_by_teacher')->default(false); // Menandakan presensi dilakukan oleh guru
            $table->date('presence_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('presence_details');
    }
};
