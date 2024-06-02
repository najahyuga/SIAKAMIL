<?php

namespace Database\Seeders;

use App\Models\FilesUploads;
use Illuminate\Database\Seeder;

class FilesUploadsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        FilesUploads::factory()->count(30)->create();
    }
}
