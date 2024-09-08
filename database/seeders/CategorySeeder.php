<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::factory()->create([
            'name' => 'Main Dish'
        ]);
        Category::factory()->create([
            'name' => 'Beverage'
        ]);
        Category::factory()->create([
            'name' => 'Side Dish'
        ]);
        Category::factory()->create([
            'name' => 'Snack'
        ]);

    }
}
