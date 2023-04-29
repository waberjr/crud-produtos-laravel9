<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $name = fake()->sentence();
        return [
            'name' => $name,
            'slug' => Str::slug($name),
            'cover' => fake()->imageUrl(),
            'price' => fake()->randomFloat(2, 20, 30),
            'description' => fake()->sentence(),
            'stock' => fake()->randomDigit(),
        ];
    }
}
