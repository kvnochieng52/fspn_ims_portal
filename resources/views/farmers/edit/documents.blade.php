<div class="card">

    <div class="card-header">
        <h3 class="card-title">Documents</h3>
        <p style="float: right; margin-bottom:0px"><a href="add_farmer_document" data-toggle="modal"
                data-target="#add_farmer_document" style="float: right" data-backdrop="static" data-keyboard="false"
                class="btn btn-success btn-xs"><b><i class="fas fa-fw fa-plus "></i>NEW
                    DOCUMENT</b></a> </p>
    </div>

    <div class="card-body">


        <table class="table table-striped table-bordered records info-table" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Document</th>
                    <th>Serial No</th>
                    <th>Description</th>
                    <th>Download</th>

                </tr>
            </thead>

            <tbody>

                @foreach($farmer_documents as $key=>$farmer_document)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$farmer_document->document_type_name}}</td>
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
</div>

<div class="card">

    <div class="card-header">
        <h3 class="card-title">Extension Services</h3>
        <p style="float: right; margin-bottom:0px"><a href="new_ext_service" data-toggle="modal"
                data-target="#new_ext_service" style="float: right" data-backdrop="static" data-keyboard="false"
                class="btn btn-success btn-xs"><b><i class="fas fa-fw fa-plus "></i>NEW
                    SERVICE</b></a>
        </p>
    </div>

    <div class="card-body">




        <table class="table table-striped table-bordered records info-table" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Service Name</th>
                    <th>Description</th>
                    <th>Date</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>

                @foreach($farmer_services as $key=>$service)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$service->service_name}}</td>
                    <td>{{$service->description}}</td>
                    <td>{{$service->created_at}}</td>
                    <td><a onclick="return confirm('Are you sure you want to delete this Service?');"
                            href="/farmerservicedelete/{{$service->id}}"><b><i class="fas fa-trash"></i></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>


<div class="card">

    <div class="card-header">
        <h3 class="card-title">Farm Inputs</h3>
        <p style="float: right; margin-bottom:0px"><a href="new_farm_input" data-toggle="modal"
                data-target="#new_farm_input" style="float: right" data-backdrop="static" data-keyboard="false"
                class="btn btn-success btn-xs"><b><i class="fas fa-fw fa-plus "></i>NEW
                    FARM INPUT</b></a>
        </p>
    </div>

    <div class="card-body">
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
                @foreach($farmer_inputs as $key=>$input_item)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$input_item->input_name}}</td>
                    <td>{{$input_item->sub_input_name}}</td>
                    <td>{{$input_item->quantity}} {{$input_item->unit_name}}</td>
                    <td>{{$input_item->description}}</td>
                    <td><a onclick="return confirm('Are you sure you want to delete this item?');"
                            href="/farmerinputdelete/{{$input_item->id}}"><b><i class="fas fa-trash"></i></a></td>

                </tr>

                @endforeach

            </tbody>

        </table>
    </div>
</div>

@include('modals.farmer_documents.modal_add_farmer_document')
@include('modals.extension_service.modal_add_ext_service')
@include('modals.farmer_inputs.modal_add_farm_input')