<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'access_admin_dashboard',
            ],
            [
                'id'    => 2,
                'title' => 'access_customer_dashboard',
            ]
        ];

        Permission::insert($permissions);
    }
}
