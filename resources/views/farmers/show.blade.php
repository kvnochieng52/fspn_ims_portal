@extends('adminlte::page')

@section('title', 'Farmer Details')

@section('content')
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Farmer Details</h3>
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-3">
                <div style="border: 1px solid #ccc">
                    <img src="/images/no_photo.png" style="width: 100%">

                    <div style="padding: 10px">
                        <h3 class="profile-username text-center">{{$farmer->first_name}} {{$farmer->last_name}}
                        </h3>

                        <div class="progress" style="height:10px">
                            <div class="progress-bar {{$progress ==100 ? 'bg-success' : 'bg-danger'}} progress-sm"
                                role="progressbar" style="width: {{$progress}}%" aria-valuenow="{{$progress}}"
                                aria-valuemin="0" aria-valuemax="{{$progress}}">
                            </div>

                        </div>

                        <p style="font-size: 12px" class="{{$progress ==100 ? 'text-green' : 'text-red'}}">
                            {{$progress}}% Completed</p>

                        <ul class="list-group list-group-unbordered mb-3">
                            <li class="list-group-item">
                                <b>Account No: </b>

                                <a href="#" class="float-right">
                                    <span class=" badge badge-success">{{$farmer->id}}</span>
                                </a>

                            </li>
                            <li class="list-group-item">
                                <b>ID/Passport No:</b> <a class="float-right">{{$farmer->id_passport}}</a>
                            </li>


                            <li class="list-group-item">
                                <b>Created By :</b> <a class="float-right">{{$farmer->created_by}}</a>
                            </li>

                            <li class="list-group-item">
                                <b>Production Type :</b> <a class="float-right">
                                    {{implode(', ', $farmer_produce_types)}}</a>
                            </li>


                        </ul>
                    </div>
                </div>

            </div>


            <div class="col-md-9">



                <div class="card card-success card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="custom-tabs-four-basic-tab" data-toggle="pill"
                                    href="#custom-tabs-four-basic" role="tab" aria-controls="custom-tabs-four-basic"
                                    aria-selected="true"><b>BASIC & PRODUCTION DETAILS</b></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-farm-inputs-tab" data-toggle="pill"
                                    href="#custom-tabs-four-farm-inputs" role="tab"
                                    aria-controls="custom-tabs-four-farm-inputs" aria-selected="false"><b>DOCUMENTS &
                                        FILES
                                    </b></a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link" id="custom-tabs-four-ex-servives-tab" data-toggle="pill"
                                    href="#custom-tabs-four-ex-servives" role="tab"
                                    aria-controls="custom-tabs-four-ex-servives" aria-selected="false"><b>EXT.
                                        SERVICES & FARM INPUTS
                                    </b></a>
                            </li>


                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content" id="custom-tabs-four-tabContent">
                            <div class="tab-pane fade show active" id="custom-tabs-four-basic" role="tabpanel"
                                aria-labelledby="custom-tabs-four-basic-tab">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <tbody>

                                            <tr>
                                                <th style="width: 25%">Full Names</th>
                                                <th style="width: 25%">ID/Passport No</th>
                                                <th style="width: 25%">Telephone</th>
                                                <th style="width: 25%">Alternate Phone</th>
                                            </tr>

                                            <tr>
                                                <td>{{$farmer->first_name}} {{$farmer->last_name}}</td>
                                                <td>{{$farmer->id_passport}}</td>
                                                <td>{{$farmer->phone1}}</td>
                                                <td>{{$farmer->phone2}}</td>
                                            </tr>

                                            <tr>
                                                <th>Email Address</th>
                                                <th>Gender</th>
                                                <th>Age Group</th>
                                                <th>Total Land Size</th>
                                            </tr>

                                            <tr>
                                                <td>{{$farmer->email}}</td>
                                                <td>{{$farmer->gender_name}}</td>
                                                <td>{{$farmer->age_group_name}}</td>
                                                <td>{{$farmer->land_size}} Acres</td>
                                            </tr>

                                            <tr>
                                                <th>Country</th>
                                                <th>County/Town</th>
                                                <th>Sub County</th>
                                                <th>Physical Address</th>
                                            </tr>

                                            <tr>
                                                <td>{{$farmer->country_name}}</td>
                                                <td>{{$farmer->county_name}}</td>
                                                <td>{{$farmer->sub_county_name}}</td>
                                                <td>{{$farmer->address}}</td>
                                            </tr>

                                            <tr>
                                                <th colspan="4">Consent Form</th>
                                            </tr>


                                            <tr>


                                                <td colspan="4"><a href="/{{$farmer->consent_form_upload}}"
                                                        target="_blank"><b><i class="fas fa-download"></i>
                                                            Download</b></a></td>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>

                                    <h5>Farmer Production</h5>
                                    <table class="table table-striped table-bordered records" style="width: 100%">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Production</th>
                                                <th>Capacity</th>
                                                <th>Production Area</th>
                                                <th>Description</th>


                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach($farmer_produces as $key=>$farmer_produce)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>
                                                    <div class="row d-flex d-block">
                                                        <div class="col-md-2"><img
                                                                src="/{{$farmer_produce->placeholder_image}}" alt=""
                                                                class="img-circle img-size-50 mr-2">
                                                        </div>
                                                        <div class="col-md-10" style="padding-left: 20px">
                                                            <a href="#"> <strong>
                                                                    {{$farmer_produce->produce_name}}</strong></a><br />
                                                            <i>{{$farmer_produce->produce_sub_type_name}}</i>
                                                        </div>
                                                    </div>

                                                </td>

                                                <td>{{$farmer_produce->capacity}} {{$farmer_produce->unit_name}}</td>
                                                <td>{{$farmer_produce->production_area}} Acres</td>
                                                <td>{{$farmer_produce->description}}</td>



                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>

                                </div>
                            </div>

                            <div class="tab-pane fade" id="custom-tabs-four-farm-inputs" role="tabpanel"
                                aria-labelledby="custom-tabs-four-farm-inputs-tab">
                                <table class="table table-striped table-bordered records" style="width: 100%">
                                    <thead>
                                        <tr>

                                            <th>Document</th>
                                            <th>Serial No</th>
                                            <th>Description</th>
                                            <th>Download</th>

                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($farmer_documents as $key=>$farmer_document)
                                        <tr>

                                            <td><i
                                                    class="fas fa-fw fa-file "></i>{{$farmer_document->document_type_name}}
                                            </td>
                                            <td>{{$farmer_document->serial_no}}</td>
                                            <td>{{$farmer_document->description}}</td>
                                            <td><a href="/{{$farmer_document->document_upload}}" target="_blank"><b><i
                                                            class="fas fa-fw fa-download "></i>
                                                        Download</b></a></td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>


                            <div class="tab-pane fade" id="custom-tabs-four-ex-servives" role="tabpanel"
                                aria-labelledby="custom-tabs-four-ex-servives-tab">

                                <h5>Extension Services</h5>
                                <table class="table table-striped table-bordered records info-table"
                                    style="width: 100%">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Service Name</th>
                                            <th>Description</th>
                                            <th>Date</th>


                                        </tr>
                                    </thead>

                                    <tbody>

                                        @foreach($farmer_services as $key=>$service)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$service->service_name}}</td>
                                            <td>{{$service->description}}</td>
                                            <td>{{$service->created_at}}</td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <h5>Farm Inputs</h5>

                                <table class="table table-bordered table-striped info-table" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th style="width: 5%">#</th>
                                            <th>Input Name</th>
                                            <th>Sub Input</th>
                                            <th>Quantity</th>
                                            <th>Specification</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($farmer_inputs as $key=>$input_item)
                                        <tr>
                                            <td>{{$key+1}}</td>
                                            <td>{{$input_item->input_name}}</td>
                                            <td>{{$input_item->sub_input_name}}</td>
                                            <td>{{$input_item->quantity}} {{$input_item->unit_name}}</td>
                                            <td>{{$input_item->description}}</td>


                                        </tr>

                                        @endforeach

                                    </tbody>

                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">

<style>
    .table th,
    .table td {
        padding: 5px;
    }
</style>
@stop

@section('js')
<script>

</script>
@stop