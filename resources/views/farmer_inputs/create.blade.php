@extends('adminlte::page')

@section('title', 'New Farm Input')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">New Farm Input</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div>

    <div class="card-body">

        @if($searched==1 && empty($farmer))
        <div class="alert alert-danger">
            Farmer Not found. Please Check your Values and Try Again
        </div>
        @endif


        {!!
        Form::open(['action'=>'FarmerInputController@create','method'=>'GET','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <div class="row">
            <div class="col-md-7">
                <div class="form-group row">
                    <label for="account" class="col-sm-4 col-form-label">Farmers A/c No or National ID </label>
                    <div class="col-sm-8">
                        <input type="text" name="account" class="form-control" id="account"
                            value="{{request()->get('account')}}"
                            placeholder="Enter the Farmers Account No or National ID" required>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <button class="btn btn-primary"><strong> SEARCH FARMER</strong></button>
            </div>
        </div>
        {!! Form::close() !!}
        <hr />

        @if(!empty($farmer))
        {!!
        Form::open(['action'=>'FarmerInputController@store','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}
        <div class="row">

            @include('farmer_inputs._intro_panel')
        </div>

        <div class="row">
            <div class="col-md-4">
                {{Form::label('request_date', 'Date of the Request  ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{Form::text('request_date', null,['class'=>'form-control dob', 'placeholder'=>'Enter the request Date','autocomplete'=>'off','required'=>'required'])}}
                </div>
            </div>

            <div class="col-md-8">
                {{Form::label('description', 'Any Additional Comments  ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{Form::textarea('description', null,['style'=>'height:90px','class'=>'form-control', 'placeholder'=>'Enter the request Date','autocomplete'=>'off'])}}
                </div>

            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <input type="hidden" name="farmer_id" value="{{$farmer->id}}">
                <button type="submit" class="btn btn-primary"><strong> CONTINUE</strong></button>
            </div>
        </div>

        {!! Form::close() !!}

        @endif
    </div>

</div>




@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
<script>
    $(document).ready(function () {
        $('.select2').select2()
        $('.dob').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
    });
</script>
@stop