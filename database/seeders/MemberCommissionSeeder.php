<?php

namespace Database\Seeders;

use App\Models\MemberCommission;
use Illuminate\Database\Seeder;

class MemberCommissionSeeder extends Seeder
{
    public function run()
    {
        MemberCommission::factory()->count(10)->create();
    }
}
