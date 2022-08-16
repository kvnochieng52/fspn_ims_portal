@extends('adminlte::page')

@section('title', 'Edit Organization')

@section('content')

@include('notices')

<div class="card card-success card-outline card-outline-tabs ">
    <div class="card-header p-0 border-bottom-0">
        <ul class="nav nav-tabs" id="custom-tabs-four-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="custom-tabs-four-basic_details-tab" data-toggle="pill"
                    href="#custom-tabs-four-basic_details" role="tab" aria-controls="custom-tabs-four-basic_details"
                    aria-selected="true"><b>BASIC DETAILS</b></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="custom-tabs-four-documents-tab" data-toggle="pill"
                    href="#custom-tabs-four-documents" role="tab" aria-controls="custom-tabs-four-documents"
                    aria-selected="false"><b>DOCUMENTS UPLOAD</b></a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content" id="custom-tabs-four-tabContent">
            <div class="tab-pane fade active show" id="custom-tabs-four-basic_details" role="tabpanel"
                aria-labelledby="custom-tabs-four-basic_details-tab">
                @include('organization.edit.basic_details')
            </div>

            <div class="tab-pane fade" id="custom-tabs-four-documents" role="tabpanel"
                aria-labelledby="custom-tabs-four-documents-tab">
                @include('organization.edit.documents')
            </div>

        </div>
    </div>
    <!-- /.card -->
</div>







@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
<link rel="stylesheet" href="/css/validator/bootstrapValidator.min.css" />
@stop

@section('js')
<script src="/js/validator/bootstrapValidator.min.js"></script>
<script type="text/javascript" src="/vendor/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<script>
    $(document).ready(function () {
        bsCustomFileInput.init();
        $('.select2').select2()
        $('.dob').datepicker({
            autoclose: true,
            format: 'dd-mm-yyyy'
        });

        
        $('#county').change(function(){  
			$.ajax({
                type:'GET',
                url:'/sub_county/sub_counties_with_county_id',
				data:{'county':$(this).val()},
                success:function(data){
					var $dropdown = $("#sub_county");
					$($dropdown)[0].options.length = 0;
					$dropdown.append($("<option />").text('--Select Sub Location--'));

					$.each(data, function(index, element) {
						$dropdown.append($("<option />").val(element.id).text(element.sub_county_name));
					});

                },
                error:function(e){}
            });
        });


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