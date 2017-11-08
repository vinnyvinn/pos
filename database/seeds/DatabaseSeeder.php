<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UnitsTableSeeder::class);
         $this->call(SettingsTableSeeder::class);
         $this->call(DefaultsSeeder::class);
         $this->call(UsersTableSeeder::class);
         $this->call(PaymentTypesTableSeeder::class);
    }
}
