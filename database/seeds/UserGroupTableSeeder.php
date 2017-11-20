<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use SmoDav\Models\UserGroup;

class UserGroupTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now();

        UserGroup::create([
            'name' => 'default User',
            'permissions' => '[]',
        ]);
    }
}
