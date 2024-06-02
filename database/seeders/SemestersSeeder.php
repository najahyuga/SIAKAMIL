<?php

namespace Database\Seeders;

use App\Models\Semesters;
use Illuminate\Database\Seeder;

class SemestersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Call factory to create 10 semester data
        Semesters::factory()->count(10)->create();
    }
}
