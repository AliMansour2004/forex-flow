<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CompanyBalanceTransactionSeeder extends Seeder
{
    public function run()
    {
        \App\Models\CompanyBalanceTransaction::factory()->count(10)->create();
    }
}
