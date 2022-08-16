@extends('adminlte::page')

@section('title', 'Farm Inputs')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Farm Inputs Requests</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>Farmer Names</th>
                        <th>Account No</th>
                        <th>Input Name</th>
                        <th>Sub Input Name</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Submitted By</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($farmer_inputs as $inputs)
                    <tr>
                        <td><a href="{{url('/')}}/farmer/{{$inputs->farmer_account}}"><b>{{$inputs->first_name}}
                                    {{$inputs->last_name}}</b></a></td>
                        <td>{{$inputs->farmer_account}}</td>
                        <td>{{$inputs->input_name}}</td>
                        <td>{{$inputs->sub_input_name}}</td>
                        <td>{{$inputs->quantity}} {{$inputs->unit_name}}</td>
                        <td>{{$inputs->created_at}}</td>
                        <td>{{$inputs->field_officer}}</td>


                        <td>
                            <a href="{{url('/')}}/farmer/{{$inputs->farmer_account}}" title="View Details"
                                class="btn btn-xs btn-primary"><strong> <i class="fas fa-search"></i></strong> </a>



                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>



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