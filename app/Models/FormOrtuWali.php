<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FormOrtuWali extends Model
{
    use HasFactory;

    protected $table = 'form_ortu_wali';

    protected $fillable = [
        'name_bapak_wali',
        'nik_bapak_wali',
        'name_ibu_wali',
        'nik_ibu_wali',
        'noHP',
        'address',
        'pekerjaan_bapak_wali',
        'pekerjaan_ibu_wali',
        'form_siswa_id',
    ];

    public function formSiswa()
    {
        return $this->belongsTo(FormSiswa::class, 'form_siswa_id');
    }
}
