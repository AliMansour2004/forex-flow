<?php

namespace Database\Seeders;

use App\Models\CardPayment;
use App\Models\Member;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $faker = Faker::create();
        // Create 5 admins
        User::factory()->admin()->create()->each(function ($user) {
            if (!$user->roles()->exists()) {
                $user->assignRole('admin');
            }
        });

        // Create 3 brokers
        $brokers = User::factory()
            ->count(3)
            ->create()
            ->each(function ($user) use ($faker) {
                $user->assignRole('broker');
                $user->update(['password' => bcrypt($user->user_name)]); // Set password as first_name
                Member::create([
                    'user_id' => $user->id,
                    'added_by_user_id' => auth()->id(),
                    'finished_at' => null, // Adjust as needed
                    'date_of_birth' => $faker->date(),
                ]);
                $this->createCardPayment($user->id, null, $faker);
            });

        // Create 10 members (each assigned to a random broker as parent_id)
        $brokers->each(function ($broker) use ($faker) {
            User::factory()
                ->count(2)
                ->member($broker->id) // Assign parent_id to the broker
                ->create()
                ->each(function ($user) use ($broker,$faker) {
                    $user->assignRole('member');
                    $user->update(['password' => bcrypt($user->user_name)]); // Set password as first_name

                    Member::create([
                        'user_id' => $user->id,
                        'added_by_user_id' => auth()->id(),
                        'finished_at' => null, // Adjust as needed
                    ]);
                    $this->createCardPayment($user->id, $broker->id, $faker);
                });

        });

        // Create 1 instructor
        User::factory()
            ->create(['user_name' => 'instructor'])
            ->each(function ($user) {
                if (!$user->roles()->exists()) {
                    $user->assignRole('instructor');
                    $user->update(['password' => bcrypt($user->user_name)]); // Set password as first_name
                }
            });
    }


    private function createCardPayment(int $userId, ?int $brokerId, $faker)
    {
        $amount = $faker->randomElement([24, 30]);  // Amount is either 24 or 30
        $fees = $faker->randomFloat(2, 0.3, 0.9);

        // Calculate gross profit based on broker existence
        $grossProfit = $brokerId ? $amount - $fees : $faker->randomFloat(2, 10, 50);

        CardPayment::create([
            'added_by_user_id' => auth()->id(),  // Use the currently authenticated user
            'broker_id' => $brokerId,  // Broker ID (nullable for non-broker users)
            'user_id' => $userId,  // User ID for the payment
            'our_company_money_account_id' => 1,  // Static company money account ID
            'amount' => $amount,  // Random amount (24 or 30)
            'fees' => $fees,  // Random fees
            'duration' => 1,  // Static duration (1 month)
            'discount' => 0,  // Static discount (0%)
            'purchased_at' => now(),  // Set the purchase date to now
            'finished_at' => now(),  // Set the finish date to now
            'broker_profit_percentage' => $faker->randomFloat(2, 10, 50),  // Random broker profit percentage
            'broker_profit_cost' => $faker->randomFloat(2, 1, 30),  // Random broker profit cost
            'gross_profit' => $grossProfit,  // Gross profit calculation
            'transaction_id' => $faker->uuid(),  // Generate random transaction ID
        ]);
    }
}
