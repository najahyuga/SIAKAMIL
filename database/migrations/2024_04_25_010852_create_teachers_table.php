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
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->text('address');
            // $table->string('gender', 10);
            $table->enum('gender', ['Laki-Laki', 'Perempuan']);
            $table->date('dateOfBirth');
            $table->enum('status', ['active', 'non-active'])->default('active');
            $table->string('experience')->nullable();

            $table->unsignedBigInteger('education_levels_id');
            $table->foreign('education_levels_id')->references('id')->on('education_levels')->cascadeOnDelete();

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('files_uploads_id');
            $table->foreign('files_uploads_id')->references('id')->on('files_uploads')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('teachers');
    }
};
