<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupMemberController extends Controller
{


    public function add_farmer_to_group(Request $request)
    {

        $check_member = GroupMember::where([
            'group_id' => $request->input('group_id'),
            'farmer_id' => $request->input('farmer_id'),
        ])->first();

        if (!empty($check_member)) {
            return '2';
        }

        $groupMember = new GroupMember();
        $groupMember->group_id = $request->input('group_id');
        $groupMember->farmer_id = $request->input('farmer_id');
        $groupMember->created_by = Auth::user()->id;
        $groupMember->updated_by = Auth::user()->id;
        $groupMember->save();

        return '1';
    }


    public function make_leader($group_id, $farmer_id)
    {
        GroupMember::where([
            'group_id' => $group_id,
            'group_leader' => 1
        ])->update([
            'group_leader' => null,
            'updated_by' => Auth::user()->id
        ]);

        GroupMember::where([
            'group_id' => $group_id,
            'farmer_id' => $farmer_id,
        ])->update([
            'group_leader' => 1,
            'updated_by' => Auth::user()->id
        ]);

        return back()->with('success', 'Group Leader Selected');
    }


    public function remove_group_leader($group_member_id)
    {
        GroupMember::where([
            'id' => $group_member_id,
        ])->update([
            'group_leader' => null,
            'updated_by' => Auth::user()->id
        ]);

        return back()->with('success', 'Group Leader Selected');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        foreach ($request->input('farmers') as $farmer) {
            $groupMember = new GroupMember();
            $groupMember->group_id = $request->input('group_id');
            $groupMember->farmer_id = $farmer;
            $groupMember->created_by = Auth::user()->id;
            $groupMember->updated_by = Auth::user()->id;
            $groupMember->save();
        }

        return back()->with('success', 'Members successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Http\Response
     */
    public function show(GroupMember $groupMember)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Http\Response
     */
    public function edit(GroupMember $groupMember)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GroupMember $groupMember)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\GroupMember  $groupMember
     * @return \Illuminate\Http\Response
     */
    public function destroy(GroupMember $groupMember)
    {
        $groupMember->delete();
        return back()->with('success', 'Member Successfully Deleted');
    }
}
