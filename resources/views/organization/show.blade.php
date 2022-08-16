@extends('adminlte::page')

@section('title', 'Organization Details')

@section('content')
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Organization Details</h3>
        {{-- <a href="" target="_blank" class="btn btn-default btn-sm" style="float: right">
            <i class="fas fa-file-pdf"></i> DOWNLOAD PDF</a> --}}
    </div>

    <div class="card-body">
        <div class="row">
            <div class="col-md-2" style="background-color: #f3f3f3;padding: 10px">

                <img src="{{empty($organization->logo)?'/images/no-logo.png':'/'.$organization->logo}}"
                    style="width: 100%" class="img-thumbnail rounded">

                <div class="card" style="margin-top: 15px">
                    <div class="card-header">
                        <b> Focus Groups</b>
                    </div>
                    <ul class="list-group list-group-flush">
                        @foreach ($selected_focus_areas as $selected_focus_area)
                        <li class="list-group-item">- {{$selected_focus_area}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="col-md-10">


                <div class="table-responsive">
                    <table id="example1" class="table table-bordered table-striped display nowrap">
                        <tbody>


                            <tr>

                                <td><b>Organization Name</b></td>
                                <td><b>Registration No.</b></td>
                                <td><b>Telephone</b></td>
                                <td><b>Email</b></td>
                            </tr>

                            <tr>
                                <td>{{$organization->organization_name}}</td>
                                <td>{{$organization->registration_no}}</td>
                                <td>{{$organization->telephone}}</td>
                                <td>{{$organization->email}}</td>

                            </tr>

                            <tr>
                                <td><b>Country</b></td>
                                <td><b>Town/County</b></td>
                                <td><b>Sub County</b></td>
                                <td><b>Address</b></td>
                            </tr>

                            <tr>
                                <td>{{$organization->country_name}}</td>
                                <td>{{$organization->county_name}}</td>
                                <td>{{$organization->sub_county_name}}</td>
                                <td>{{$organization->address}}</td>

                            </tr>

                            <tr>
                                <td><b>Website</b></td>
                                <td><b>Contact Person Name</b></td>
                                <td><b>Contact Person Email</b></td>
                                <td><b>Contact Person Telephone</b></td>
                            </tr>

                            <tr>
                                <td>{{$organization->website}}</td>
                                <td>{{$organization->contact_person_name}}</td>
                                <td>{{$organization->contact_person_email}}</td>
                                <td>{{$organization->contact_person_telephone}}</td>

                            </tr>
                        </tbody>
                    </table>

                </div>
                <h5>Specialization & Categories</h5>

                @foreach ($selected_categories as $selected_category)
                <span class=" badge badge-success">{{$selected_category}}</span> &nbsp;
                @endforeach

                <hr />

                <h5>Sustainable Development Goals</h5>

                @foreach ($selected_sdgs as $selected_sdg)
                <span class=" badge badge-success">{{$selected_sdg}}</span> &nbsp;
                @endforeach

                <hr />

                <h5>Documents</h5>
                <table class="table table-striped table-bordered records" style="width: 100%">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Document</th>
                            <th>Serial No</th>
                            <th>Description</th>
                            <th>Download</th>


                        </tr>
                    </thead>
                    @foreach($organization_documents as $key=>$organization_document)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td><b><i class="fas fa-fw fa-file "></i> {{$organization_document->document_type_name}}</b>
                        </td>
                        <td>{{$organization_document->serial_no}}</td>
                        <td>{{$organization_document->description}}</td>
                        <td><a href="/{{$organization_document->document_upload}}" target="_blank"><b><i
                                        class="fas fa-fw fa-download "></i>
                                    Download</b></a></td>

                    </tr>
                    @endforeach

                    <tbody>
                    </tbody>
                </table>
                <hr />
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