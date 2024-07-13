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
        Schema::create('form_ortu_wali', function (Blueprint $table) {
            $table->id();
            $table->string('name_bapak_wali');
            $table->string('nik_bapak_wali');
            $table->string('name_ibu_wali');
            $table->string('nik_ibu_wali');
            $table->string('noHP');
            $table->text('address');
            $table->string('pekerjaan_bapak_wali');
            $table->string('pekerjaan_ibu_wali');

            $table->unsignedBigInteger('form_siswa_id');
            $table->foreign('form_siswa_id')->references('id')->on('form_siswa')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_ortu_wali');
    }
};
