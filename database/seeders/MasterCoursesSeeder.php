<?php

namespace Database\Seeders;

use App\Models\MasterCategoryCourses;
use App\Models\MasterCourses;
use Illuminate\Database\Seeder;

class MasterCoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $courses = [
            // Muatan Pemberdayaan dan Keterampilan
            'Pemberdayaan',
            'Keterampilan',
            // Muatan Wajib
            'Pendidikan Agama Islam dan Budi Pekerti',
            'Pendidikan Agama Kristen dan Budi Pekerti',
            'Pendidikan Agama Katolik dan Budi Pekerti',
            'Pendidikan Agama Buddha dan Budi Pekerti',
            'Pendidikan Agama Hindu dan Budi Pekerti',
            'Pendidikan Agama Khonghucu dan Budi Pekerti',
            'Pendidikan Pancasila',
            'Bahasa Indonesia',
            'Matematika',
            'Bahasa Inggris',
            'Ilmu Pengetahuan Alam',
            'Fisika',
            'Kimia',
            'Biologi',
            'Ilmu Pengetahuan Sosial',
            'Sejarah',
            'Ekonomi',
            'Geografi',
            'Sosiologi',
            'Sejarah Indonesia',
            'PJOK',
            'Seni dan Budaya',
        ];

        foreach ($courses as $course) {
            $category = $course === 'Pemberdayaan' || $course === 'Keterampilan' ? 'Muatan Pemberdayaan dan Keterampilan' : 'Muatan Wajib';

            MasterCourses::create([
                'name' => $course,
                'master_category_courses_id' => MasterCategoryCourses::where('name', $category)->firstOrFail()->id,
            ]);
        }
    }
}
