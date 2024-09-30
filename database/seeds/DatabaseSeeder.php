<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(AdminsTableSeeder::class);
            $this->command->info('Admin table seeded!');

        $this->call(CitiesTableSeeder::class);
            $this->command->info('City table seeded!');

        $this->call(SettingTableSeeder::class);
            $this->command->info('Setting table seeded!');

        $this->call(UsersTableSeeder::class);
            $this->command->info('User table seeded!');

        $this->call(CommonQuestionTableSeeder::class);
            $this->command->info('CommonQuestion table seeded!');

        $this->call(BankTableSeeder::class);
            $this->command->info('Bank table seeded!');

        $this->call(ServiceTableSeeder::class);
            $this->command->info('Service table seeded!');

        $this->call(StatusTableSeeder::class);
            $this->command->info('Status table seeded!');

        $this->call(TermsTableSeeder::class);
            $this->command->info('Terms table seeded!');

        $this->call(HomeTableSeeder::class);
            $this->command->info('Home table seeded!');

        // $this->call(OrderMo3amlaTableSeeder::class);
        //     $this->command->info('OrderMo3amla table seeded!');


            
            
            
            
    }
}
