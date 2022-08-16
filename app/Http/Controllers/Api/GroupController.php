<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\County;
use App\Models\Farmer;
use App\Models\Group;
use App\Models\GroupMember;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GroupController extends Controller
{
    public function init_data()
    {
        return response()->json([
            'success' => true,
            'counties' => County::where('active', 1)->get(['id', 'county_name']),
        ]);
    }


    public function init_edit_data($group_id)
    {
        return response()->json([
            'success' => true,
            'counties' => County::where('active', 1)->get(['id', 'county_name']),
            'group' => Group::groupByID($group_id),
        ]);
    }



    public function search_groups($user_id, $seach_term)
    {
        $user = User::find($user_id);
        $groups = Group::leftJoin('counties', 'groups.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'groups.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'groups.created_by', '=', 'users.id')
            ->leftJoin('group_members', 'group_members.group_id', '=', 'groups.id');
        $groups->orwhere(function ($q) use ($seach_term) {
            $q->where('groups.group_name', 'like', '%' . $seach_term . '%');
            $q->orWhere('groups.id', 'like', '%' . $seach_term . '%');
            $q->orWhere('counties.county_name', 'like', '%' . $seach_term . '%');
            $q->orWhere('sub_counties.sub_county_name', 'like', '%' . $seach_term . '%');
        });
        if (!$user->can('View All Groups'))
            $groups->where('groups.created_by', $user_id);
        $groups->orderBy('groups.id', 'DESC');
        $groups->groupBy('group_members.group_id');
        return  $groups->get([
            'groups.*',
            'counties.county_name',
            'sub_counties.sub_county_name',
            'users.name AS created_by',
            DB::raw("COUNT(group_members.id) as members_count")
        ]);
    }

    public function group_details($group_id, $user_id)
    {

        return response()->json([
            'success' => true,
            'group' => Group::groupByID($group_id),
            'farmers' => Farmer::getFarmers($user_id),
            'group_members' => GroupMember::groupMembersByGroup($group_id),
            'group_members_array' => GroupMember::where('group_id', $group_id)->pluck('farmer_id')->toArray(),
            'group_leader' => GroupMember::where('group_id', $group_id)->where('group_leader', 1)->first(),
        ]);
    }

    public function add(Request $request)
    {
        $group = new Group();
        $group->group_name = $request->input('group_name');
        $group->county = $request->input('county');
        $group->sub_county = $request->input('sub_county');
        $group->description = $request->input('description');
        $group->created_by = $request->input('created_by');
        $group->updated_by = $request->input('created_by');
        $group->channel = 2;
        $group->save();

        if (!empty($group->id)) {
            return response()->json([
                'success' => true,
                'group_id' => $group->id,
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
        $group = Group::find($request->input('group_id'));
        $group->group_name = $request->input('group_name');
        $group->county = $request->input('county');
        $group->sub_county = $request->input('sub_county');
        $group->description = $request->input('description');
        $group->updated_by = $request->input('created_by');
        $group->save();

        if (!empty($group->id)) {
            return response()->json([
                'success' => true,
                'group_id' => $group->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong... Please try later',
            ], 401);
        }
    }


    public function get_groups($user_id)
    {
        return response()->json(Group::getGroups($user_id));
    }


    public function add_farmer_to_group(Request $request)
    {

        $groupMember = new GroupMember();
        $groupMember->group_id = $request->input('group_id');
        $groupMember->farmer_id = $request->input('farmer_id');
        $groupMember->created_by = $request->input('created_by');
        $groupMember->updated_by = $request->input('created_by');
        $groupMember->save();

        return response()->json([
            'success' => true,
            'group_id' => $request->input('group_id'),
            'group_members_array' => GroupMember::where('group_id', $request->input('group_id'))->pluck('farmer_id')->toArray(),
            'group_leader' => GroupMember::where('group_id', $request->input('group_id'))->where('group_leader', 1)->first(),
        ]);
    }

    public function remove_member_from_group($member_id, $user_id, $group_id)
    {
        GroupMember::where('id', $member_id)->delete();
        return response()->json([
            'success' => true,
            'group_id' => $member_id,
            'group_members' => GroupMember::groupMembersByGroup($group_id),
            'group_members_array' => GroupMember::where('group_id', $group_id)->pluck('farmer_id')->toArray(),
            'group_leader' => GroupMember::where('group_id', $group_id)->where('group_leader', 1)->first(),
        ]);
    }

    public function remove_leader(Request $request)
    {

        GroupMember::where([
            'group_id' => $request->input('group_id'),
            'farmer_id' => $request->input('farmer_id'),
        ])->update([
            'group_leader' => null,
            'updated_by' => $request->input('created_by')
        ]);
        return response()->json([
            'success' => true,
        ]);
    }

    public function make_leader(Request $request)
    {
        GroupMember::where([
            'group_id' => $request->input('group_id'),
            'group_leader' => 1
        ])->update([
            'group_leader' => null,
            'updated_by' => $request->input('created_by')
        ]);

        GroupMember::where([
            'group_id' => $request->input('group_id'),
            'farmer_id' => $request->input('farmer_id'),
        ])->update([
            'group_leader' => 1,
            'updated_by' => $request->input('created_by')
        ]);
        return response()->json([
            'success' => true,
            'group_id' => $request->input('group_id'),
            'farmer_id' => $request->input('farmer_id')
            // 'group_members' => GroupMember::groupMembersByGroup($group_id),
            // 'group_members_array' => GroupMember::where('group_id', $group_id)->pluck('farmer_id')->toArray(),
            // 'group_leader' => GroupMember::where('group_id', $group_id)->where('group_leader', 1)->first(),
        ]);
    }
}
