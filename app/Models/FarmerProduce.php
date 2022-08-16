<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProduce extends Model
{
    public static function getFarmerProduces($farmer_id)
    {

        return self::leftJoin('produces', 'farmer_produces.produce_id', '=', 'produces.id')
            ->leftJoin('produce_sub_types', 'farmer_produces.sub_produce_id', '=', 'produce_sub_types.id')
            ->leftJoin('units', 'farmer_produces.unit', '=', 'units.id')
            ->where('farmer_id', $farmer_id)->get([
                'farmer_produces.*',
                'produces.produce_name',
                'produce_sub_types.produce_sub_type_name',
                'units.unit_name',
                'produces.placeholder_image'
            ]);
    }
}
