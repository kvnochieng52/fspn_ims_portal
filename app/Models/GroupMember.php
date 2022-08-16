<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GroupMember extends Model
{
    public static function groupMembersByGroup($group_id)
    {
        return self::leftJoin('farmers', 'group_members.farmer_id', '=', 'farmers.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id')
            ->leftJoin('genders', 'farmers.gender', '=', 'genders.id')
            ->where('group_members.group_id', $group_id)
            ->orderBy('group_members.group_leader', 'DESC')
            ->orderBy('group_members.id', 'DESC')
            ->get([
                'farmers.*',
                'counties.county_name',
                'sub_county_name',
                'genders.gender_name',
                'group_members.id AS group_member_id',
                'group_members.group_leader'
            ]);
    }


    public static function groupMembersByGroupExcel($group_id)
    {
        return self::leftJoin('farmers', 'group_members.farmer_id', '=', 'farmers.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id')
            ->leftJoin('genders', 'farmers.gender', '=', 'genders.id')
            ->leftJoin('users', 'farmers.created_by', '=', 'users.id')
            ->leftJoin('farmer_produces', 'farmers.id', '=', 'farmer_produces.farmer_id')
            ->leftJoin('produces', 'farmer_produces.produce_id', '=', 'produces.id')
            ->where('group_members.group_id', $group_id)
            ->orderBy('group_members.group_leader', 'DESC')
            ->orderBy('group_members.id', 'DESC')
            ->get([
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
                DB::raw("DATE_FORMAT(farmers.date_of_birth,'%d-%m-%Y')"),
                'farmers.land_size',
                'farmers.land_size',
                'produces.produce_name',
                'users.name',
                DB::raw("DATE_FORMAT(farmers.created_at,'%d-%m-%Y')"),
                'farmers.description'
            ]);
    }
}
