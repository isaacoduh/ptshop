<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::inRandomOrder()->first()->id,
            'order_statuses_id' => OrderStatus::inRandomOrder()->first()->id,
            'payment_id' => Payment::inRandomOrder()->first()->id,
            'uuid' => Str::uuid(),
            'products' => json_encode([
                [
                    'product' => Product::inRandomOrder()->first()->uuid,
                    'quantity' => $this->faker->numberBetween(1,10)
                ],
                [
                    'product' => Product::inRandomOrder()->first()->uuid,
                    'quantity' => $this->faker->numberBetween(1,10)
                ],
                [
                    'product' => Product::inRandomOrder()->first()->uuid,
                    'quantity' => $this->faker->numberBetween(1,10)
                ],
                [
                    'product' => Product::inRandomOrder()->first()->uuid,
                    'quantity' => $this->faker->numberBetween(1,10)
                ],
            ]),
            'address' => [
                'billing' => $this->faker->address,
                'address' => $this->faker->address,
            ],
            'delivery_fee' => $this->faker->numberBetween(400, 2000),
            'amount' => $this->faker->numberBetween(5000, 20000)
        ];
    }
}
