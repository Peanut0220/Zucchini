<?php

namespace Database\Seeders;

use App\Models\banks;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BanksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        banks::factory()->create([
            'card_number'=>'1111111111111111',
            'expiration_date'=> '12/20',
            'cvv'=>'123'
        ]);

        banks::factory()->create([
            'card_number'=>'2222222222222222',
            'expiration_date'=> '11/22',
            'cvv'=>'321'
        ]);

    }
}
