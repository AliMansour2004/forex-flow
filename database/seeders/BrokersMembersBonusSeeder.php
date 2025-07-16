<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrokersMembersBonusSeeder extends Seeder
{
    public function run()
    {
        \App\Models\BrokerMemberBonus::factory()->count(10)->create();
    }
}
