<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Card>
 */
class CardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'amount' => $this->faker->randomElement([30, 90, 180]),
            'duration' => $this->faker->randomElement([1, 3, 6]),
            'discount' => $this->faker->randomElement([0, 20]),
            'broker_percentage' => 20,
            'broker_profit_cost' => 6,
        ];
    }
}
