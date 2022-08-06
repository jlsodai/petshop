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
    public function definition()
    {
        return [
            "category_uuid" => Category::inRandomOrder()->first()->uuid,
            "title" => fake()->words(5, true),
            "price" => fake()->randomFloat(2, 10, 200),
            "description" => "",
            "metadata" => "{}",
        ];
    }
}
