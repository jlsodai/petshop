<?php

namespace Database\Factories;

use App\Models\OrderStatus;
use App\Models\Payment;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $product = Product::inRandomOrder()->first();
        $qty = mt_rand(1, 5);
        $order_status = OrderStatus::inRandomOrder()->first();

        return [
            "user_id" => User::inRandomOrder()->first()->id,
            "order_status_id" => $order_status,
            "payment_id" => Payment::factory()->create()->id,
            "products" => [[
                "uuid" => $product->uuid,
                "qty" => $qty
            ]],
            "address" => [
                "billing" => fake()->streetAddress,
                "shipping" => fake()->streetAddress(),
            ],
            "amount" => $product->price * $qty,
            "shipped_at" => $order_status->title == "shipped" ? now() : null
        ];
    }
}
