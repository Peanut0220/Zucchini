<?php

namespace Database\Seeders;

use App\Models\Food;
use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00012',
            'payment_type' => 'Cash On Delivery',
            'final' => '53',
            'total' => '50',
            'tax' => '3',
            'discount' => 0
        ]);

        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00012',
            'payment_type' => 'Ewallet',
            'final' => '25.44',
            'total' => '24',
            'tax' => '1.44',
            'discount' => 0
        ]);

        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00012',
            'payment_type' => 'Cash On Delivery',
            'final' => '6.31',
            'total' => '7',
            'tax' => '0.36',
            'discount' => 1.05
        ]);

        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00013',
            'payment_type' => 'Ewallet',
            'final' => '24.38',
            'total' => '23',
            'tax' => '1.38',
            'discount' => 0
        ]);

        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00013',
            'payment_type' => 'Credit Card',
            'final' => '26.50',
            'total' => '25.00',
            'tax' => '1.50',
            'discount' => 0
        ]);

        Order::factory()->create([
            'order_id' => $this->generateUniqueId(),
            'user_id' => 'U00013',
            'payment_type' => 'Cash On Delivery',
            'final' => '62.54',
            'total' => '59.00',
            'tax' => '3.54',
            'discount' => 0
        ]);


    }

    private static function generateUniqueId()
    {
        $prefix = 'OR';
        $number = 1;

        $lastId = Order::orderBy('order_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->order_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
