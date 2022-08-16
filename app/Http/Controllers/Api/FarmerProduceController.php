<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Farmer;
use App\Models\FarmerProduce;
use App\Models\FarmerProduceType;
use App\Models\Produce;
use App\Models\ProduceSubType;
use App\Models\Unit;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;


class FarmerProduceController extends Controller
{
    public function init_data()
    {

        return response()->json([
            'success' => true,
            'produces' => Produce::where('active', 1)->get(['id', 'produce_name']),
            'units' => Unit::where('active', 1)->get(['id', 'unit_name']),
        ]);
    }

    public function sub_produce($produce_id)
    {
        return response()->json([
            'success' => true,
            'sub_produce' => ProduceSubType::where(['active' => 1, 'produce_id' => $produce_id])->get(['id', 'produce_sub_type_name']),
        ]);
    }


    public function add(Request $request)
    {
        $farmer_produce = new FarmerProduce();
        $farmer_produce->farmer_id = $request->input('farmer_id');
        $farmer_produce->produce_id = $request->input('produce_id');
        $farmer_produce->sub_produce_id = $request->input('sub_produce_id');
        $farmer_produce->capacity = $request->input('capacity');
        $farmer_produce->unit = $request->input('unit');
        $farmer_produce->production_area = $request->input('production_area');
        $farmer_produce->description = $request->input('description');
        $farmer_produce->created_by = $request->input('created_by');
        $farmer_produce->updated_by = $request->input('created_by');
        $farmer_produce->save();

        if (!empty($farmer_produce->id)) {
            return response()->json([
                'success' => true,
                'farmer_produce_id' => $farmer_produce->id,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong... Please try later',
            ], 401);
        }
    }


    public function delete(Request $request)
    {

        FarmerProduce::where('id', $request->input('produce_id'))->delete();
        return response()->json([
            'success' => true,
            'farmer_produce_id' => $request->input('produce_id'),
        ]);
    }
}
