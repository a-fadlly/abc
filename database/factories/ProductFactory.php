<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'product_nu' => 'IPJ0' . fake()->unique()->numberBetween(100, 999),
            'name' => fake()->unique()->word(),
            'price' => fake()->numberBetween(1000, 10000)
        ];
    }
}
