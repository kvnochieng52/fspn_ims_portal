<?php

namespace App\Http\Controllers;


use App\Exports\FarmerExport;
use App\Exports\GroupExport;
use App\Exports\GroupMembersExport;
use App\Models\County;
use App\Models\Farmer;
use App\Models\Gender;
use App\Models\Group;
use App\Models\Produce;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Excel;

class ReportController extends Controller
{
    public function farmers(Request $request)
    {
        return view('reports.farmers.farmers_report', [
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'produces' => Produce::where('active', 1)->pluck('produce_name', 'id'),
            'genders' => Gender::pluck('gender_name', 'id'),
            'agents' => User::pluck('name', 'id'),
            'searching' => false,
            'farmers' => [],
        ]);
    }


    public function search_farmers(Request $request)
    {

        $farmers = Farmer::searchFarmers($request, 'preview');

        if (isset($_POST['generate_excel'])) {
            return Excel::download(new FarmerExport($request, 'excel'), 'Farmers_Report ' . Carbon::now()->format('d-m-Y g:i:s a') . '.xlsx');
        }

        return view('reports.farmers.farmers_report', [
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'produces' => Produce::where('active', 1)->pluck('produce_name', 'id'),
            'genders' => Gender::pluck('gender_name', 'id'),
            'agents' => User::pluck('name', 'id'),
            'searching' => true,
            'farmers' => $farmers,
        ]);
    }

    public function groups(Request $request)
    {
        return view('reports.groups.groups_report', [
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'agents' => User::pluck('name', 'id'),
            'searching' => false,
            'groups' => [],
        ]);
    }


    public function search_groups(Request $request)
    {

        $groups = Group::searchGroups($request, 'preview');

        if (isset($_POST['generate_excel'])) {
            return Excel::download(new GroupExport($request, 'excel', count($groups)), 'Groups_Report ' . Carbon::now()->format('d-m-Y g:i:s a') . '.xlsx');
        }

        return view('reports.groups.groups_report', [
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'agents' => User::pluck('name', 'id'),
            'searching' => true,
            'groups' => $groups,
        ]);
    }

    public function group_members(Request $request)
    {
        return Excel::download(new GroupMembersExport($request, 'excel'), 'Group_Members_Report ' . Carbon::now()->format('d-m-Y g:i:s a') . '.xlsx');
    }



    public function group_members_list(Request $request)
    {
        return view('reports.groups.group_members_list')->with([
            'groups' => Group::getGroups()->paginate(10),
        ]);
    }
}
