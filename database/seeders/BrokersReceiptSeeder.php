<?php

namespace Database\Seeders;

use App\Models\BrokerReceipt;
use Illuminate\Database\Seeder;

class BrokersReceiptSeeder extends Seeder
{
    public function run()
    {
        BrokerReceipt::factory()->count(10)->create();
    }
}
