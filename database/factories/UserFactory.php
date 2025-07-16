<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<User>
 */
class UserFactory extends Factory
{
    protected $model = User::class;

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $first_name = $this->faker->firstName;
        $last_name = $this->faker->lastName;
//        $user_name = strtolower($first_name . '.' . $last_name);

        return [
            'parent_id' => null,
            'first_name' => $first_name,
            'middle_name' => $this->faker->firstName,
            'last_name' => $last_name,
            'phone' => $this->faker->unique()->phoneNumber,
            'user_name' => $first_name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt($first_name), // Password is the first name
            'balance' => 0,
            'is_active' => 1,
        ];
    }

    /**
     * Define a state for admin users.
     */
    public function admin()
    {
        return $this->state([
            'user_name' => 'admin',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin'),
        ]);
    }

    /**
     * Define a state for member users.
     */
    public function member($parent_id)
    {
        return $this->state([
            'parent_id' => $parent_id,
        ]);
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
