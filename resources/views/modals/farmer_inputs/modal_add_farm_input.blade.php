<div class="modal fade" id="new_farm_input">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            {!!
            Form::open(['action'=>'FarmerInputController@store_farmer_input_item','method'=>'POST','class'=>'form
            user_form',
            'enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <h4 class="modal-title">New Farm Input</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                @if($farmer_id_uploaded > 0)
                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('input', 'Select Requested Input* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('input', $inputs,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('sub_input', 'Select Sub Sub Input ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sub_input', [],null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{Form::label('quantity', 'Quantity ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{Form::text('quantity', null,['class'=>'form-control', 'placeholder'=>'Enter Required Quantity','autocomplete'=>'off'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('unit', 'Select Unit* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('unit', $units,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('specification', 'Please Specify',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{Form::textarea('specification', null,['style'=>'height:150px','class'=>'form-control', 'placeholder'=>'Please Specify...','autocomplete'=>'off'])}}
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-danger">
                    Please upload the Farmers National ID to add the Extension services
                </div>

                @endif
            </div>
            <div class="modal-footer justify-content-between">
                {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}

                @if($farmer_id_uploaded > 0)
                <button type="submit" class="btn btn-primary">Submit</button>
                @endif
                <input type="hidden" name="farmer_id" value="{{$farmer->id}}">
                {{-- <input type="hidden" name="farmer_input_id" value="{{$farmerInput->id}}"> --}}
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
</div>