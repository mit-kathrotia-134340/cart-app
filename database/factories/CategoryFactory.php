<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $status = ['active', 'inactive'];
        return [
            'title' => $this->faker->word,
            'description' => $this->faker->paragraph(2),
            'image' => $this->faker->filePath(),
            'status' => $this->faker->randomElement($status),
        ];
    }
}
