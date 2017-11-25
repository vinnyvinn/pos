<?php

use Illuminate\Database\Seeder;
use SmoDav\Models\Customer;
use SmoDav\Models\PriceList;
use SmoDav\Models\PriceListName;
use SmoDav\Models\Stall;
use SmoDav\Models\Tax;
use SmoDav\Models\TransactionType;

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

        $this->setupCustomer();

        $this->setupStall();

        $this->setupTransactionmode();
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

    private function setupCustomer()
    {
        Customer::create([
            'name' => 'Cash Customer',
            'phone_number' => '+254711408108',
            'email' => 'info@wizag.biz',
            'account_balance' => 0,
            'is_credit' => false,
            'credit_limit' => 0,
            'address' => 'Wise & Agile Solutions Limited',
            'is_system' => true,
        ]);
    }

    private function setupStall()
    {
        Stall::create([
            'name' => 'Head Office',
            'location' => '',
        ]);
    }
    private function setupTransactionmode()
    {
        TransactionType::create([
            'mop' => 'MPESA',

        ]);
        TransactionType::create([
            'mop' => 'CREDIT CARD',

        ]);
        TransactionType::create([
            'mop' => 'CASH',

        ]);
    }
}
