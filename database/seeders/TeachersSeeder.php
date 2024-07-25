<?php

namespace Database\Seeders;

use App\Models\Teachers;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TeachersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Teachers::factory(10)->create();

        Teachers::create([
            'name' => 'Agus Wahyudi',
            'address' => 'Keputih Tegal IV/28, Keputih, Surabaya',
            'gender' => 'Laki-Laki',
            'dateOfBirth' => '1975-04-06',
            'status' => 'active',
            'experience' => '10 years teaching experience',
            'education_levels_id' => 1, // Ganti dengan ID yang sesuai di tabel education_levels
            'users_id' => 1,
            'files_uploads_id' => $this->createFileUpload(), // Fungsi untuk mendapatkan ID file upload
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }

    private function createFileUpload()
    {
        // Pastikan ada file upload yang sudah ada dengan link yang diberikan
        $file = DB::table('files_uploads')->where('path', 'man.png')->first();

        if ($file) {
            return $file->id;
        }

        // Jika file upload tidak ditemukan, Anda dapat membuatnya atau menyesuaikan logika sesuai kebutuhan
        // Contoh menambahkan entri baru
        $fileId = DB::table('files_uploads')->insertGetId([
            'path' => 'man.png',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return $fileId;
    }
}
