<?php

namespace Database\Seeders;

use App\Models\Classrooms;
use App\Models\Semesters;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ClassroomsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $semesters = Semesters::all();

        $classrooms = [
            'Kelas 1 Paket A Setara SD',
            'Kelas 2 Paket A Setara SD',
            'Kelas 3 Paket A Setara SD',
            'Kelas 4 Paket A Setara SD',
            'Kelas 5 Paket A Setara SD',
            'Kelas 6 Paket A Setara SD',
            'Kelas 1 Paket B Setara SMP',
            'Kelas 2 Paket B Setara SMP',
            'Kelas 3 Paket B Setara SMP',
            'Kelas 1 Paket C Setara SMA',
            'Kelas 2 Paket C Setara SMA',
            'Kelas 3 Paket C Setara SMA',
        ];

        foreach ($classrooms as $classroomName) {
            $semestersCount = $semesters->count();
            $randomSemesterIds = $semesters->random(min(2, $semestersCount))->pluck('id')->toArray();

            foreach ($randomSemesterIds as $semesterId) {
                Classrooms::create([
                    'name' => $classroomName,
                    'semesters_id' => $semesterId,
                ]);
            }
        }

        // $faker = Faker::create(); // Inisialisasi faker

        // // Daftar nama kelas
        // $classNames = [
        //     'Kelas 1 Paket A Setara SD',
        //     'Kelas 2 Paket A Setara SD',
        //     'Kelas 3 Paket A Setara SD',
        //     'Kelas 4 Paket A Setara SD',
        //     'Kelas 5 Paket A Setara SD',
        //     'Kelas 6 Paket A Setara SD',
        //     'Kelas 1 Paket B Setara SMP',
        //     'Kelas 2 Paket B Setara SMP',
        //     'Kelas 3 Paket B Setara SMP',
        //     'Kelas 1 Paket C Setara SMA',
        //     'Kelas 2 Paket C Setara SMA',
        //     'Kelas 3 Paket C Setara SMA',
        // ];

        // $semesterIds = Semesters::pluck('id')->toArray();

        // foreach ($classNames as $className) {
        //     Classrooms::create([
        //         'name' => $className,
        //         'semesters_id' => $faker->randomElement($semesterIds),
        //     ]);
        // }
    }
}
