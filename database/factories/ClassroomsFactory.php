<?php

namespace Database\Factories;

use App\Models\Classrooms;
use App\Models\Semesters;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Classrooms>
 */
class ClassroomsFactory extends Factory
{
    protected $model = Classrooms::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $classroomNames = [
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

        return [
            'name' => $this->faker->unique()->randomElement($classroomNames),
            'semesters_id' => function () {
                return Semesters::inRandomOrder()->first()->id;
            },
        ];
    }

    // public function definition(): array
    // {
    //     return [
    //         'name' => $this->faker->word,
    //         'semesters_id' => Semesters::inRandomOrder()->first()->id,
    //     ];
    // }
}
