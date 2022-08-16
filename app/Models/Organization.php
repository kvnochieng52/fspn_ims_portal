<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Organization extends Model
{


    const RULES = [
        'organization_name' => 'required',
        'telephone' => 'required',
        'email' => 'required|email',
        'country' => 'required',
        'county' => 'required',
        'sub_county' => 'required',
        'address' => 'required',
        'contact_person_name' => 'required',
        'contact_person_email' => 'required',
        'contact_person_telephone' => 'required',
        'specialization' => 'required',
        'focus_areas' => 'required',
        'sdgs' => 'required',
        'logo_upload' => 'mimes:png,jpg,jpeg',

    ];

    public static function organizationByID($organization_id)
    {
        return self::leftJoin('countries', 'organizations.country', '=', 'countries.id')
            ->leftJoin('counties', 'organizations.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'organizations.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'organizations.created_by', '=', 'users.id')
            ->where('organizations.id', $organization_id)
            ->first([
                'organizations.*',
                'countries.country_name',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'users.name AS created_by'
            ]);
    }


    public static function getOrganizations($user_id = null)
    {
        //comment
        $user = ($user_id != null) ? User::find($user_id) : User::find(Auth::user()->id);
        $organizations = self::leftJoin('countries', 'organizations.country', '=', 'countries.id')
            ->leftJoin('counties', 'organizations.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'organizations.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'organizations.created_by', '=', 'users.id');
        if (!$user->can('View All Organizations'))
            $organizations->where('organizations.created_by', ($user_id != null) ? $user_id : Auth::user()->id);
        return $organizations->get([
            'organizations.*',
            'countries.country_name',
            'counties.county_name',
            'sub_counties.sub_county_name',
            'users.name AS created_by'
        ]);
    }

    public static function updateOrganization($organization, $request)
    {
        $organization->organization_name = $request->input('organization_name');
        $organization->telephone = $request->input('telephone');
        $organization->email = $request->input('email');
        $organization->country = $request->input('country');
        $organization->county = $request->input('county');
        $organization->sub_county = $request->input('sub_county');
        $organization->address = $request->input('address');
        $organization->contact_person_name = $request->input('contact_person_name');
        $organization->contact_person_email = $request->input('contact_person_email');
        $organization->contact_person_telephone = $request->input('contact_person_telephone');
        $organization->registration_no = $request->input('registration_no');
        $organization->date_of_registration = Carbon::parse($request->input('date_of_registration'))->format("Y-m-d");
        $organization->website = $request->input('website');

        if (empty($organization->id))
            $organization->created_by = Auth::user()->id;

        $organization->updated_by = Auth::user()->id;

        if ($request->hasFile('logo_upload') && $request->file('logo_upload')->isValid()) {
            $logo_upload_file = $request->file('logo_upload');
            $logo_upload_file_name = Str::random(30) . '.' . $logo_upload_file->getClientOriginalExtension();
            $logo_upload_file->move('uploads/logo_uploads/', $logo_upload_file_name);
            $organization->logo = 'uploads/logo_uploads/' . $logo_upload_file_name;
        }

        $organization->save();
        OrganizationSelecetdCategory::where('organization', $organization->id)->delete();
        foreach ($request->input('specialization') as $spec) {
            $specialization = new OrganizationSelecetdCategory();
            $specialization->organization = $organization->id;
            $specialization->category = $spec;
            $specialization->created_by = Auth::user()->id;
            $specialization->updated_by = Auth::user()->id;
            $specialization->save();
        }

        OrganizationSelecetdFocusGroup::where('organization', $organization->id)->delete();
        foreach ($request->input('focus_areas') as $focus_area) {
            $focus_areas = new OrganizationSelecetdFocusGroup();
            $focus_areas->organization = $organization->id;
            $focus_areas->focus_group = $focus_area;
            $focus_areas->created_by = Auth::user()->id;
            $focus_areas->updated_by = Auth::user()->id;
            $focus_areas->save();
        }

        OrganizationSelecetdSustainableGoal::where('organization', $organization->id)->delete();
        foreach ($request->input('sdgs') as $sdg) {
            $sdgs = new OrganizationSelecetdSustainableGoal();
            $sdgs->organization = $organization->id;
            $sdgs->sustainable_goal = $sdg;
            $sdgs->created_by = Auth::user()->id;
            $sdgs->updated_by = Auth::user()->id;
            $sdgs->save();
        }

        return $organization->id;
    }
}
