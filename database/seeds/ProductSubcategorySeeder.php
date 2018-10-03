<?php

use Illuminate\Database\Seeder;

class ProductSubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 33;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('product_subcategories')->insert([ //,
                'name' => $faker->name,
                'price' => $faker->unique()->numberBetween($min = 1, $max = 50),

            ]);
        }
    }
}
