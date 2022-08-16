<div class="card">

    <div class="card-header">
        <h3 class="card-title">Documents</h3>
        <p style="float: right; margin-bottom:0px"><a href="add_farmer_document" data-toggle="modal"
                data-target="#add_organization_document" style="float: right" data-backdrop="static"
                data-keyboard="false" class="btn btn-success btn-xs"><b><i class="fas fa-fw fa-plus "></i>NEW
                    DOCUMENT</b></a> </p>
    </div>

    <div class="card-body">


        <table class="table table-striped table-bordered records" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Document</th>
                    <th>Serial No</th>
                    <th>Description</th>
                    <th>Download</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>

                @foreach($organization_documents as $key=>$organization_document)
                <tr>
                    <td>{{$key+1}}</td>
                    <td><b><i class="fas fa-fw fa-file "></i> {{$organization_document->document_type_name}}</b></td>
                    <td>{{$organization_document->serial_no}}</td>
                    <td>{{$organization_document->description}}</td>
                    <td><a href="/{{$organization_document->document_upload}}" target="_blank"><b><i
                                    class="fas fa-fw fa-download "></i>
                                Download</b></a></td>
                    <td>
                        <a href="/organization_documents/delete/{{$organization_document->id}}" onClick="return
                            confirm('Are you sure you want to delete this Document?');"
                            class="btn btn-secondary btn-xs btn-flat"><strong> <i
                                    class="fas fa-trash"></i></strong></button></a></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@include('modals.organization_documents.modal_add_organization_document')