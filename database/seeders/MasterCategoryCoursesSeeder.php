<?php

namespace Database\Seeders;

use App\Models\MasterCategoryCourses;
use Illuminate\Database\Seeder;

class MasterCategoryCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MasterCategoryCourses::factory()->count(2)->create();
    }
}
