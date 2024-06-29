<?php

namespace Database\Factories;

use App\Models\Product;
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
        return  [
            'name' => fake()->name(),
            'category' => fake()->randomElement(['prod1','prod2']),
            'description' => fake()->name(),
            'image' => 'image.test.jpg',
            'date' => now(),
            'time' => '12:00pm'
        ];
    }
}
