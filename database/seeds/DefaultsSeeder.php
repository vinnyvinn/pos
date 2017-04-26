<?php

use Illuminate\Database\Seeder;
use SmoDav\Models\PriceList;
use SmoDav\Models\PriceListName;
use SmoDav\Models\Tax;

class DefaultsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->setupTax();

        $this->setupPriceLists();
    }

    private function setupTax()
    {
        Tax::create([
            'code' => 'A',
            'description' => 'Input Tax',
            'rate' => 16,
            'is_active' => true
        ]);
        Tax::create([
            'code' => 'E',
            'description' => 'Exempt',
            'rate' => 0,
            'is_active' => true
        ]);
        Tax::create([
            'code' => 'Z',
            'description' => 'Zero Rated',
            'rate' => 0,
            'is_active' => true
        ]);
    }

    private function setupPriceLists()
    {
        PriceListName::create([
            'name'        => 'Main Price List',
            'is_active'   => true,
            'description' => 'Main Price List'
        ]);
    }
}
