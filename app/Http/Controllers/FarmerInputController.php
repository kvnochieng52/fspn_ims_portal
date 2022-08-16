<?php

namespace App\Http\Controllers;

use App\Models\Farmer;
use App\Models\FarmerInput;
use App\Models\FarmerInputItem;
use App\Models\FarmerProduce;
use App\Models\FarmerService;
use App\Models\Input;
use App\Models\SubInput;
use App\Models\Unit;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class FarmerInputController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  view('farmer_inputs.index')->with([
            'farmer_inputs' => FarmerInputItem::getAllFarmInputItems(),
        ]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {

        $farmer = null;
        $searched = 0;

        if (!empty($request->input('account'))) {
            $farmer = Farmer::searchFarmer($request->input('account'));
            $searched = 1;
        }


        return  view('farmer_inputs.create')->with([
            'farmer' => $farmer,
            'searched' => $searched,
            'farmer_produces' => !empty($farmer) ? FarmerProduce::getFarmerProduces($farmer->id) : null,
            'inputs' => Input::where('is_active', 1)->pluck('input_name', 'id'),
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
        $farmer_input = new FarmerInput();
        $farmer_input->farmer_id = $request->input('farmer_id');
        $farmer_input->description = $request->input('description');
        $farmer_input->date = Carbon::parse($request->input('date'))->format("Y-m-d");
        $farmer_input->created_by = Auth::user()->id;
        $farmer_input->updated_by = Auth::user()->id;
        $farmer_input->save();
        return redirect('farmer_input/' . $farmer_input->id)->with('success', 'Request Created Successfully...Please select the required items');
    }

    public function store_farmer_input_item(Request $request)
    {

        $farmer_input = new FarmerInputItem();
        $farmer_input->farmer_id = $request->input('farmer_id');
        $farmer_input->input_id = $request->input('input');
        $farmer_input->sub_input_id = $request->input('sub_input');
        $farmer_input->quantity = $request->input('quantity');
        $farmer_input->unit_id = $request->input('unit');
        $farmer_input->description = $request->input('specification');
        $farmer_input->created_by = Auth::user()->id;
        $farmer_input->updated_by = Auth::user()->id;
        $farmer_input->save();
        return back()->with('success', 'Item added Successfully...');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FarmerInput  $farmerInput
     * @return \Illuminate\Http\Response
     */
    public function show(FarmerInput $farmerInput)
    {

        return view('farmer_inputs.show')->with([
            'farmer' =>  Farmer::getFarmerByID($farmerInput->farmer_id),
            'farmer_produces' => FarmerProduce::getFarmerProduces($farmerInput->farmer_id),
            'farmerInput' => $farmerInput,
            'inputs' => Input::where('is_active', 1)->pluck('input_name', 'id'),
            'units' => Unit::where('active', 1)->pluck('unit_name', 'id'),
            'current_farmer_inputs_items' => FarmerInputItem::leftJoin('inputs', 'farmer_input_items.input_id', '=', 'inputs.id')
                ->leftJoin('sub_inputs', 'farmer_input_items.sub_input_id', '=', 'sub_inputs.id')
                ->leftJoin('units', 'farmer_input_items.unit_id', '=', 'units.id')
                ->where('farmer_input_items.farmer_input_id', $farmerInput->id)
                ->get([
                    'inputs.*',
                    'farmer_input_items.*',
                    'farmer_input_items.description AS farm_input_desc',
                    'sub_inputs.*',
                    'units.*'
                ])
        ]);
    }


    public function store_extension_service(Request $request)
    {
        $farmerService = new FarmerService();
        $farmerService->farmer_id = $request->input('farmer_id');
        $farmerService->service_id = $request->input('service');
        $farmerService->description = $request->input('description');
        $farmerService->created_by = Auth::user()->id;
        $farmerService->updated_by = Auth::user()->id;
        $farmerService->save();
        return back()->with('success', 'Service added Successfully...');
    }


    public function farmerservicedelete($service_id)
    {

        $service = FarmerService::where('id', $service_id);
        $service->delete();
        return back()->with('success', 'Service Deleted');
    }


    public function farmerinputdelete($input_id)
    {

        $input_item = FarmerInputItem::where('id', $input_id);
        $input_item->delete();
        return back()->with('success', 'Service Deleted');
    }





    public function get_sub_inputs(Request $request)
    {
        $sub_inputs = SubInput::where('input_id', $request->input('input'))->get();

        if ($request->ajax()) {
            return  Response::json($sub_inputs);
        }


        return $sub_inputs;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FarmerInput  $farmerInput
     * @return \Illuminate\Http\Response
     */
    public function edit(FarmerInput $farmerInput)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FarmerInput  $farmerInput
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, FarmerInput $farmerInput)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\FarmerInput  $farmerInput
     * @return \Illuminate\Http\Response
     */
    public function destroy(FarmerInput $farmerInput)
    {
        //
    }
}
