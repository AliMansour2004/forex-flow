<?php

namespace Database\Seeders;

use App\Models\MoneyTransferCompany;
use Illuminate\Database\Seeder;

class MoneyTransferCompanySeeder extends Seeder
{
    /**
     * Seed the MoneyTransferCompany table.
     *
     * @return void
     */
    public function run()
    {
        MoneyTransferCompany::create(['name' => 'Whish']);
        MoneyTransferCompany::create(['name' => 'OMT']);
        MoneyTransferCompany::create(['name' => 'Crypto']);
    }
}
