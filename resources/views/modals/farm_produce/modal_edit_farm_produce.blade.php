<div class="modal fade" id="new_farm_produce">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {!!
            Form::open(['action'=>'FarmerProduceController@store','method'=>'POST','class'=>'form
            user_form',
            'enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <h4 class="modal-title">New Farm produce</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('produce', 'Select Produce* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('produce', $produces,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div>

                    <div class="col-md-6">
                        {{Form::label('produce_subtype', 'Select Sub Produce',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('produce_subtype', [],null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--none--']) }}
                        </div>

                    </div>
                </div>
                {{-- <div class="col-md-6">
                        {{Form::label('input', 'Select Requested Input* ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('input', $inputs,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                </div>
            </div> --}}

            <div class="row">
                <div class="col-md-6">

                    <div class="row">
                        <div class="col-md-12">
                            {{Form::label('production_capacity', 'Production Capacity ',['class'=>'control-label'])}}
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        {{Form::text('production_capacity', null,['class'=>'form-control', 'placeholder'=>'Production Capacity','autocomplete'=>'off'])}}
                                    </div>
                                    <div class="col-md-6">
                                        {{ Form::select('measurement_unit', $units,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Select Measurement Unit--','required'=>'required']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            {{Form::label('production_area', 'Production Area in Acre*',['class'=>'control-label'])}}
                            <div class="form-group">
                                {{Form::text('production_area', null,['class'=>'form-control', 'placeholder'=>'Enter Production Area in Acre','autocomplete'=>'off'])}}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="exampleInputFile">Upload Porduce Photo</label>
                                <div class="input-group">
                                    <div class="custom-file">
                                        <input type="file" class="custom-file-input id_upload" id="id_upload"
                                            name="photo_upload">
                                        <label class="custom-file-label" for="id_upload"> Select the Photo
                                        </label>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-md-6">

                    {{Form::label('description', 'Description',['class'=>'control-label'])}}
                    <div class="form-group">
                        {{Form::textarea('description', null,['style'=>'height:150px','class'=>'form-control', 'placeholder'=>'Enter any additional Info','autocomplete'=>'off'])}}
                    </div>
                </div>


            </div>


        </div>
        <div class="modal-footer justify-content-between">
            {{-- <button type="button" class="btn btn-default" data-dismiss="modal">Close</button> --}}
            <button type="submit" class="btn btn-success"><b>SUBMIT DETAILS</b></button>
            <input type="hidden" name="farmer_id" value="{{$farmer->id}}">
        </div>

        {!! Form::close() !!}
    </div>
    <!-- /.modal-content -->
</div>

<!-- /.modal-dialog -->
</div>