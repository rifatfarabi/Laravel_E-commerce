<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::findOrFail(1)->roles()->sync(1); //assigning role admin to user admin
        User::findOrFail(2)->roles()->sync(2); // assigning role customer to user customer
    }
}
