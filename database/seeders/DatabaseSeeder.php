<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CartDetails;
use App\Models\OrderDetails;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
         \App\Models\User::factory(10)->create();

         \App\Models\User::factory()->create([
             'name' => 'Test User',
             'email' => 'test@example.com',
         ]);
        Role::create(['name' => 'customer']);
        $this->call([
            FoodSeeder::class,
            OrderSeeder::class,
            DeliverySeeder::class,
            OrderDetailsSeeder::class,
            CartSeeder::class,
            CartDetailsSeeder::class

        ]);
    }
}
