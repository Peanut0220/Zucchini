<?php

namespace Database\Factories;

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
    public function definition(): array
    {
        return [
            'order_id' => $this->generateOrderId(),
            'user_id' => 'U00001',
            'final' => 100,
            'total' => 100,
            'tax' => 0,
            'discount' => 0
        ];
    }

    private function generateOrderId(): string
    {
        static $counter = 1;
        $prefix = 'OR';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
