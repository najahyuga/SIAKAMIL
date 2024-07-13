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
        $categories = [
            'Muatan Wajib',
            'Muatan Pemberdayaan dan Keterampilan',
        ];

        foreach ($categories as $category) {
            MasterCategoryCourses::create([
                'name' => $category,
            ]);
        }
    }
}
