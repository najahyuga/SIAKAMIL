<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormSiswa extends Model
{
    use HasFactory;

    protected $table = 'form_siswa';

    protected $fillable = [
        'name',
        'nis',
        'nisn',
        'nik',
        'noAkteLahir',
        'gender',
        'tempatLahir',
        'dateOfBirth',
        'agama',
        'anakKe',
        'jumlahSaudara',
        'address',
        'rt',
        'rw',
        'kelurahan',
        'kecamatan',
        'kab_kota',
        'kode_pos',
        'tempat_tinggal_bersama',
        'moda_tranportasi',
        'jarak_tempuh',
        'tb_cm',
        'bb_kg',
        'noHP',
        'email',
        'pekerjaan',
        'tgl_daftar',
        'status',
        'users_id',
        'files_uploads_id',
        'education_levels_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id');
    }

    public function files_uploads()
    {
        return $this->belongsTo(FilesUploads::class, 'files_id');
    }

    public function educationLevel()
    {
        return $this->belongsTo(EducationLevels::class, 'education_levels_id');
    }

    public function formOrtuWali()
    {
        return $this->hasOne(FormOrtuWali::class, 'form_siswa_id');
    }
}
