<?php

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('unit_of_measures')->insert([
            'description' => "Default Unit of Measure",
            'name' => 'Unit',
            'is_active' => true,
            'system_install' => true,
        ]);
    }
}
