<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'delivery_id' => $this->generateDeliveryId(),
            'status' => $this->faker->randomElement(['pending', 'delivered', 'preparing', 'delivering']),
            'rider'=> $this->faker->randomElement(['Foodpanda', 'Grab', 'ShopeeFood', 'Lalamove']),
            'order_id' => 'OR00001'
        ];
    }

    private function generateDeliveryId(): string
    {
        static $counter = 1;
        $prefix = 'D';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
