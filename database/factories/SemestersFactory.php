<?php

namespace Database\Factories;

use App\Models\EducationLevels;
use App\Models\Semesters;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Semesters>
 */
class SemestersFactory extends Factory
{
    protected $model = Semesters::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $order = 0;
        $names = ['Semester 1 Ganjil', 'Semester 2 Genap'];
        $name = $names[$order % 2];
        $startDate = now()->addMonths($order * 6);
        $endDate = $startDate->copy()->addMonths(6);
        $educationLevelId = EducationLevels::inRandomOrder()->first()->id;

        $order++;

        return [
            'name' => $name,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'education_levels_id' => $educationLevelId,
        ];
    }
}
