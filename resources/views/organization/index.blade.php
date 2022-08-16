@extends('adminlte::page')

@section('title', 'Organizations')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Organizations</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <td>#</td>
                        <th>Organization Name</th>
                        <th>Telephone</th>
                        <th>Email</th>
                        <th>Contact Person</th>
                        <th>Town/County</th>
                        <th>Sub County</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($organizations as $key=>$organization)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            <a href="{{url('/')}}/organization/{{$organization->id}}"><b><i class="fa fa-sitemap"></i>
                                    {{$organization->organization_name}}</b></a>
                        </td>
                        <td>{{$organization->telephone}}</td>
                        <td>{{$organization->email}}</td>
                        <td>{{$organization->contact_person_name}}</td>
                        <td>{{$organization->country_name}}</td>
                        <td>{{$organization->sub_county_name}}</td>

                        <td>

                            {!!
                            Form::open(['action'=>['OrganizationController@destroy',$organization->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}
                            @can('View Farmers')
                            <a href="{{url('/')}}/organization/{{$organization->id}}" title="View Details"
                                class="btn btn-xs btn-success"><strong> <i class="fas fa-search"></i></strong> </a>
                            &nbsp;&nbsp;
                            @endcan
                            @can('Edit Farmer')
                            <a href="{{url('/')}}/organization/{{$organization->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong> </a>

                            &nbsp;&nbsp;
                            @endcan

                            @can('Delete Farmer')
                            {{Form::hidden('_method','DELETE')}}

                            <button type="submit" class="btn btn-secondary btn-xs btn-flat"
                                onClick="return confirm('Are you sure you want to delete this Organization?');">
                                <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>
                            @endcan

                            {!! Form::close() !!}





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