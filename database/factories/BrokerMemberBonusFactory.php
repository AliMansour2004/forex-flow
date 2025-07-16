<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BrokerMemberBonusFactory extends Factory
{
    protected $model = \App\Models\BrokerMemberBonus::class;

    public function definition()
    {
        return [
            'broker_id' => \App\Models\User::factory()->state(['role' => 'broker']),
            'member_count' => $this->faker->numberBetween(1, 100),
            'bonus_per_member_per_month' => $this->faker->randomFloat(2, 5, 50),
            'entitlement_at' => $this->faker->date(),
            'next_entitlement_at' => $this->faker->date(),
            'entitlement_amount' => $this->faker->randomFloat(2, 100, 1000),
        ];
    }
}
