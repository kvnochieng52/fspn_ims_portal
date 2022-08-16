<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class FarmerInput extends Model
{
    public static function getFarmerInputs($user_id = null)
    {
        $user = ($user_id != null) ? User::find($user_id) : User::find(Auth::user()->id);

        $farm_inputs = FarmerInput::leftJoin('farmers', 'farmer_inputs.farmer_id', '=', 'farmers.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id')
            ->leftJoin('statuses', 'farmer_inputs.status', '=', 'statuses.id');
        if (!$user->can('View All Farmers'))
            $farm_inputs->where('farmer_inputs.created_by', ($user_id != null) ? $user_id : Auth::user()->id);
        $farm_inputs->orderBy('farmer_inputs.id', 'DESC');
        return $farm_inputs->get([
            'farmers.*',
            'farmer_inputs.*',
            'farmer_inputs.id As farm_input_id',
            'farmers.id As farmer_id',
            'counties.county_name',
            'sub_counties.sub_county_name',
            'statuses.status_name'
        ]);
    }
}
