<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CardPayment>
 */
class CardPaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'added_by_user_id' => \App\Models\User::factory(), // Random user who added the payment
            'broker_id' => \App\Models\User::factory(), // Random broker user
            'user_id' => \App\Models\User::factory(), // Random user making the payment
            'our_company_money_account_id' => \App\Models\OurCompanyMoneyAccount::factory(), // Money account reference
            'amount' => $this->faker->randomFloat(2, 30, 144), // Random float between 30 and 144
            'fees' => $this->faker->randomFloat(0.3, 0.6, 0.9),
            'duration' => $this->faker->randomElement([1, 3, 6]), // Random duration in months
            'discount' => $this->faker->randomFloat(2, 0, 20), // Random discount percentage (0-20%)
//            'cost' => $this->faker->randomFloat(2, 30, 144), // Random cost of the payment
            'purchased_at' => $this->faker->date(), // Random purchase date
            'finished_at' => $this->faker->date(), // Random purchase date
            'broker_profit_percentage' => $this->faker->randomFloat(2, 10, 50), // Random profit percentage (10-50%)
            'broker_profit_cost' => $this->faker->randomFloat(2, 1, 30), // Random profit cost
            'gross_profit' => $this->faker->randomFloat(2, 10, 50), // Random gross profit
            'transaction_id' => $this->faker->uuid(), // Random transaction ID
        ];
    }
}
