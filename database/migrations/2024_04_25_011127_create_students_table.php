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
            $table->string('nik', 16);
            $table->string('noAkteLahir', 10);
            $table->string('nis', 5);
            $table->string('nisn', 10);
            $table->string('noHP', 15);
            $table->enum('agama', ['islam', 'kristen', 'katolik', 'buddha', 'hindu', 'khonghucu']);
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->date('dateOfBirth');
            $table->text('address');
            $table->string('image');
            $table->enum('status', ['active', 'non-active'])->default('active');

            $table->unsignedBigInteger('education_levels_id');
            $table->foreign('education_levels_id')
                ->references('id')->on('education_levels')->cascadeOnDelete();

            $table->unsignedBigInteger('classrooms_id');
            $table->foreign('classrooms_id')
                ->references('id')->on('classrooms')->cascadeOnDelete();
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
