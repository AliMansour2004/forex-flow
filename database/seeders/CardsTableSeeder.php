<?php

namespace Database\Seeders;

use App\Models\Card;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CardsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Card::create(['amount' => 30, 'duration' => 1, 'discount' => 0, 'broker_percentage' => 20, 'broker_profit_cost' => 6]);
        Card::create(['amount' => 90, 'duration' => 3, 'discount' => 20, 'broker_percentage' => 20, 'broker_profit_cost' => 6]);
        Card::create(['amount' => 180, 'duration' => 6, 'discount' => 20, 'broker_percentage' => 20, 'broker_profit_cost' => 6]);
    }
}
