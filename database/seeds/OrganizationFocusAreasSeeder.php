<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrganizationFocusAreasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('organization_focus_areas')->insert([
            [
                'focus_area_name' => 'Youth',

            ],
            [
                'focus_area_name' => 'Women',

            ],

            [
                'focus_area_name' => 'Children',

            ],
        ]);
    }
}
