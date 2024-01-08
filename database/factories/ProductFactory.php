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
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->word,
            'brand' => $this->faker->word,
            'price' => $this->faker->numberBetween(50, 999),
            'old_price' => $this->faker->numberBetween(50, 999),
            'image_id' => $this->faker->numberBetween(2, 6),
        ];
    }
}
