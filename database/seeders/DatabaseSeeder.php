<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CartDetails;
use App\Models\OrderDetails;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create multiple users
        \App\Models\User::factory(10)->create();

        // Create specific test user
        $testUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create roles
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'admin']);

        // Assign admin role to the test user
        $testUser->assignRole('admin');

        // Assign customer role to all other users
        User::where('email', '!=', 'test@example.com')->get()->each(function ($user) {
            $user->assignRole('customer');
        });

        // Call other seeders
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
