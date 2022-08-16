<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerInputItem extends Model
{

    public static function getFarmerInputItems($farmer_id)
    {

        return self::leftJoin('inputs', 'farmer_input_items.input_id', '=', 'inputs.id')
            ->leftJoin('sub_inputs', 'farmer_input_items.sub_input_id', '=', 'sub_inputs.id')
            ->leftJoin('units', 'farmer_input_items.unit_id', '=', 'units.id')
            ->where('farmer_input_items.farmer_id', $farmer_id)
            ->get([
                'farmer_input_items.*',
                'inputs.input_name',
                'sub_inputs.sub_input_name',
                'units.unit_name',

            ]);
    }


    public static function getAllFarmInputItems()
    {

        return self::leftJoin('inputs', 'farmer_input_items.input_id', '=', 'inputs.id')
            ->leftJoin('sub_inputs', 'farmer_input_items.sub_input_id', '=', 'sub_inputs.id')
            ->leftJoin('units', 'farmer_input_items.unit_id', '=', 'units.id')
            ->leftJoin('farmers', 'farmer_input_items.farmer_id', '=', 'farmers.id')
            ->leftJoin('users', 'farmer_input_items.created_by', '=', 'users.id')
            ->get([
                'farmer_input_items.*',
                'inputs.input_name',
                'sub_inputs.sub_input_name',
                'units.unit_name',
                'farmers.id as farmer_account',
                'farmers.first_name',
                'farmers.last_name',
                'users.name AS field_officer'

            ]);
    }
}
