<?php

namespace Database\Factories;

use App\Models\FilesUploads;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\FilesUploads>
 */
class FilesUploadsFactory extends Factory
{
    protected $model = FilesUploads::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate dummy path for image
        $path = $this->faker->imageUrl(600, 600);
        return [
            'path' => $path,
        ];
    }
}
