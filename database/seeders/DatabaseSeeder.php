<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\CartDetails;
use App\Models\Category;
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
        // Create roles
        Role::create(['name' => 'customer']);
        Role::create(['name' => 'admin']);

        // Create multiple users
        \App\Models\User::factory(10)->create();

        // Create specific test user
        $testUser = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Create specific test user
        $testUser2 = \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test2@example.com',
        ]);

        // Create specific test user
        $testUser3 = \App\Models\User::factory()->create([
            'name' => 'Ng Chong Jian',
            'email' => 'test3@example.com',
        ]);

        $testUser3->assignRole('customer');
        $testUser2->assignRole('customer');
        // Assign admin role to the test user
        $testUser->assignRole('admin');

        // Assign customer role to all other users
        User::where('email', '!=', 'test@example.com')->get()->each(function ($user) {
            $user->assignRole('customer');
        });

        // Call other seeders
        $this->call([
            CategorySeeder::class,
            BanksSeeder::class,
            FoodSeeder::class,
            OrderSeeder::class,
            OrderDetailsSeeder::class,
            DeliverySeeder::class
        ]);


    }
}
