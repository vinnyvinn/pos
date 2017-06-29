<?php

use Illuminate\Database\Seeder;
use SmoDav\Models\Setting;

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::create([
            'inventory_control_method' => Setting::NONE,
            'costing_method' => Setting::MANUAL_COSTING,
            'enable_loyalty' => false,
            'enable_gift_cards' => false,
            'enable_bundles' => false,
            'enable_happy_hour_sales' => false
        ]);
    }
}
