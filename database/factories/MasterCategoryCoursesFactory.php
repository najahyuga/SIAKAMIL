<?php

namespace Database\Factories;

use App\Models\MasterCategoryCourses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterCategoryCourses>
 */
class MasterCategoryCoursesFactory extends Factory
{
    protected $model = MasterCategoryCourses::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $names = ['muatan wajib', 'muatan pemberdayaan dan keterampilan'];
        return [
            'name' => $this->faker->randomElement($names),
        ];
    }
}
