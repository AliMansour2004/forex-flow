<?php

namespace Database\Seeders;

use App\Models\BrokerBonus;
use Illuminate\Database\Seeder;

class BrokerBonusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['active_member_count' => 5, 'bonus_per_member_per_month' => 2.4],
            ['active_member_count' => 10, 'bonus_per_member_per_month' => 2.7],
            ['active_member_count' => 15, 'bonus_per_member_per_month' => 3.0],
            ['active_member_count' => 20, 'bonus_per_member_per_month' => 3.3],
            ['active_member_count' => 25, 'bonus_per_member_per_month' => 3.6],
            ['active_member_count' => 30, 'bonus_per_member_per_month' => 3.9],
            ['active_member_count' => 35, 'bonus_per_member_per_month' => 4.11],
            ['active_member_count' => 40, 'bonus_per_member_per_month' => 4.275],
            ['active_member_count' => 45, 'bonus_per_member_per_month' => 4.4],
            ['active_member_count' => 50, 'bonus_per_member_per_month' => 4.5],
        ];

        foreach ($data as $row) {
            BrokerBonus::create($row);
        }
    }
}
