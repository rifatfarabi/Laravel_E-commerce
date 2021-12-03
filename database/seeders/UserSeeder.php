<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $users = [
            [
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' =>\Hash::make('password') //password
            ],
            [
                'id' => 2,
                'name' => 'customer',
                'email' => 'customer@gmail.com',
                'password' =>\Hash::make('password')  //password
            ]
        ]; 
        User::insert($users);
    }
}
