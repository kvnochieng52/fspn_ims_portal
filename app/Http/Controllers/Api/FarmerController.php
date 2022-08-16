<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\FarmerProduce;
use App\Models\FarmerProduceType;
use App\Models\Group;
use App\Models\Organization;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class FarmerController extends Controller
{

    public function dashboard_stats(Request $request)
    {
        return response()->json([
            'success' => true,
            'farmers_count' => Farmer::getFarmers($request->input('user_id'))->count(),
            'group_count' => Group::getGroups($request->input('user_id'))->count(),
            'org_count' => Organization::getOrganizations($request->input('user_id'))->count(),
        ]);
    }
    public function create(Request $request)
    {


        $farmer = new Farmer();
        $farmer->first_name = $request->input('first_name');
        $farmer->last_name = $request->input('last_name');
        $farmer->email = $request->input('email');
        $farmer->id_passport = $request->input('id_passport');
        $farmer->phone1 = $request->input('phone1');
        $farmer->phone2 = $request->input('phone2');
        $farmer->country = $request->input('country');
        $farmer->town = $request->input('town');
        $farmer->sub_county = $request->input('sub_county');
        $farmer->address = $request->input('address');
        $farmer->land_size = $request->input('land_size');
        $farmer->gender = $request->input('gender');
        $farmer->channel = 2;
        $farmer->date_of_birth = Carbon::parse($request->input('date_of_birth'))->format("Y-m-d");
        $farmer->created_by = $request->input('created_by');
        $farmer->updated_by = $request->input('created_by');

        $farmer->save();

        if ($request->input('crop') == true) {
            $farmer_produce_type_details = new FarmerProduceType();
            $farmer_produce_type_details->farmer_id = $farmer->id;
            $farmer_produce_type_details->produce_type_id = 1;
            $farmer_produce_type_details->created_by = $request->input('created_by');
            $farmer_produce_type_details->updated_by = $request->input('created_by');
            $farmer_produce_type_details->save();
        }

        if ($request->input('livestock') == true) {
            $farmer_produce_type_details = new FarmerProduceType();
            $farmer_produce_type_details->farmer_id = $farmer->id;
            $farmer_produce_type_details->produce_type_id = 1;
            $farmer_produce_type_details->created_by = $request->input('created_by');
            $farmer_produce_type_details->updated_by = $request->input('created_by');
            $farmer_produce_type_details->save();
        }

        if (!empty($farmer->id)) {
            return response()->json([
                'success' => true,
                'farmer_id' => $farmer->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong... Please try later',
            ], 401);
        }
    }



    public function update(Request $request)
    {

        $farmer = Farmer::find($request->input('farmer_id'));
        $farmer->first_name = $request->input('first_name');
        $farmer->last_name = $request->input('last_name');
        $farmer->email = $request->input('email');
        $farmer->id_passport = $request->input('id_passport');
        $farmer->phone1 = $request->input('phone1');
        $farmer->phone2 = $request->input('phone2');
        $farmer->country = $request->input('country');
        $farmer->town = $request->input('town');
        $farmer->sub_county = $request->input('sub_county');
        $farmer->address = $request->input('address');
        $farmer->land_size = $request->input('land_size');
        $farmer->gender = $request->input('gender');
        // $farmer->date_of_birth = Carbon::parse($request->input('date_of_birth'))->format("Y-m-d");
        $farmer->updated_by = $request->input('updated_by');

        $farmer->save();

        FarmerProduceType::where('farmer_id', $farmer->id)->delete();

        if ($request->input('crop') == true) {
            $farmer_produce_type_details = new FarmerProduceType();
            $farmer_produce_type_details->farmer_id = $farmer->id;
            $farmer_produce_type_details->produce_type_id = 1;
            $farmer_produce_type_details->created_by = $request->input('created_by');
            $farmer_produce_type_details->updated_by = $request->input('created_by');
            $farmer_produce_type_details->save();
        }

        if ($request->input('livestock') == true) {
            $farmer_produce_type_details = new FarmerProduceType();
            $farmer_produce_type_details->farmer_id = $farmer->id;
            $farmer_produce_type_details->produce_type_id = 1;
            $farmer_produce_type_details->created_by = $request->input('created_by');
            $farmer_produce_type_details->updated_by = $request->input('created_by');
            $farmer_produce_type_details->save();
        }

        if (!empty($farmer->id)) {
            return response()->json([
                'success' => true,
                'farmer_id' => $farmer->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong... Please try later',
            ], 401);
        }
    }


    public function get_farmers($user_id)
    {
        return response()->json(Farmer::getFarmers($user_id));
    }



    public function get_farmer_by_id($farmer_id)
    {

        $farmer = Farmer::getFarmerByID($farmer_id);

        if (!empty($farmer)) {


            return response()->json([
                'success' => true,
                'farmer' => $farmer,
                'produce_types' => FarmerProduceType::where('farmer_id', $farmer_id)->get(['produce_type_id'])->toArray(),
                'farmer_produces' => FarmerProduce::getFarmerProduces($farmer_id),

            ]);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Something went wrong... Please try later',
                ],
                401
            );
        }
    }

    public function search_farmers($user_id, $seach_term)
    {

        $user = User::find($user_id);
        $farmers = Farmer::leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id');
        $farmers->orwhere(function ($q) use ($seach_term) {
            $q->where('farmers.first_name', 'like', '%' . $seach_term . '%');
            $q->orWhere('farmers.last_name', 'like', '%' . $seach_term . '%');
            $q->orWhere('farmers.id', 'like', '%' . $seach_term . '%');
            $q->orWhere('farmers.id_passport', 'like', '%' . $seach_term . '%');
            $q->orWhere('farmers.email', 'like', '%' . $seach_term . '%');
            $q->orWhere('farmers.phone1', 'like', '%' . $seach_term . '%');
            $q->orWhere('counties.county_name', 'like', '%' . $seach_term . '%');
            $q->orWhere('sub_counties.sub_county_name', 'like', '%' . $seach_term . '%');
        });

        if (!$user->can('View All Farmers'))
            $farmers->where('farmers.created_by', $user_id);
        $farmers->orderBy('farmers.id', 'DESC');
        return $farmers->get(
            [
                'farmers.*',
                'counties.county_name',
                'sub_counties.sub_county_name'
            ]
        );
    }
}
