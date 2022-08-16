@extends('adminlte::page')

@section('title', 'Farmers Report')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Farmers Report</h3>
    </div>

    <div class="card-body">
        {!!
        Form::open(['action'=>'ReportController@search_farmers','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}


        <div class="row">


            <div class="col-md-4">
                {{Form::label('town[]', 'Farmer Town/County ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('town[]', $counties,request()->input('town'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('produces[]', 'Farmer Produce',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('produces[]', $produces,request()->input('produces'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>

            <div class="col-md-4">
                {{Form::label('gender[]', 'Farmer Gender',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('gender[]', $genders,request()->input('gender'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>



        </div>
        <div class="row">
            <div class="col-md-6">
                {{Form::label('agent[]', 'By Field Officer',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('agent[]', $agents,request()->input('agent'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>

            <div class="col-md-3">
                {{Form::label('date_from', 'Date Registered From')}}
                <div class="form-group">
                    {{Form::text('date_from', !empty(request()->input('date_from')) ? \Carbon\Carbon::parse(request()->input('date_from'))->format('d-m-Y'):'' ,['class'=>'form-control date', 'placeholder'=>'Farmers Registered From','autocomplete'=>'off'])}}
                </div>
            </div>
            <div class="col-md-3">
                {{Form::label('registered_to', 'Date Registered To')}}
                <div class="form-group">
                    {{Form::text('registered_to',!empty(request()->input('registered_to')) ? \Carbon\Carbon::parse(request()->input('registered_to'))->format('d-m-Y'):'',['class'=>'form-control date', 'placeholder'=>'Farmers Registered To','autocomplete'=>'off'])}}
                </div>
            </div>
        </div>

        <input type="hidden" name="searchFarmers" value="1">

        <button type="submit" class="btn btn-success"><strong>SUBMIT</strong></button>


        <hr />

        @if($searching)

        <div style="margin-bottom: 15px">
            <button type="submit" name="generate_excel" class="btn btn-xs btn-default" style="float: right"><strong><i
                        class="fas fa-file-excel"></i> GENERATE EXCEL</strong></button>
            <div style="clear: both"></div>
        </div>



        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>Full Names</th>
                        <th>Account No</th>
                        <th>Telephone</th>
                        <th>ID Number</th>
                        <th>Produce</th>
                        <th>Town/County</th>
                        <th>Sub County</th>
                        <th>Registered By</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($farmers as $farmer)
                    <tr>
                        <td>
                            <a href="{{url('/')}}/farmer/{{$farmer->id}}"><b>{{$farmer->first_name}}
                                    {{$farmer->last_name}}</b></a></td>
                        <td><span class=" badge badge-success">{{$farmer->id}}</span></td>
                        <td>{{$farmer->phone1}}</td>
                        <td>{{$farmer->id_passport}}</td>
                        <td>{{$farmer->produce_name}}</td>
                        <td>{{$farmer->county_name}}</td>
                        <td>{{$farmer->sub_county_name}}</td>
                        <td> {{$farmer->created_by}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
        {!! Form::close() !!}

    </div>

</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.2.7/css/rowReorder.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.6/css/responsive.dataTables.min.css">
@stop

@section('js')
<script src="https://cdn.datatables.net/rowreorder/1.2.7/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.6/js/dataTables.responsive.min.js"></script>
<script>
    $(function () {
        $('.select2').select2()
        $('.date').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
        $("#example1").DataTable({
            // "responsive": false,
            "autoWidth": false,
             "ordering": false,
            "rowReorder": {
            "selector": 'td:nth-child(3)'
            },
            "responsive": true,
        });
   
    });

</script>
@stop