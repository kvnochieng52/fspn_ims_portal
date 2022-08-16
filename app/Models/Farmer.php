<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class Farmer extends Model
{



    static $REQ_FIELDS = [
        'first_name' => 'required',
        'last_name' => 'required',
        //'id_passport' => 'required',
        'phone' => 'required',
        'country' => 'required',
        'town' => 'required',
        'sub_county' => 'required',
        'address' => 'required',
        'land_size' => 'required|between:0,99.99',
        'produce_type' => 'required',
        'consent_provided' => 'required',
    ];
    public static function getFarmerByID($farmer_id)
    {
        return self::leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id')
            ->leftJoin('genders', 'farmers.gender', '=', 'genders.id')
            ->leftJoin('users', 'farmers.created_by', '=', 'users.id')
            ->leftJoin('age_groups', 'farmers.age_group_id', '=', 'age_groups.id')
            ->where('farmers.id', $farmer_id)
            ->first([
                'farmers.*',
                'countries.country_name',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'genders.gender_name',
                'age_groups.age_group_name',
                'users.name AS created_by'
            ]);
    }


    public static function getFarmers($user_id = null)
    {

        $user = ($user_id != null) ? User::find($user_id) : User::find(Auth::user()->id);
        $farmers = self::select([
            'farmers.*',
            'counties.county_name',
            'sub_counties.sub_county_name',
        ])->leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id');
        if (!$user->can('View All Farmers'))
            $farmers->where('farmers.created_by', ($user_id != null) ? $user_id : Auth::user()->id);
       return  $farmers->orderBy('farmers.id', 'DESC');
        

        /* return $farmers->get(
            [
                'farmers.*',
                'counties.county_name',
                'sub_counties.sub_county_name',
            ]
        );
        */
    }


    public static function searchFarmer($account)
    {
        return self::where(function ($query) use ($account) {
            $query->where('farmers.id', $account)
                ->orWhere('id_passport', $account);
        })
            ->leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->first([
                'farmers.*',
                'countries.country_name',
                'counties.county_name'
            ]);
    }

    public static function get_latest_farmers()
    {

        $user = User::find(Auth::user()->id);
        $farmers = self::leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id');
        if (!$user->can('View All Farmers'))
            $farmers->where('farmers.created_by', Auth::user()->id);
        $farmers->orderBy('farmers.id', 'DESC');
        $farmers->limit(4);
        return $farmers->get(
            [
                'farmers.*',
                'counties.county_name',
                'sub_counties.sub_county_name',
            ]
        );
    }


    public static function farmers_by_region()
    {
        $user =  User::find(Auth::user()->id);
        $farmers = self::leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id');
        if (!$user->can('View All Farmers'))
            $farmers->where('farmers.created_by', Auth::user()->id);
        $farmers->orderBy('farmers.id', 'DESC');
        $farmers->groupBy('town');

        return $farmers->get(
            [
                //'farmers.*',
                'counties.county_name',
                DB::raw('COUNT(town) AS farmers_count'),
                //'sub_counties.sub_county_name',
            ]
        );
    }




    public static function updateFarmer($request, $farmer)
    {

        $farmer->first_name = $request->input('first_name');
        $farmer->last_name = $request->input('last_name');
        $farmer->email = $request->input('email');
        $farmer->id_passport = $request->input('id_passport');
        $farmer->phone1 = $request->input('phone');
        $farmer->phone2 = $request->input('phone2');
        $farmer->country = $request->input('country');
        $farmer->town = $request->input('town');
        $farmer->sub_county = $request->input('sub_county');
        $farmer->address = $request->input('address');
        $farmer->land_size = $request->input('land_size');
        $farmer->description = $request->input('comments');
        $farmer->gender = $request->input('gender');
        // $farmer->date_of_birth = Carbon::parse($request->input('date_of_birth'))->format("Y-m-d");
        $farmer->age_group_id = $request->input('age_group');
        $farmer->consent_form_provided = $request->input('consent_provided');

        // if ($request->hasFile('consent_upload') && $request->file('consent_upload')->isValid()) {
        //     $consent_upload_file = $request->file('consent_upload');
        //     $consent_upload_file_name = Str::random(30) . '.' . $consent_upload_file->getClientOriginalExtension();
        //     $consent_upload_file->move('uploads/consent_uploads/', $consent_upload_file_name);
        //     $farmer->consent_form_upload = 'uploads/consent_uploads/' . $consent_upload_file_name;
        // }

        if (empty($farmer->id))
            $farmer->created_by = Auth::user()->id;

        $farmer->updated_by = Auth::user()->id;



        $farmer->save();

        FarmerProduceType::where('farmer_id', $farmer->id)->delete();
        foreach ($request->input('produce_type') as $farmer_produce_type) {
            $farmer_produce_type_details = new FarmerProduceType();
            $farmer_produce_type_details->farmer_id = $farmer->id;
            $farmer_produce_type_details->produce_type_id = $farmer_produce_type;
            $farmer_produce_type_details->created_by = Auth::user()->id;
            $farmer_produce_type_details->updated_by = Auth::user()->id;
            $farmer_produce_type_details->save();
        }

        return $farmer->id;
    }

    public static function farmerProfileProgress($farmer)
    {
        $progress = 0;
        if (
            $farmer->first_name && $farmer->last_name
            && $farmer->id_passport && $farmer->phone1
           // && $farmer->country && $farmer->town
            //&& $farmer->sub_county && $farmer->address
           // && $farmer->land_size && $farmer->gender
            // && $farmer->date_of_birth
        ) {
            $progress = $progress + 50;
        }

        $farmer_produces = FarmerProduce::getFarmerProduces($farmer->id);

        if (count($farmer_produces) > 0) {
            $progress = $progress + 50;
        }

        return $progress;
    }


    public static function searchFarmers($request, $type)
    {
          if ($type == 'preview') {
            $columns = [
                'farmers.*',
                'countries.country_name',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'genders.gender_name',
                'produces.produce_name',
                'users.name AS created_by'
            ];
        } else {
            $columns = [
                'farmers.first_name',
                'farmers.last_name',
                'farmers.id',
                'farmers.phone1',
                'farmers.phone2',
                'farmers.email',
                'genders.gender_name',
                'farmers.id_passport',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'farmers.address',
              //  DB::raw("DATE_FORMAT(farmers.date_of_birth,'%d-%m-%Y')"),
              'age_groups.age_group_name',
                'farmers.land_size',
                'farmers.land_size',
                'produces.produce_name',
                'users.name',
                DB::raw("DATE_FORMAT(farmers.created_at,'%d-%m-%Y')"),
                'farmers.description'
            ];
        }
        $query = self::select($columns)->leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id')
            ->leftJoin('genders', 'farmers.gender', '=', 'genders.id')
            ->leftJoin('users', 'farmers.created_by', '=', 'users.id')
            ->leftJoin('farmer_produces', 'farmers.id', '=', 'farmer_produces.farmer_id')
            ->leftJoin('produces', 'farmer_produces.produce_id', '=', 'produces.id')
             ->leftJoin('age_groups', 'farmers.age_group_id', '=', 'age_groups.id');

        if (!empty($request->input('town'))) {
            $query->WhereIn('farmers.town', $request->input('town'));
        }

        if (!empty($request->input('produces'))) {
            $query->WhereIn('farmer_produces.produce_id', $request->input('produces'));
        }


        if (!empty($request->input('gender'))) {
            $query->WhereIn('farmers.gender', $request->input('gender'));
        }


        if (!empty($request->input('agent'))) {
            $query->WhereIn('farmers.created_by', $request->input('agent'));
        }

        if (!empty($request->input('date_from')) && !empty($request->input('registered_to'))) {

            $query->where([
                ['farmers.created_at', '>=',  Carbon::parse($request->input('date_from'))->format('Y-m-d')],
                ['farmers.created_at', '<',  Carbon::parse($request->input('registered_to'))->addDays(1)->format('Y-m-d')],
            ]);
        }

        if ($type == 'preview') {
             return  $query->paginate(10) ;
        } else {
             return  $query->get($columns);
        }
      

       
    }
}
