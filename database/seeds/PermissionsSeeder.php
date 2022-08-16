<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            [
                'name' => 'Create Farmer',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'View Farmers',
                'guard_name' => 'web',
                'p_group' => '1',

            ], [
                'name' => 'View All Farmers',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'Edit Farmer',
                'guard_name' => 'web',
                'p_group' => '1',

            ],

            [
                'name' => 'Delete Farmer',
                'guard_name' => 'web',
                'p_group' => '1',

            ],


            [
                'name' => 'Create Group',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'View Groups',
                'guard_name' => 'web',
                'p_group' => '2',

            ], [
                'name' => 'View All Groups',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Edit Group',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Delete Group',
                'guard_name' => 'web',
                'p_group' => '2',

            ],

            [
                'name' => 'Create Organization',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'View Organizations',
                'guard_name' => 'web',
                'p_group' => '3',

            ], [
                'name' => 'View All Organizations',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'Edit Organization',
                'guard_name' => 'web',
                'p_group' => '3',

            ],

            [
                'name' => 'Delete Organization',
                'guard_name' => 'web',
                'p_group' => '3',

            ],


            [
                'name' => 'Create User',
                'guard_name' => 'web',
                'p_group' => '6',

            ],

            [
                'name' => 'View Users',
                'guard_name' => 'web',
                'p_group' => '6',

            ], [
                'name' => 'View All Users',
                'guard_name' => 'web',
                'p_group' => '6',

            ],

            [
                'name' => 'Edit User',
                'guard_name' => 'web',
                'p_group' => '6',

            ],

            [
                'name' => 'Delete User',
                'guard_name' => 'web',
                'p_group' => '6',

            ],

        ]);
    }
}
