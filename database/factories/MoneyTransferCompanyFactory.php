<?php

namespace Database\Factories;

use App\Models\MoneyTransferCompany;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\MoneyTransferCompany>
 */
class MoneyTransferCompanyFactory extends Factory
{
    protected $model = MoneyTransferCompany::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'name' => $this->faker->company,
        ];
    }
}
