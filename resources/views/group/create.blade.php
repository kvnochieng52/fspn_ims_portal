@extends('adminlte::page')

@section('title', 'Create Group')

@section('content')

@include('notices')
{!!
Form::open(['action'=>'GroupController@store','method'=>'POST','class'=>'form user_form',
'enctype'=>'multipart/form-data'])
!!}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Create Group</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-7">
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('group_name', 'Group Name* ')}}
                        <div class="form-group">
                            {{Form::text('group_name', null,['class'=>'form-control', 'placeholder'=>'Enter Group Name','required'=>'required','autocomplete'=>'off'])}}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        {{Form::label('county', 'County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('county', $counties,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        {{Form::label('sub_county', 'Sub County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sub_county', [],null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">

                {{Form::label('description', 'Description(optional) ')}}
                <div class="form-group">
                    {{Form::textarea('description', null,['style'=>'height:120px','class'=>'form-control', 'placeholder'=>'Enter Groups Description','autocomplete'=>'off'])}}
                </div>
            </div>


        </div>
    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-success btn-block"><b>CREATE GROUP</b> </button>
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