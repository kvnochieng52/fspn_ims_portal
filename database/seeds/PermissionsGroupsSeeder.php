<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionsGroupsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permission_groups')->insert([
            [
                'group_name' => 'Farmers',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Groups',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Organizations',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Farm Inputs',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Reports',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ], [
                'group_name' => 'Users',
                'active' => '1',
                'order' => '0',
                'created_by' => '1',
                'updated_by' => '1',
            ],


        ]);
    }
}
