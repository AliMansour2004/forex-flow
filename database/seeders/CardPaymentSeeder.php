<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CardPaymentSeeder extends Seeder
{
    public function run()
    {
        \App\Models\CardPayment::factory()->count(10)->create();
    }
}
