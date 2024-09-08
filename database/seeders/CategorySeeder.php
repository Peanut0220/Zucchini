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
            'category_id' => $this->generateCategoryId(),
            'name' => 'Main Dish'
        ]);
        Category::factory()->create([
            'category_id' => $this->generateCategoryId(),
            'name' => 'Beverage'
        ]);
        Category::factory()->create([
            'category_id' => $this->generateCategoryId(),
            'name' => 'Side Dish'
        ]);
        Category::factory()->create([
            'category_id' => $this->generateCategoryId(),
            'name' => 'Snack'
        ]);

    }

    private function generateCategoryId(): string
    {
        static $counter = 1;
        $prefix = 'CG';
        $id = $prefix . str_pad($counter++, 5, '0', STR_PAD_LEFT);
        return $id;
    }
}
