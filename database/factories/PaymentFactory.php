<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $typeWithDetails = [
            "credit_card" => [
                "holder_name" => fake()->name,
                "number" => fake()->creditCardNumber,
                "ccv" => fake()->numberBetween(100, 999),
                "expire_date" => now()
            ],
            "cash_on_delivery" => [
                "first_name" => fake()->firstName,
                "last_name" => fake()->lastName,
                "address" => fake()->streetAddress
            ],
            "bank_transfer" => [
                "swift" => fake()->swiftBicNumber,
                "iban" => fake()->iban,
                "name" => fake()->company . " Bank"
            ]
        ];

        $type = array_rand($typeWithDetails);

        return [
            'type' => $type,
            'details' => $typeWithDetails[$type],
        ];
    }
}
