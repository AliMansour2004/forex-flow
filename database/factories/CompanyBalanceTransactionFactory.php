<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyBalanceTransactionFactory extends Factory
{
    protected $model = \App\Models\CompanyBalanceTransaction::class;

    public function definition()
    {
        return [
            'added_by_user_id' => \App\Models\User::factory(),
            'our_company_account_id' => \App\Models\OurCompanyMoneyAccount::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 1000),
            'reference_id' => $this->faker->word(),
            'date' => $this->faker->date(),
            'description' => $this->faker->text(),
        ];
    }
}
