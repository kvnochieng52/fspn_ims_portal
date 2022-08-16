@extends('adminlte::page')

@section('title', 'Groups')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Groups Members Reports</h3>
    </div>

    <div class="card-body">
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
                        <th></th>
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
                        <td>

                            <a href="/report/group_members?group_id={{$group->id}}}" target="_blank"
                                class="btn btn-default btn-sm" style="float: right">
                                <i class="fas fa-file-excel"></i> EXPORT TO EXCEL</a>




                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

{{ $groups->links() }}
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