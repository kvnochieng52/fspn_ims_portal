@extends('adminlte::page')

@section('title', 'Farmers')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Farmers</h3>
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table id="example1" class="table table-bordered table-striped display nowrap">
                <thead>
                    <tr>
                        <th>Full Names</th>
                        <th>Account No</th>
                        <th>Telephone</th>
                        <th>ID Number</th>

                        <th>Town/County</th>
                        <th>Sub County</th>
                        <th>Profile</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($farmers as $farmer)
                    <tr>
                        <td><img src="/images/no_photo.png" alt="Product 1" class="img-circle img-size-32 mr-2">
                            <a href="{{url('/')}}/farmer/{{$farmer->id}}"><b>{{$farmer->first_name}}
                                    {{$farmer->last_name}}</b></a></td>
                        <td><span class=" badge badge-success">{{$farmer->id}}</span></td>
                        <td>{{$farmer->phone1}}</td>
                        <td>{{$farmer->id_passport}}</td>

                        <td>{{$farmer->county_name}}</td>
                        <td>{{$farmer->sub_county_name}}</td>
                        <td>

                            <?php $progress=\App\Models\Farmer::farmerProfileProgress($farmer) ?>


                            <div class="progress" style="height:10px">
                                <div class="progress-bar {{$progress ==100 ? 'bg-success' : 'bg-danger'}} progress-sm"
                                    role="progressbar" style="width: {{$progress}}%" aria-valuenow="{{$progress}}"
                                    aria-valuemin="0" aria-valuemax="{{$progress}}"></div>

                            </div>

                            <p style="font-size: 12px" class="{{$progress ==100 ? 'text-green' : 'text-red'}}">
                                {{$progress}}% Completed</p>
                        </td>
                        <td>

                            {!!
                            Form::open(['action'=>['FarmerController@destroy',$farmer->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}
                            @can('View Farmers')
                            <a href="{{url('/')}}/farmer/{{$farmer->id}}" title="View Details"
                                class="btn btn-xs btn-success"><strong> <i class="fas fa-search"></i></strong> </a>
                            &nbsp;&nbsp;
                            @endcan
                            @can('Edit Farmer')
                            <a href="{{url('/')}}/farmer/{{$farmer->id}}/edit" title="Edit Details"
                                class="btn btn-xs btn-secondary"><strong> <i class="fas fa-edit"></i></strong> </a>

                            &nbsp;&nbsp;
                            @endcan

                            @can('Delete Farmer')
                            {{Form::hidden('_method','DELETE')}}

                            <button type="submit" class="btn btn-secondary btn-xs btn-flat"
                                onClick="return confirm('Are you sure you want to delete this User?');"> <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>
                            @endcan

                            {!! Form::close() !!}





                        </td>


                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


  {{ $farmers->links() }} 
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