@extends('adminlte::page')

@section('title', 'Create Organization')

@section('content')

@include('notices')
{!!
Form::open(['action'=>'OrganizationController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">New Organization</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div>

    <div class="card-body">

        <div class="row">

            <div class="col-md-5">
                <div class="row">

                    <div class="col-md-12">
                        {{Form::label('organization_name', 'Organization Name* ')}}
                        <div class="form-group">
                            {{Form::text('organization_name', null,['class'=>'form-control', 'placeholder'=>'Enter the organization Name','required'=>'required'])}}
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('telephone', 'Telephone* ')}}
                        <div class="form-group">
                            {{Form::text('telephone', null,['class'=>'form-control', 'placeholder'=>'Enter Telephone No.','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('email', 'Email Address* ')}}
                        <div class="form-group">
                            {{Form::email('email', null,['class'=>'form-control', 'placeholder'=>'Email Address','required'=>'required'])}}
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
                        {{Form::label('county', 'Town/County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('county', $counties,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>


                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::label('sub_county', 'Sub County* ',['class'=>'control-label'])}}
                                <div class="form-group">
                                    {{ Form::select('sub_county', [],null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('address', 'Address* ')}}
                                <div class="form-group">
                                    {{Form::textarea('address', null,['class'=>'form-control', 'placeholder'=>'Enter the farmers address','style'=>'height:120px','required'=>'required'])}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-12">
                                {{Form::label('contact_person_name', 'Contact Person Name* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_name', null,['class'=>'form-control', 'placeholder'=>'Contact Person Name.','required'=>'required'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('contact_person_email', 'Contact Person Email* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_email', null,['class'=>'form-control', 'placeholder'=>'Contact Person Email.','required'=>'required'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('contact_person_telephone', 'Contact Person Telephone* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_telephone', null,['class'=>'form-control', 'placeholder'=>'Contact Person Telephone.','required'=>'required'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div class="col-md-5 offset-1">

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('registration_no', 'Registration No.')}}
                        <div class="form-group">
                            {{Form::text('registration_no', null,['class'=>'form-control', 'placeholder'=>'Registration No'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('date_of_registration', 'Date Of Registration ')}}
                        <div class="form-group">
                            {{Form::text('date_of_registration', null,['class'=>'form-control dob', 'placeholder'=>'Date of Registration','autocomplete'=>'off'])}}
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('website', 'Website')}}
                        <div class="form-group">
                            {{Form::text('website', null,['class'=>'form-control', 'placeholder'=>'Enter the website'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Organization Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input logo_upload" id="logo_upload"
                                        name="logo_upload">
                                    <label class="custom-file-label" for="logo_upload"> Select the Logo
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('specialization[]', 'Specialization/Category* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('specialization[]', $categories,null, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        {{Form::label('focus_areas[]', 'Focus Areas* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('focus_areas[]', $focus_areas,null, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        {{Form::label('sdgs[]', 'Sustainable Development Goals* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sdgs[]', $sdgs,null, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
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
<script type="text/javascript" src="/vendor/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        $('.select2').select2()
        $('.dob').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        
        $('#county').change(function(){  
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