<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationCategories extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_categories')->insert([
            [
                'category_name' => 'Farming & Agriculture',
                'active' => '1',
                'order' => '0',

            ],

            [
                'category_name' => 'Nutrition, Health & Safety',
                'active' => '1',
                'order' => '0',

            ],

            [
                'category_name' => 'Marketing & Communication',
                'active' => '1',
                'order' => '0',

            ],

            [
                'category_name' => 'Research & Training',
                'active' => '1',
                'order' => '0',

            ],

            [
                'category_name' => 'Software & Data',
                'active' => '1',
                'order' => '0',

            ],
        ]);
    }
}
