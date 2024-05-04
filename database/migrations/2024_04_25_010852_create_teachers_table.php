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
            $table->string('image');
            $table->enum('status', ['active', 'non-active'])->default('active');

            $table->unsignedBigInteger('education_levels_id')->nullable();
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
        Schema::dropIfExists('teachers');
    }
};
