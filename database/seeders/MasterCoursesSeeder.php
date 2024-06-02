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
            'Ilmu Pengetahuan Alam Fisika',
            'Ilmu Pengetahuan Alam Kimia',
            'Ilmu Pengetahuan Alam Biologi',
            'Ilmu Pengetahuan Sosial',
            'Ilmu Pengetahuan Sosial Sejarah',
            'Ilmu Pengetahuan Sosial Ekonomi',
            'Ilmu Pengetahuan Sosial Geografi',
            'Ilmu Pengetahuan Sosial Sosiologi',
            'Sejarah',
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
