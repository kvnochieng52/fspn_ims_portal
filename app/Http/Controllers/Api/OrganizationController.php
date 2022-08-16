<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Organization;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    public function get_organizations(Request $request)
    {
        return response()->json(Organization::getOrganizations($request->input('user_id')));
    }
}
