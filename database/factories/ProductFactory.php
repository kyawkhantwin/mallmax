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
            'category_id' => fake()-> numberBetween(1,10),
            'brand_id' => fake() ->  numberBetween(1,10),
            'name' => fake()-> name,
            'slug' => fake()->unique()->slug(),
            'description' => fake()-> text,
            'image' => 'smartwatch.webp',
            'total_qty' => fake()-> randomNumber(),
            'sale_price' => fake()->randomNumber(),
            'discount_price' => fake()->randomNumber(),
        ];
    }
}
