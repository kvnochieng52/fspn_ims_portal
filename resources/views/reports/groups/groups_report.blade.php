@extends('adminlte::page')

@section('title', 'Groups Report')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Groups Report</h3>
    </div>

    <div class="card-body">
        {!!
        Form::open(['action'=>'ReportController@search_groups','method'=>'POST','class'=>'form user_form',
        'enctype'=>'multipart/form-data'])
        !!}


        <div class="row">


            <div class="col-md-6">
                {{Form::label('town[]', 'Group Town/County ',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('town[]', $counties,request()->input('town'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>

            <div class="col-md-6">
                {{Form::label('agent[]', 'By Field Officer',['class'=>'control-label'])}}
                <div class="form-group">
                    {{ Form::select('agent[]', $agents,request()->input('agent'), ['style'=>'width:100%','multiple'=>'true','class' => 'select2 form-control']) }}
                </div>
            </div>




        </div>
        <div class="row">


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
                        <th></th>
                        <th>Group Name</th>
                        <th>Group ID</th>
                        <th>County</th>
                        <th>Sub County</th>
                        <th>Date Created</th>
                        <th>Created By</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach($groups as $key=>$group)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <a href="{{url('/')}}/group/{{$group->id}}/edit"><b><i class="fas fa-users"></i>
                                    {{$group->group_name}}</b>
                            </a>
                        </td>
                        <td>GFSPN-{{$group->id}}</td>
                        <td>{{$group->county_name}}</td>
                        <td>{{$group->sub_county_name}}</td>
                        <td>{{\Carbon\Carbon::parse($group->created_at)->format('d-m-Y')}}</td>
                        <td>{{$group->created_by}}</td>
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