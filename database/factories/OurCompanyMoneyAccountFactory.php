<?php

namespace Database\Factories;

use App\Models\MoneyTransferCompany;
use App\Models\OurCompanyMoneyAccount;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OurCompanyMoneyAccount>
 */
class OurCompanyMoneyAccountFactory extends Factory
{
    protected $model = OurCompanyMoneyAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'money_transfer_company_id' => MoneyTransferCompany::factory(),
            'name' => $this->faker->company,
            'phone_number' => $this->faker->unique()->phoneNumber,
        ];
    }
}
