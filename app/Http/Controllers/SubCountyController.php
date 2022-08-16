<?php

namespace App\Http\Controllers;

use App\Models\SubCounty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class SubCountyController extends Controller
{


    public function sub_counties_with_county_id(Request $request)
    {

        $sub_counties = SubCounty::where('county_id', $request->input('county'))->get();

        if ($request->ajax()) {
            return  Response::json($sub_counties);
        }


        return $sub_counties;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function show(SubCounty $subCounty)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function edit(SubCounty $subCounty)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SubCounty $subCounty)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubCounty  $subCounty
     * @return \Illuminate\Http\Response
     */
    public function destroy(SubCounty $subCounty)
    {
        //
    }
}
