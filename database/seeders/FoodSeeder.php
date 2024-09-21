<?php

namespace Database\Seeders;

use App\Models\Food;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Nasi Lemak',
            'description' => 'Malaysian Nasi Lemak',
            'category_id' => 'CG00001',
            'price' => 12,
            'image_path' => 'images/O1yPxqATJz4lFFFri8JMzK06g9rnBa7WHxF9eo92.jpg'
        ]);

        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Bolognese Spaghetti',
            'description' => 'Strong flavor spaghetti in town',
            'category_id' => 'CG00001',
            'price' => 13.00,
            'image_path' => 'images/kC7fQ3dQRLPq5KMlZuiM7bONwALp40ur0oovcHkS.jpg'
        ]);

        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Pepperoni Pizza',
            'description' => 'This pizza dough recipe is a quick-and-easy, no-rise dough made',
            'category_id' => 'CG00001',
            'price' => 24.00,
            'image_path' => 'images/dmpteVYi9Gp9GwDIYuWODkCDtqHfmlYTbyQPglV3.jpg'
        ]);

        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Orange Juice',
            'description' => 'Fresh squeezed juice',
            'category_id' => 'CG00002',
            'price' => 7.00,
            'image_path' => 'images/m4VPLozMrBaShvvDvxRbVmj1xylAmUlbMaDO4BIJ.jpg'
        ]);

        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Mixed Chips',
            'description' => 'Crunchy chips',
            'category_id' => 'CG00004',
            'price' => 15.00,
            'image_path' => 'images/Dqre15nFUh4kGDN8e9qWioEgZT0dXIVi1JEyuIRo.jpg'
        ]);

        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Healthy bun',
            'description' => 'Freshly baked bun',
            'category_id' => 'CG00003',
            'price' => 12.00,
            'image_path' => 'images/hfd5Gdjjdkyon7uYYd1WZaR1tF78BpgVuZec6g6k.jpg'
        ]);
        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Latte',
            'description' => 'Typical Latte',
            'category_id' => 'CG00002',
            'price' => 11.00,
            'image_path' => 'images/cWHAM14wDGRd1h8Alef1f6fgzN7rvUInWIF2TqiZ.jpg'
        ]);
        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'French Fries',
            'description' => 'A popular bites',
            'category_id' => 'CG00003',
            'price' => 12.50,
            'image_path' => 'images/fizIDfYxOJTRbCSdazV2R14jvVS6PBVKxr3H23qp.jpg'
        ]);
        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'American Burger',
            'description' => 'Flavorful burger',
            'category_id' => 'CG00001',
            'price' => 15.00,
            'image_path' => 'images/BEQzmnYk5hOgdrdmUOnXTZGxKeQ2cZj03j5CVNef.jpg'
        ]);
        Food::factory()->create([
            'food_id' => $this->generateUniqueId(),
            'name' => 'Cookies',
            'description' => 'Freshly baked cookies',
            'category_id' => 'CG00004',
            'price' => 11.00,
            'image_path' => 'images/Zaf0AxYdCSOHcyvmVjBGLCreAkSVvnPSQpyE5Nav.jpg'
        ]);



    }

    private static function generateUniqueId()
    {
        $prefix = 'F';
        $number = 1;

        $lastId = Food::orderBy('food_id', 'desc')->first();
        if ($lastId) {
            $number = (int)substr($lastId->food_id, strlen($prefix)) + 1;
        }

        return $prefix . str_pad($number, 5, '0', STR_PAD_LEFT);
    }
}
