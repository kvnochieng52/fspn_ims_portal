<?php

namespace App\Http\Controllers;

use App\Models\FarmerProduce;
use App\Models\FarmerProduceType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Str;

class FarmerProduceController extends Controller
{
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
        $farmer_produce = new FarmerProduce();
        $farmer_produce->farmer_id = $request->input('farmer_id');
        $farmer_produce->produce_id = $request->input('produce');
        $farmer_produce->sub_produce_id = $request->input('produce_subtype');
        $farmer_produce->capacity = $request->input('production_capacity');
        $farmer_produce->unit = $request->input('measurement_unit');
        $farmer_produce->production_area = $request->input('production_area');
        $farmer_produce->description = $request->input('description');
        $farmer_produce->created_by = Auth::user()->id;
        $farmer_produce->updated_by = Auth::user()->id;

        if ($request->hasFile('photo_upload') && $request->file('photo_upload')->isValid()) {
            $photo_upload_file = $request->file('photo_upload');
            $photo_upload_file_name = Str::random(30) . '.' . $photo_upload_file->getClientOriginalExtension();
            $photo_upload_file->move('uploads/photo_uploads/', $photo_upload_file_name);
            $farmer_produce->production_image = 'uploads/photo_uploads/' . $photo_upload_file_name;
        }

        $farmer_produce->save();

        return back()->with('success', 'Farm Produce successfully submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }





    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmerProduce $farmerProduce)
    {
        $farmerProduce->delete();
        return back()->with('success', 'Farm Produce Deleted');
    }
}
