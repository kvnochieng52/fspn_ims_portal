@extends('adminlte::page')

@section('title', 'Create Farmer')

@section('content')

@include('notices')
{!!
Form::open(['action'=>'FarmerController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">New Farmer</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-5">
                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('first_name', 'First Name* ')}}
                        <div class="form-group">
                            {{Form::text('first_name', null,['class'=>'form-control', 'placeholder'=>'Enter Farmers First Name','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('last_name', 'Last  Name* ')}}
                        <div class="form-group">
                            {{Form::text('last_name', null,['class'=>'form-control', 'placeholder'=>'Enter Farmers Last Name','required'=>'required'])}}
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('id_passport', 'ID/Passport No ')}}
                        <div class="form-group">
                            {{Form::text('id_passport', null,['class'=>'form-control', 'placeholder'=>'Enter Farmers ID/Passport No.'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('email', 'Email Address ')}}
                        <div class="form-group">
                            {{Form::email('email', null,['class'=>'form-control', 'placeholder'=>'Email Address'])}}
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('phone', 'Phone* ')}}
                        <div class="form-group">
                            {{Form::text('phone', null,['class'=>'form-control', 'placeholder'=>'Phone','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('phone2', 'Alternate Phone ')}}
                        <div class="form-group">
                            {{Form::text('phone2', null,['class'=>'form-control', 'placeholder'=>'Alternate Phone'])}}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        {{Form::label('country', 'Country* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('country', $countries,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('town', 'Town/County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('town', $counties,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>


                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('sub_county', 'Sub County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sub_county', [],null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>



                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('address', 'Physical Address* ')}}
                        <div class="form-group">
                            {{Form::textarea('address', null,['class'=>'form-control', 'placeholder'=>'Enter the farmers address','style'=>'height:70px','required'=>'required'])}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 offset-1">

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('gender', 'Gender* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('gender', $genders,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>


                    <div class="col-md-6">
                        {{Form::label('age_group', 'Age Group ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('age_group', $age_group,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Select Age Group--']) }}
                        </div>
                    </div>

                    {{-- <div class="col-md-6">
                        {{Form::label('date_of_birth', 'Date Of Birth (18 Years & above)* ')}}
                    <div class="form-group">
                        {{Form::text('date_of_birth', null,['class'=>'form-control dob', 'placeholder'=>'Enter Farmers Last Name','required'=>'required','autocomplete'=>'off','data-date-end-date'=>$dob_end_date])}}
                    </div>
                </div> --}}
            </div>

            <div class="row">

                <div class="col-md-12">
                    {{Form::label('land_size', 'Total Land Size in Acre* ')}}
                    <div class="form-group">
                        {{Form::text('land_size', null,['class'=>'form-control', 'placeholder'=>'Enter the Farmers Total land size expressed in Acres','required'=>'required'])}}
                    </div>
                </div>


                <div class="col-md-12">
                    <p style="padding: 0px; margin:0px">Type of the Produce</p>
                    @foreach($produce_types as $key=>$produce_type)
                    <label class="radio-inline">

                        <input type="checkbox" name="produce_type[]" value="{{$key}}"> {{$produce_type}}
                    </label> &nbsp;&nbsp;
                    @endforeach


                </div>

                {{-- <div class="col-md-12">
                        {{Form::label('produces', 'Produces* ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('produces[]', $produces,null, ['class' => 'select2 form-control','style'=>'width:100%','required'=>'required','multiple'=>'multiple']) }}
                </div>
            </div> --}}


            <div class="col-md-12">
                {{Form::label('comments', 'Additional Notes(optional)')}}
                <div class="form-group">
                    {{Form::textarea('comments', null,['class'=>'form-control', 'placeholder'=>'Any other Addtional Notes or Comments?','style'=>'height:70px'])}}
                </div>
            </div>


            <div class="col-md-12">
                <p><label><input type="checkbox" name="consent_provided" value="1"> Farmer has been provided &
                        signed
                        Consent Form*</label>
                </p>
                {{-- {{Form::label('consent_upload', 'Upload Consent form*')}}
                <div class="form-group">
                    <input type="file" name="consent_upload" id="consent_upload">
                </div> --}}
            </div>


        </div>
    </div>
</div>

</div>
<div class="card-footer">
    <div class="row">

        <div class="col-md-12">
            <button type="submit" class="btn btn-success"><strong> SUBMIT DETAILS</strong></button>
        </div>
    </div>
</div>
</div>
{!! Form::close() !!}

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/validator/bootstrapValidator.min.css" />
@stop

@section('js')
<script src="/js/validator/bootstrapValidator.min.js"></script>
<script>
    $(document).ready(function () {
        $('.select2').select2()
        $('.dob').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
            //endDate : '03-04-2021',
        });

        
        $('#town').change(function(){  
			$.ajax({
                type:'GET',
                url:'/sub_county/sub_counties_with_county_id',
				data:{'county':$(this).val()},
                success:function(data){
					var $dropdown = $("#sub_county");
					$($dropdown)[0].options.length = 0;
					$dropdown.append($("<option />").text('--Select Sub Location--'));

					$.each(data, function(index, element) {
						$dropdown.append($("<option />").val(element.id).text(element.sub_county_name));
					});

                },
                error:function(e){}
            });
        });


          $('.user_form')
                .bootstrapValidator({
                    excluded: [':disabled'],
                    feedbackIcons: {
                    valid: 'glyphicon glyphicon-ok',
                    invalid: 'glyphicon glyphicon-remove',
                    validating: 'glyphicon glyphicon-refresh'
                    },
                });
    });
</script>
@stop