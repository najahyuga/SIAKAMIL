<?php

namespace Database\Factories;

use App\Models\EducationLevels;
use App\Models\FilesUploads;
use App\Models\Teachers;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeachersFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Teachers::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $educationLevelId = EducationLevels::inRandomOrder()->first()->id;

        // Pilih 5 user dengan role admin dan guru
        $adminGuruUserIds = User::whereHas('roles', function ($query) {
            $query->whereIn('level', ['admin', 'guru']);
        })->inRandomOrder()->limit(5)->pluck('id')->toArray();

        // Pilih 5 user dengan role guru
        $guruUserIds = User::whereHas('roles', function ($query) {
            $query->where('level', 'guru');
        })->inRandomOrder()->limit(5)->pluck('id')->toArray();

        $userIds = array_merge($adminGuruUserIds, $guruUserIds);

        $uniqueUserIds = array_unique($userIds);

        // Pastikan hanya 10 user yang dipilih
        $selectedUserIds = array_slice($uniqueUserIds, 0, 10);

        return [
            'name' => $this->faker->name,
            'address' => $this->faker->address,
            'gender' => $this->faker->randomElement(['Laki-Laki', 'Perempuan']),
            'dateOfBirth' => $this->faker->date,
            'status' => $this->faker->randomElement(['active', 'non-active']),
            'experience' => $this->faker->sentence,
            'education_levels_id' => $educationLevelId,
            'users_id' => function () use ($selectedUserIds) {
                return $this->faker->unique()->randomElement($selectedUserIds);
            },
            'files_uploads_id' => FilesUploads::factory(),
        ];
    }
}
