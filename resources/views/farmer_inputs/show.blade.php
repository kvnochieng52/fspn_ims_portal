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


        <div class="row">

            @include('farmer_inputs._intro_panel')
        </div>

        <div class="row">
            <h5>Farm Input Details</h5>
            <div class="table-responsive">
                <table class="table table-bordered table-striped info-table">
                    <tr>
                        <td><strong> Request Date</strong></td>
                        <td><strong>Comments</strong></td>
                        <td><strong>Status</strong></td>
                    </tr>

                    <tr>
                        <td>{{\Carbon\Carbon::parse($farmerInput->date)->format('d-m-Y')}}</td>
                        <td>{{$farmerInput->description}}</td>
                        <td><span class="badge badge-warning"> PENDING</span></td>
                    </tr>
                </table>
            </div>



        </div>
        <hr />
        <div class="col-md-12">
            <h5>Farm Input Items<a href="new_farm_input" data-toggle="modal" data-target="#new_farm_input"
                    class="btn btn-info btn-xs" style="float: right" data-backdrop="static" data-keyboard="false">
                    <b><i class="fas fa-fw fa-plus "></i> ADD FARM INPUT ITEM</b></a></h5>

            <hr>

            <div class="table-responsive">
                <table class="table table-bordered table-striped info-table" style="width:100%">
                    <thead>
                        <tr>
                            <th style="width: 5%">#</th>
                            <th>Input Name</th>
                            <th>Sub Input</th>
                            <th>Quantity</th>
                            <th>Specification</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($current_farmer_inputs_items as $key=>$input_item)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$input_item->input_name}}</td>
                            <td>{{$input_item->sub_input_name}}</td>
                            <td>{{$input_item->quantity}} {{$input_item->unit_name}}</td>
                            <td>{{$input_item->farm_input_desc}}</td>
                            <td><a href="" title="Edit Details" class="btn btn-xs btn-primary"><strong> <i
                                            class="fas fa-edit"></i></strong> </a></td>

                        </tr>

                        @endforeach

                    </tbody>

                </table>
            </div>
        </div>
    </div>

    @include('modals.farmer_inputs.modal_add_farm_input')


    @stop

    @section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    @stop

    @section('js')
    <script>
        $(document).ready(function () {
             
        $('#input').change(function(){  
			$.ajax({
                type:'GET',
                url:'/farmer_input/get_sub_inputs',
				data:{'input':$(this).val()},
                success:function(data){
					var $dropdown = $("#sub_input");
					$($dropdown)[0].options.length = 0;
					$dropdown.append($("<option />").val('').text('--none--'));

					$.each(data, function(index, element) {
						$dropdown.append($("<option />").val(element.id).text(element.sub_input_name));
					});

                },
                error:function(e){}
            });
        });


        $('.select2').select2()
        $('.dob').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });
    });
    </script>
    @stop