<?php

namespace App\Models;

use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Group extends Model
{

    public static function groupByID($group_id)
    {
        return self::leftJoin('counties', 'groups.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'groups.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'groups.created_by', '=', 'users.id')
            ->where('groups.id', $group_id)
            ->first([
                'groups.*',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'users.name AS created_by'
            ]);
    }


    public static function getGroups($user_id = null)
    {

        $user = ($user_id != null) ? User::find($user_id) : User::find(Auth::user()->id);
        $groups = self::select([
            'groups.*',
            'counties.county_name',
            'sub_counties.sub_county_name',
            'users.name AS created_by',
        ])->leftJoin('counties', 'groups.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'groups.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'groups.created_by', '=', 'users.id');
        if (!$user->can('View All Groups'))
            $groups->where('groups.created_by', ($user_id != null) ? $user_id : Auth::user()->id);
       return  $groups->orderBy('groups.id', 'DESC');
       // $records = $groups->get();

       /* foreach ($records as $record) {
            $record->members_count = GroupMember::where('group_id', $record->id)->get()->count();
        }
*/
       // return $records;
    }



    public static function searchGroups($request, $type)
    {
        $query = self::leftJoin('counties', 'groups.county', '=', 'counties.id')
            ->leftJoin('sub_counties', 'groups.sub_county', '=', 'sub_counties.id')
            ->leftJoin('users', 'groups.created_by', '=', 'users.id');

        if (!empty($request->input('town'))) {
            $query->WhereIn('groups.county', $request->input('town'));
        }

        if (!empty($request->input('agent'))) {
            $query->WhereIn('groups.created_by', $request->input('agent'));
        }

        if (!empty($request->input('date_from')) && !empty($request->input('registered_to'))) {

            $query->where([
                ['groups.created_at', '>=',  Carbon::parse($request->input('date_from'))->format('Y-m-d')],
                ['groups.created_at', '<',  Carbon::parse($request->input('registered_to'))->addDays(1)->format('Y-m-d')],
            ]);
        }

        if ($type == 'preview') {
            $colums = [
                'groups.*',
                'counties.county_name',
                'sub_counties.sub_county_name',
                'users.name AS created_by',
            ];
        } else {
            $colums = [
                'groups.group_name',
                'groups.ID',
                'counties.county_name',
                'sub_counties.sub_county_name',
                DB::raw("DATE_FORMAT(groups.created_at,'%d-%m-%Y')"),
                'users.name',
                'groups.description',
            ];
        }
        return  $query->get($colums);
    }
}
