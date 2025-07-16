<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\MemberSubscription;

class MemberSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        MemberSubscription::factory(10)->create();
    }
}
