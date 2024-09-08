<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetails>
 */
class OrderDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => 'F00001',
            'order_id' => '1',
            'price' => 1,
            'quantity' => $this->faker->numberBetween(1, 10),
            'subtotal' => 10

        ];
    }


}
