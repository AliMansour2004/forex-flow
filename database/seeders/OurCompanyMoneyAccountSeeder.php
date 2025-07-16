<?php

namespace Database\Seeders;

use App\Models\OurCompanyMoneyAccount;
use Illuminate\Database\Seeder;

class OurCompanyMoneyAccountSeeder extends Seeder
{
    /**
     * Seed the OurCompanyMoneyAccount table.
     *
     * @return void
     */
    public function run()
    {

        OurCompanyMoneyAccount::create([
            'money_transfer_company_id' => 1,
            'name' => 'forex flow',
            'phone_number' => '9613028521',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        OurCompanyMoneyAccount::create([
            'money_transfer_company_id' => 2,
            'name' => 'Ahmad Alameh',
            'phone_number' => '9613826886',
            'created_at' => now(),
            'updated_at' => now()
        ]);
        OurCompanyMoneyAccount::create([
            'money_transfer_company_id' => 3,
            'name' => 'TBD',
            'phone_number' => 'TBD',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}
