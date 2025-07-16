<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesTableSeeder::class,
            MoneyTransferCompanySeeder::class,
            OurCompanyMoneyAccountSeeder::class,
            UsersTableSeeder::class,
//            CardsTableSeeder::class,
            BrokerBonusTableSeeder::class,
            CoursesTableSeeder::class,
            ChaptersTableSeeder::class,
            VideosTableSeeder::class,
//            MoneyTransferCompanySeeder::class,
//            MemberCommissionSeeder::class,


//            CompanyBalanceTransactionSeeder::class,
//            BrokersReceiptSeeder::class,
////            BrokersMembersBonusSeeder::class,
//            CardPaymentSeeder::class,

        ]);
    }
}
