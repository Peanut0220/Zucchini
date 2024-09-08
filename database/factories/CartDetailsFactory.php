<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CartDetails>
 */
class CartDetailsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cartDetail_id' => $this->generateCartDetailId(),
            'food_id' => 'F00001',
            'cart_id' => 'C00001',
            'quantity' => 1,
            'subtotal' => 100
        ];
    }

    private function generateCartDetailId(): string
    {
        static $counter = 1;
        $prefix = 'CD';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
