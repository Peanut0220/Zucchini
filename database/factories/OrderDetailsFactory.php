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
            'orderDetail_id' => $this->generateOrderDetailId(),
            'food_id' => 'F00001',
            'order_id' => 'OR00001',
            'price' => 1,
            'quantity' => $this->faker->numberBetween(1, 10),
            'subtotal' => 10

        ];
    }

    private function generateOrderDetailId(): string
    {
        static $counter = 1;
        $prefix = 'OD';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }


}
