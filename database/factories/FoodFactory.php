<?php

namespace Database\Factories;

use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Food>
 */
class FoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'food_id' => $this->generateFoodId(),
            'name' => $this->faker->text(30),
            'description' => $this->faker->text(100),
            'category_id' => $this->faker->randomElement(['CG00001', 'CG00002', 'CG00003', 'CG00004']),
            'price' => $this->faker->randomFloat(2, 1, 100),
            'image_path' => '/images/JQflGUWZuExtCu7qfziyxd5Q4VhrmFqcXpsssTKk.jpg'
        ];
    }

    /**
     * Generate a unique food ID.
     *
     * @return string
     */
    private function generateFoodId(): string
    {
        static $counter = 1;
        $prefix = 'F';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
