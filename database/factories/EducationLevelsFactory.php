<?php

namespace Database\Factories;

use App\Models\EducationLevels;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\EducationLevels>
 */
class EducationLevelsFactory extends Factory
{
    protected $model = EducationLevels::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $eduLevels = ['Paket A Setara SD', 'Paket B Setara SMP', 'Paket C Setara SMA'];
        return [
            'name' => $this->faker->randomElement($eduLevels)
        ];
    }
}
