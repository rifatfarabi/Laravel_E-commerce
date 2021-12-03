<?php

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use App\Models\Role;

class RolePermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::findOrFail(1)->permissions()->sync(1);
        Role::findOrFail(2)->permissions()->sync(2);
    }
}
