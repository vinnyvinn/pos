<?php

use Illuminate\Database\Seeder;
use SmoDav\Models\PaymentTypes;
class PaymentTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        PaymentTypes::insert([
          [
            'name'=>'Cash',
            'slug'=>'cash',
            'is_credit' => 0
          ],
          [
            'name'=>'M-Pesa',
            'slug'=>'m_pesa',
            'is_credit' => 0
          ],
          [
            'name' =>'Credit',
            'slug' =>'credit',
            'is_credit' => 1
          ],
        ]);

    }
}
