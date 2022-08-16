<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\FarmerInput;
use App\Models\Group;
use App\Models\Organization;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
          $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $farmers_by_region = Farmer::farmers_by_region();

        $region_name_array = [];
        $region_count_array = [];
        foreach ($farmers_by_region as $farmer) {
            $region_name_array[] = $farmer->county_name;
            $region_count_array[] = $farmer->farmers_count;
        }

        return view('dashboard')->with([
            'farmers_count' => Farmer::getFarmers()->count(),
            'group_count' => Group::getGroups()->count(),
            'org_count' => Organization::getOrganizations()->count(),
            'farmer_input_count' => FarmerInput::getFarmerInputs()->count(),
            'latest_farmers' => Farmer::get_latest_farmers(),
            'pending_farm_inputs' => FarmerInput::where('status', 1)->count(),
            'completed_farm_inputs' => FarmerInput::where('status', 2)->count(),
            'region_names' => json_encode($region_name_array),
            'region_count' => json_encode($region_count_array),


        ]);
    }
}
