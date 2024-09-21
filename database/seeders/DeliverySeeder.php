<?php

namespace Database\Seeders;

use App\Models\Delivery;

use App\Models\Food;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => '12, jalan margosa 14/23h',
            'status' => 'Delivered',
            'rider' => 'FoodPanda',
            'order_id' => 'OR00001'
        ]);

        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => '12, jalan ara 11/2e',
            'status' => 'Delivering',
            'rider' => 'ShopeeFood',
            'order_id' => 'OR00002'
        ]);

        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => '10, jalan abc 11/2q',
            'status' => 'Pending',
            'rider' => 'Grab',
            'order_id' => 'OR00003'
        ]);

        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => '10, jalan ok 10/12a',
            'status' => 'Preparing',
            'rider' => 'FoodPanda',
            'order_id' => 'OR00004'
        ]);

        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => 'Floor 12, Harmoni Condominium, 552200',
            'status' => 'Pending',
            'rider' => 'FoodPanda',
            'order_id' => 'OR00005'
        ]);

        Delivery::factory()->create([
            'delivery_id' => $this->generateUniqueId(),
            'address' => '77, Jalan Margosa 1/1M',
            'status' => 'Pending',
            'rider' => 'Grab',
            'order_id' => 'OR00006'
        ]);
    }

    private static function generateUniqueId()
    {
        $prefix = 'D';
        $number = 1;

        $lastId = Delivery::orderBy('delivery_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->delivery_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
