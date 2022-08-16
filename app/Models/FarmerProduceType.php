<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerProduceType extends Model
{

    public static function getFarmerProduceTypes($farmer_id)
    {
        return  self::leftJoin('produce_types', 'farmer_produce_types.produce_type_id', '=', 'produce_types.id')
            ->where('farmer_id', $farmer_id)
            ->get();
    }
}
