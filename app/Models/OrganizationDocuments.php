<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganizationDocuments extends Model
{
    public static function getOrganizationDocuments($org_id)
    {
        return  self::leftJoin('organization_document_types', 'organization_documents.document_type_id', '=', 'organization_document_types.id')
            ->where('organization_id', $org_id)
            ->get([
                'organization_documents.*',
                'organization_document_types.document_type_name'
            ]);
    }
}
