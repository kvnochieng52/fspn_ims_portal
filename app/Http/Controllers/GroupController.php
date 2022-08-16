<?php

namespace App\Http\Controllers;

use App\Models\County;
use App\Models\Farmer;
use App\Models\Group;
use App\Models\GroupMember;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('group.index')->with([
            'groups' => Group::getGroups()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('group.create', ['counties' => County::where('active', 1)->pluck('county_name', 'id'),]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $group = new Group();
        $group->group_name = $request->input('group_name');
        $group->county = $request->input('county');
        $group->sub_county = $request->input('sub_county');
        $group->description = $request->input('description');
        $group->created_by = Auth::user()->id;
        $group->updated_by = Auth::user()->id;
        $group->save();
        return redirect('group/' . $group->id . '/edit')->with('success', 'Group Created Successfully...Please Add Members To complete');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function show(Group $group)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function edit(Group $group)
    {

        return view('group.edit')->with([
            'group' => Group::groupByID($group->id),
            'farmers' => Farmer::getFarmers()->get(),
            'group_members' => GroupMember::groupMembersByGroup($group->id),
            'group_members_array' => GroupMember::where('group_id', $group->id)->pluck('farmer_id')->toArray(),
            'group_leader' => GroupMember::where('group_id', $group->id)->where('group_leader', 1)->first(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Group $group)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Group  $group
     * @return \Illuminate\Http\Response
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return back()->with('success', 'Group deleted');
    }
}
