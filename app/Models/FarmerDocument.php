<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FarmerDocument extends Model
{
    public static function getFarmerDocuments($farmer_id)
    {
        return  self::leftJoin('farmer_document_types', 'farmer_documents.document_type_id', '=', 'farmer_document_types.id')
            ->where('farmer_id', $farmer_id)
            ->get([
                'farmer_documents.*',
                'farmer_document_types.document_type_name'
            ]);
    }
}
