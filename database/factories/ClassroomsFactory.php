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
    public function definition(): array
    {
        return [
            'name' => $this->faker->word,
            'semesters_id' => Semesters::inRandomOrder()->first()->id,
        ];
    }
}
