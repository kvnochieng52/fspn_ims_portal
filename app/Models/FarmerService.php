<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerService extends Model
{
    public static function getFarmersServices($farmer_id)
    {
        return self::leftJoin('services', 'farmer_services.service_id', '=', 'services.id')
            ->where('farmer_services.farmer_id', $farmer_id)
            ->get([
                'farmer_services.*',
                'services.service_name'
            ]);
    }
}
