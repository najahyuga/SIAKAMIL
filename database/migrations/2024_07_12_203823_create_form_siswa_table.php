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
        Schema::create('form_siswa', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('nis');
            $table->string('nisn');
            $table->string('nik');
            $table->string('noAkteLahir');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->string('tempatLahir');
            $table->date('dateOfBirth');
            $table->enum('agama', ['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu', 'Lainnya']);
            $table->integer('anakKe');
            $table->integer('jumlahSaudara');
            $table->text('address');
            $table->string('rt');
            $table->string('rw');
            $table->string('kelurahan');
            $table->string('kecamatan');
            $table->string('kab_kota');
            $table->string('kode_pos');
            $table->enum('tempat_tinggal_bersama', ['Orang Tua', 'Wali', 'Kost', 'Asrama', 'Panti Asuhan', 'Lainnya']);
            $table->enum('moda_tranportasi', ['Jalan Kaki', 'Kendaraan Pribadi', 'Kendaraan Umum', 'Antar Jemput Sekolah', 'Lainnya']);
            $table->float('jarak_tempuh');
            $table->decimal('tb_cm', 5, 2);
            $table->decimal('bb_kg', 5, 2);
            $table->string('noHP');
            $table->string('email');
            $table->string('pekerjaan')->nullable();
            $table->date('tgl_daftar');
            $table->enum('status', ['data-terkirim', 'diterima', 'data-checking', 'daftar-ulang'])->default('data-terkirim');

            $table->unsignedBigInteger('users_id');
            $table->foreign('users_id')->references('id')->on('users')->cascadeOnDelete();

            $table->unsignedBigInteger('files_uploads_id');
            $table->foreign('files_uploads_id')->references('id')->on('files_uploads')->cascadeOnDelete();

            $table->unsignedBigInteger('education_levels_id');
            $table->foreign('education_levels_id')->references('id')->on('education_levels')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('form_siswa');
    }
};
