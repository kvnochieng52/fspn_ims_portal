<div class="modal fade" id="new_ext_service">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {!!
            Form::open(['action'=>'FarmerInputController@store_extension_service','method'=>'POST','class'=>'form
            user_form',
            'enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <h4 class="modal-title">New Extension Service</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">


                @if($farmer_id_uploaded > 0)
                <div class="row">

                    <div class="col-md-12">
                        {{Form::label('service', 'Select service* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('service', $services,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div>


                </div>

                <div class="row">


                    <div class="col-md-12">

                        {{Form::label('description', 'Notes',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{Form::textarea('description', null,['style'=>'height:150px','class'=>'form-control', 'placeholder'=>'Enter any additional Info','autocomplete'=>'off'])}}
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
                @if($farmer_id_uploaded > 0)
                <button type="submit" class="btn btn-success"><b>SUBMIT DETAILS</b></button>
                @endif
                <input type="hidden" name="farmer_id" value="{{$farmer->id}}">
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
</div>