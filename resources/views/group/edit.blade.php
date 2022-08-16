@extends('adminlte::page')

@section('title', 'Group Details')

@section('content')

@include('notices')

<div class="card">

    <div class="card-header">
        <h3 class="card-title">GROUP: {{$group->group_name}}</h3>
        <a href="/report/group_members?group_id={{$group->id}}" target="_blank" class="btn btn-default btn-sm"
            style="float: right">
            <i class="fas fa-file-excel"></i> EXPORT TO EXCEL</a>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box mb-3 bg-green">
                    <span class="info-box-icon"><i class="fas fa-file"></i></span>

                    <div class="info-box-content">

                        <div class="row">
                            <div class="col-md-6">
                                <span class="info-box-text"> <b>Group Name:</b> {{$group->group_name}} </span>
                                <span class="info-box-text"> <b>Group ID:</b> GFSPN-{{$group->id}}</span>
                                <span class="info-box-text"> <b>Created By:</b> {{$group->created_by}}</span>
                            </div>

                            <div class="col-md-6">
                                <span class="info-box-text"> <b>County:</b> {{$group->county_name}} </span>
                                <span class="info-box-text"> <b>Sub County:</b> {{$group->sub_county_name}}</span>
                                <span class="info-box-text"> <b>Date Created:</b>
                                    {{\Carbon\Carbon::parse($group->created_at)->format('d-m-Y')}}</span>
                            </div>
                        </div>
                        {{-- <span class="info-box-text"><a href="">Edit Details</a> </span> --}}


                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box mb-3 bg-green">
                    <span class="info-box-icon"><i class="fas fa-users"></i></span>

                    <div class="info-box-content">
                        <span class="info-box-text"> Group Total Members</span>
                        <h5 class="info-box-number">{{count($group_members)}}
                        </h5>


                    </div>
                    <!-- /.info-box-content -->
                </div>
            </div>
            <div class="col-md-12">
                <p><b>Group Description:</b> {{$group->description}}</p>
            </div>
        </div>
    </div>

    <div class="card-footer">
        <button class="btn btn-success btn-block btn-outline" data-toggle="modal" data-target="#modal-add-group-members"
            data-backdrop="static" data-keyboard="false"><b><i class="fas fa-fw fa-user-plus "></i> ADD
                MEMBERS</b> </button>
    </div>

    <div class="card-body">

        <h5>Group Members</h5>



        <div class="table-responsive">
            <table id="" class="table table-bordered table-striped display nowrap example1">
                <thead>
                    <tr>
                        <th>Full Names</th>
                        <th>Telephone</th>
                        <th>ID Number</th>
                        <th>Account No.</th>
                        <th>Town/County</th>
                        <th>Sub County</th>
                        <th>Gender</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($group_members as $farmer)
                    <tr>
                        <td>



                            <div class="row">
                                <div class="thumbnail col-md-3" style="float:left;">
                                    <a href="{{url('/')}}/farmer/{{$farmer->id}}">
                                        <img src="/images/no_photo.png" alt="" class="img-circle img-size-32 mr-2">
                                    </a>
                                </div>
                                <div>
                                    <a href="{{url('/')}}/farmer/{{$farmer->id}}">
                                        <b>{{$farmer->first_name}} {{$farmer->last_name}}</b>
                                    </a><br />

                                    @if(empty($group_leader))
                                    <a href="/group_member/make_leader/{{$group->id}}/{{$farmer->id}}"
                                        onClick="return confirm('Make Group Leader?');" style="font-size: 13px"><i
                                            class="fas fa-fw fa-crown"> </i> Make Group
                                        Leader</a>
                                    @else
                                    @if($farmer->group_leader==1)
                                    <span style="font-size: 13px"><i class="fas fa-fw fa-crown "> </i> Group
                                        Leader</span> &nbsp;&nbsp; <a
                                        href="{{url('/')}}/group_member/remove_group_leader/{{$farmer->group_member_id}}"
                                        onClick="return confirm('Remove as Group Leader?');" class="text-danger"><b><i
                                                class="fas fa-fw fa-window-close"></i></b></a>
                                    @endif

                                    @endif
                                </div>
                            </div>
                            </a>
                        <td>{{$farmer->phone1}}</td>
                        <td>{{$farmer->id_passport}}</td>
                        <td><span class=" badge badge-success">{{$farmer->id}}</span></td>
                        <td>{{$farmer->county_name}}</td>
                        <td>{{$farmer->sub_county_name}}</td>
                        <td>{{$farmer->gender_name}}</td>
                        <td>

                            {!!
                            Form::open(['action'=>['GroupMemberController@destroy',$farmer->group_member_id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                            !!}

                            <a href="{{url('/')}}/farmer/{{$farmer->id}}" title="View Details" target="_blank"
                                class="btn btn-xs btn-success"><strong> <i class="fas fa-search"></i></strong> </a>
                            &nbsp;&nbsp;

                            {{Form::hidden('_method','DELETE')}}

                            <button type="submit" class="btn btn-secondary btn-xs btn-flat"
                                onClick="return confirm('Are you sure you want to remove the member from the Group?');">
                                <strong>
                                    <strong> <i class="fas fa-trash"></i></strong></button>

                            {!! Form::close() !!}

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>


</div>

@include('modals/groups/modal_add_group_members')

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


         $(".example1").DataTable({
            // "responsive": false,
            "autoWidth": false,
             "ordering": false,
            "responsive": true,
        });

        $(document).on("click", ".add_farmer", function(e){
             let farmer_id=$(this).data('farmer_id');
             let group_id=$(this).data('group_id');
             
            $(this).html('<b><i class="fa fa-fw fa-spinner fa-pulse"></i> ADD</b>');
            $(this).prop('disabled', true);

            $.ajax({
                type:'GET',
                url:'/group_member/add_farmer_to_group',
				data:{
                    'group_id':group_id,
                    'farmer_id':farmer_id
                },
                success:function(data){
                   if(data==2){ alert('Member already added');}
                   $('.add_farmer_action_'+farmer_id).addClass('disabled');
                   $('.add_farmer_action_'+farmer_id).html('<b><i class="fa fa-fw fa-check"></i> ADDED</b>');

                },
                error:function(e){}
            });
            e.preventDefault();
        })

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