<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\County;
use App\Models\Gender;
use App\Models\SubCounty;
use Illuminate\Http\Request;

class InitnController extends Controller
{
    public function countries()
    {
        return response()->json(Country::where('active', 1)->get(['id', 'country_name']));
    }


    public function counties()
    {
        return response()->json(County::where('active', 1)->get(['id', 'county_name']));
    }

    public function sub_counties($county)
    {
        return response()->json(SubCounty::where('county_id', $county)->where('active', 1)->get(['id', 'sub_county_name']));
    }


    public function gender()
    {
        return response()->json(Gender::get(['id', 'gender_name']));
    }
}
