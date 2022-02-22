<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $categories = array("Drugs", "Food", "Supplies");
        return [
            'category' => array_rand($categories, 1),
            'uuid' => Str::uuid(),
            'title' => $this->faker->text(10),
            'price' => $this->faker->numberBetween(1000, 50000),
            'description' => $this->faker->text(100),
            'metadata' => [
                'image' => $this->faker->imageUrl()
            ],
        ];
    }
}
