<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'cart_id' => $this->generateCartId(),
            'total' => 0,
            'user_id' => 'U00001'
        ];
    }

    private function generateCartId(): string
    {
        static $counter = 1;
        $prefix = 'C';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
