<?php

namespace Database\Factories;

use App\Models\Classrooms;
use App\Models\EducationLevels;
use App\Models\FilesUploads;
use App\Models\Students;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Students>
 */
class StudentsFactory extends Factory
{
    protected $model = Students::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Ambil IDs dari education levels dan classrooms
        $educationLevelIds = EducationLevels::inRandomOrder()->first()->id;
        $classroomIds = Classrooms::inRandomOrder()->first()->id;

        // Ambil pengguna dengan peran siswa (roles_id = 3)
        $studentUsers = User::whereHas('roles', function ($query) {
            $query->where('level', 'siswa');
        })->pluck('id')->unique()->toArray();

        // Pastikan hanya 15 user yang dipilih
        $selectedUserIds = array_slice($studentUsers, 0, 15);

        return [
            'name' => $this->faker->name,
            'nik' => $this->faker->unique()->numerify('################'),
            'noAkteLahir' => $this->faker->unique()->numerify('##########'),
            'nis' => $this->faker->unique()->numerify('#####'),
            'nisn' => $this->faker->unique()->numerify('##########'),
            'noHP' => $this->faker->numerify('+##############'),
            'agama' => $this->faker->randomElement(['islam', 'kristen', 'katolik', 'buddha', 'hindu', 'khonghucu']),
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'dateOfBirth' => $this->faker->date,
            'address' => $this->faker->address,
            'status' => $this->faker->randomElement(['active', 'non-active']),
            'education_levels_id' => $educationLevelIds,
            'classrooms_id' => $classroomIds,
            'users_id' => function () use ($selectedUserIds) {
                return $this->faker->unique()->randomElement($selectedUserIds);
            },
            'files_uploads_id' => $this->faker->unique()->numberBetween(1, 30),
        ];
    }
}
