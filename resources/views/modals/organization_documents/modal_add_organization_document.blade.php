<div class="modal fade" id="add_organization_document">

    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {!!
            Form::open(['action'=>'OrganizationDocumentsController@store','method'=>'POST','class'=>'form
            user_form',
            'enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <h4 class="modal-title">New Documents</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-4">
                        {{Form::label('document', 'Select document Type* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('document', $organization_document_types,null, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>

                    </div>

                    <div class="col-md-4">
                        {{Form::label('serial_no', 'Serial No.',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{Form::text('serial_no', null,['class'=>'form-control', 'placeholder'=>'Enter document serial No','autocomplete'=>'off'])}}
                        </div>

                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Document File*</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input upload_document" id="upload_document"
                                        name="upload_document" required>
                                    <label class="custom-file-label" for="upload_document"> Select the Document
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">

                        {{Form::label('description', 'Description',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{Form::textarea('description', null,['style'=>'height:100px','class'=>'form-control', 'placeholder'=>'Enter any additional Info','autocomplete'=>'off'])}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="submit" class="btn btn-success"><b>SUBMIT DETAILS</b></button>
                <input type="hidden" name="organization_id" value="{{$organization->id}}">
            </div>

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>

    <!-- /.modal-dialog -->
</div>