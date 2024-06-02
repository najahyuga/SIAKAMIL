<?php

namespace Database\Factories;

use App\Models\MasterCategoryCourses;
use App\Models\MasterCourses;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MasterCourses>
 */
class MasterCoursesFactory extends Factory
{
    protected $model = MasterCourses::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $category = $this->faker->randomElement(['Muatan Wajib', 'Muatan Pemberdayaan dan Keterampilan']);

        return [
            'name' => $this->faker->unique()->sentence(),
            'master_category_courses_id' => MasterCategoryCourses::where('name', $category)->firstOrFail()->id,
        ];
    }
}
