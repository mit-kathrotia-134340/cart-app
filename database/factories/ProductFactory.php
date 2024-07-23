<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
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
            'price' => $this->faker->randomFloat(2,0,200),
            'quantity' => $this->faker->randomDigit(),
            'status' => $this->faker->randomElement($status),
        ];
    }
}
