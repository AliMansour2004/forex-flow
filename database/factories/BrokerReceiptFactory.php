<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrokerReceiptFactory extends Factory
{
    protected $model = \App\Models\BrokerReceipt::class;

    public function definition()
    {
        return [
            'our_company_money_account_id' => \App\Models\OurCompanyMoneyAccount::factory(),
            'broker_id' => \App\Models\User::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'receipt_at' => $this->faker->date(),
            'transaction_id' => $this->faker->uuid(),
            'added_by_user_id' => \App\Models\User::factory(),
        ];
    }
}
