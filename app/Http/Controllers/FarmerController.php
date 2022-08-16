<?php

namespace App\Http\Controllers;

use App\Models\AgeGroup;
use App\Models\Country;
use App\Models\County;
use App\Models\Farmer;
use App\Models\FarmerDocument;
use App\Models\FarmerDocumentType;
use App\Models\FarmerInputItem;
use App\Models\FarmerProduce;
use App\Models\FarmerProduceType;
use App\Models\FarmerService;
use App\Models\Gender;
use App\Models\Input;
use App\Models\Produce;
use App\Models\ProduceType;
use App\Models\Service;
use App\Models\SubCounty;
use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Response;

class FarmerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
      public function __construct()
    {
        $this->middleware('auth');
         
        
    }
    public function index()
    {

        return view('farmers.index')->with([
            'farmers' => Farmer::getFarmers()->paginate(10),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('farmers.create')->with([
            'countries' => Country::where('active', 1)->pluck('country_name', 'id'),
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'produce_types' => ProduceType::where('active', 1)->pluck('produce_type_name', 'id'),
            'produces' => Produce::where('active', 1)->pluck('produce_name', 'id'),
            'genders' => Gender::pluck('gender_name', 'id'),
            'dob_end_date' => Carbon::now()->subYear(18)->format("31-12-Y"),
            'age_group' => AgeGroup::pluck('age_group_name', 'id')

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        // Farmer::$REQ_FIELDS['consent_upload'] = 'mimes:doc,pdf,docx,png,jpg,jpeg|required';
        $this->validate($request, Farmer::$REQ_FIELDS);
        $farmer = new Farmer;
        $farmer_id = Farmer::updateFarmer($request, $farmer);

        return redirect('farmer/' . $farmer_id . '/edit/')->with('success', 'Farmer Created Successfully');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function show(Farmer $farmer)
    {
        return view('farmers.show')->with([
            'farmer' => Farmer::getFarmerByID($farmer->id),
            'farmer_produce_types' => FarmerProduceType::getFarmerProduceTypes($farmer->id)->pluck('produce_type_name')->toArray(),
            'farmer_produces' => FarmerProduce::getFarmerProduces($farmer->id),
            'farmer_documents' => FarmerDocument::getFarmerDocuments($farmer->id),
            'progress' => Farmer::farmerProfileProgress($farmer),
            'farmer_inputs' => FarmerInputItem::getFarmerInputItems($farmer->id),
            'farmer_services' => FarmerService::getFarmersServices($farmer->id),

        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function edit(Farmer $farmer)
    {

        return view('farmers.edit')->with([
            'countries' => Country::where('active', 1)->pluck('country_name', 'id'),
            'counties' => County::where('active', 1)->pluck('county_name', 'id'),
            'produce_types' => ProduceType::where('active', 1)->pluck('produce_type_name', 'id'),
            'produces' => Produce::where('active', 1)->pluck('produce_name', 'id'),
            'farmer' => Farmer::getFarmerByID($farmer->id),
            'farmer_produce_types' => FarmerProduceType::where('farmer_id', $farmer->id)->pluck('produce_type_id')->toArray(),
            'farmer_produces' => FarmerProduce::getFarmerProduces($farmer->id),
            'genders' => Gender::pluck('gender_name', 'id'),
            'units' => Unit::where('active', 1)->pluck('unit_name', 'id'),
            'farmer_document_types' => FarmerDocumentType::where('active', 1)->pluck('document_type_name', 'id'),
            'farmer_documents' => FarmerDocument::getFarmerDocuments($farmer->id),
            'dob_end_date' => Carbon::now()->subYear(18)->format("31-12-Y"),
            'farmer_produces' => !empty($farmer) ? FarmerProduce::getFarmerProduces($farmer->id) : null,
            'inputs' => Input::where('is_active', 1)->pluck('input_name', 'id'),
            'services' => Service::where('active', 1)->pluck('service_name', 'id'),
            'farmer_inputs' => FarmerInputItem::getFarmerInputItems($farmer->id),
            'farmer_services' => FarmerService::getFarmersServices($farmer->id),
            'farmer_id_uploaded' => FarmerDocument::where('farmer_id', $farmer->id)->where('document_type_id', 2)->count(),
            'age_group' => AgeGroup::pluck('age_group_name', 'id')


        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Farmer $farmer)
    {
        $this->validate($request, Farmer::$REQ_FIELDS);
        Farmer::updateFarmer($request, $farmer);

        return redirect('farmer')->with('success', 'Farmer Edited Successfully');
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Farmer  $farmer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Farmer $farmer)
    {
        $farmer->delete();
        return back()->with('success', 'Farmer Deleted');
    }
}
