<?php

namespace Database\Seeders;

use App\Models\EducationLevels;
use Illuminate\Database\Seeder;

class EducationLevelsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educationLevels = ['Paket A Setara SD', 'Paket B Setara SMP', 'Paket C Setara SMA'];
        foreach ($educationLevels as $educationLevel) {
            EducationLevels::factory()->create(['name' => $educationLevel]);
        }
    }
}
