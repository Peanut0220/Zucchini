<?php

namespace Database\Seeders;

use App\Models\OrderDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00001',
            'order_id' => 'OR00001',
            'price' => 12,
            'quantity' => 2,
            'subtotal' => 24

        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00002',
            'order_id' => 'OR00001',
            'price' => 13,
            'quantity' => 2,
            'subtotal' => 26

        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00003',
            'order_id' => 'OR00002',
            'price' => 24,
            'quantity' => 1,
            'subtotal' => 24

        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00004',
            'order_id' => 'OR00003',
            'price' => 7,
            'quantity' => 1,
            'subtotal' => 7
        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00007',
            'order_id' => 'OR00004',
            'price' => 11,
            'quantity' => 1,
            'subtotal' => 11
        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00006',
            'order_id' => 'OR00004',
            'price' => 12,
            'quantity' => 1,
            'subtotal' => 12
        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00008',
            'order_id' => 'OR00005',
            'price' => 12.50,
            'quantity' => 2,
            'subtotal' => 25.00
        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00010',
            'order_id' => 'OR00006',
            'price' => 11.00,
            'quantity' => 1,
            'subtotal' => 11.00
        ]);

        OrderDetails::factory()->create([
            'orderDetail_id' => $this->generateUniqueId(),
            'food_id' => 'F00003',
            'order_id' => 'OR00006',
            'price' => 24.00,
            'quantity' => 2,
            'subtotal' => 48.00
        ]);
    }

    private static function generateUniqueId()
    {
        $prefix = 'OD';
        $number = 1;

        $lastId = OrderDetails::orderBy('orderDetail_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->orderDetail_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
