<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\FarmerInput;
use App\Models\FarmerInputItem;
use App\Models\Input;
use App\Models\SubInput;
use App\Models\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class FarmerInputController extends Controller
{




    public function get_farm_inputs(Request $request)
    {
        return response()->json([
            'success' => true,
            'farmer_inputs' => FarmerInput::getFarmerInputs($request->input('user_id')),
        ]);
    }

    public function search_farmer($search_term, $user_id)
    {
        // $user = User::find($user_id);
        $record = Farmer::leftJoin('countries', 'farmers.country', '=', 'countries.id')
            ->leftJoin('counties', 'farmers.town', '=', 'counties.id')
            ->leftJoin('sub_counties', 'farmers.sub_county', '=', 'sub_counties.id');
        $record->orwhere(function ($q) use ($search_term) {
            $q->orWhere('farmers.id', $search_term);
            $q->orWhere('farmers.id_passport', $search_term);
            $q->orWhere('farmers.phone1', $search_term);
        });

        // if (!$user->can('View All Farmers'))
        //     $farmers->where('farmers.created_by', $user_id);
        // $farmers->orderBy('farmers.id', 'DESC');'

        $farmer = $record->first(
            [
                'farmers.*',
                'counties.county_name',
                'sub_counties.sub_county_name'
            ]
        );

        if (!empty($farmer)) {

            return response()->json([
                'success' => true,
                'farmer' => $farmer,
            ]);
        } else {
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Farmer not found... Please check your values and try again.',
                ],
                401
            );
        }
    }

    public function add(Request $request)
    {
        $farmer_input = new FarmerInput();
        $farmer_input->farmer_id = $request->input('farmer_id');
        $farmer_input->description = '';
        $farmer_input->date = Carbon::now()->format("Y-m-d");
        $farmer_input->created_by = $request->input('created_by');
        $farmer_input->updated_by = $request->input('created_by');
        $farmer_input->save();
        return response()->json([
            'success' => true,
            'farmer_id' => $request->input('farmer_id'),
            'farmer_input_id' => $farmer_input->id,
        ]);
    }

    public function add_farm_input_item(Request $request)
    {
        $farmer_input = new FarmerInputItem();
        $farmer_input->farmer_id = $request->input('farmer_id');
        $farmer_input->farmer_input_id = $request->input('farmer_input_id');
        $farmer_input->input_id = $request->input('input_id');
        $farmer_input->sub_input_id = $request->input('sub_input_id');
        $farmer_input->quantity = $request->input('quantity');
        $farmer_input->unit_id = $request->input('unit_id');
        $farmer_input->description = $request->input('description');
        $farmer_input->created_by = $request->input('created_by');
        $farmer_input->updated_by = $request->input('created_by');
        $farmer_input->save();
        return response()->json([
            'success' => true,
            'farmer_id' => $request->input('farmer_id'),
            'farmer_input_item_id' => $farmer_input->id,
        ]);
    }


    public function add_farm_input_init(Request $request)
    {
        return response()->json([
            'success' => true,
            'inputs' => Input::where('is_active', 1)->get(['id', 'input_name']),
            'units' => Unit::where('active', 1)->get(['id', 'unit_name']),
            'farmer_input' => FarmerInput::where('id', $request->input('farmer_input_id'))->first(),
        ]);
    }


    public function get_sub_input_data(Request $request)
    {
        return response()->json([
            'success' => true,
            'sub_inputs' => SubInput::where('input_id', $request->input('input'))->where('active', 1)->get(['id', 'sub_input_name']),
        ]);
    }


    public function delete_farm_input_item(Request $request)
    {

        FarmerInputItem::where('id', $request->input('farm_input_item_id'))->delete();
        return response()->json([
            'success' => true,
            'current_farmer_inputs_items' => FarmerInputItem::leftJoin('inputs', 'farmer_input_items.input_id', '=', 'inputs.id')
                ->leftJoin('sub_inputs', 'farmer_input_items.sub_input_id', '=', 'sub_inputs.id')
                ->leftJoin('units', 'farmer_input_items.unit_id', '=', 'units.id')
                ->where('farmer_input_items.farmer_input_id', $request->input('farm_input_id'))
                ->get([
                    'inputs.*',
                    'farmer_input_items.*',
                    'farmer_input_items.id AS farmer_input_item_id',
                    'farmer_input_items.description AS farm_input_desc',
                    'sub_inputs.*',
                    'units.*'
                ])
        ]);
    }


    public function delete_farm_input(Request $request)
    {

        FarmerInput::where('id', $request->input('farm_input'))->delete();
        return response()->json([
            'success' => true,
            'farmer_inputs' => FarmerInput::getFarmerInputs($request->input('user_id')),
        ]);
    }


    public function get_init_details(Request $request)
    {

        $farmerInput = FarmerInput::where('id', $request->input('farm_input_id'))->first();
        return response()->json([
            'success' => true,
            'farmer_id' => $request->input('farmer_id'),
            'farmer' =>  Farmer::getFarmerByID($farmerInput->farmer_id),
            'current_farmer_inputs_items' => FarmerInputItem::leftJoin('inputs', 'farmer_input_items.input_id', '=', 'inputs.id')
                ->leftJoin('sub_inputs', 'farmer_input_items.sub_input_id', '=', 'sub_inputs.id')
                ->leftJoin('units', 'farmer_input_items.unit_id', '=', 'units.id')
                ->where('farmer_input_items.farmer_input_id', $farmerInput->id)
                ->get([
                    'inputs.*',
                    'farmer_input_items.*',
                    'farmer_input_items.id AS farmer_input_item_id',
                    'farmer_input_items.description AS farm_input_desc',
                    'sub_inputs.*',
                    'units.*'
                ])
        ]);
    }
}
