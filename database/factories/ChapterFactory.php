<?php

namespace Database\Factories;

use App\Models\Course;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Chapter>
 */
class ChapterFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'course_id' => '1',
            'title' => $this->faker->sentence,
            'sub_title' => $this->faker->sentence,
            'description' => $this->faker->paragraph,
            'estimated_time' => $this->faker->time,
            'image_url' => $this->faker->imageUrl,
        ];
    }
}
