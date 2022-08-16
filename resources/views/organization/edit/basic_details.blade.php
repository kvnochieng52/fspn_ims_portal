{!!
Form::open(['action'=>['OrganizationController@update',$organization->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">

    <div class="card-header">
        <h3 class="card-title">Edit Organization</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div>

    <div class="card-body">
        <div class="row">

            <div class="col-md-5">
                <div class="row">

                    <div class="col-md-12">
                        {{Form::label('organization_name', 'Organization Name* ')}}
                        <div class="form-group">
                            {{Form::text('organization_name', $organization->organization_name,['class'=>'form-control',
                            'placeholder'=>'Enter the organization Name','required'=>'required'])}}
                        </div>
                    </div>

                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('telephone', 'Telephone* ')}}
                        <div class="form-group">
                            {{Form::text('telephone', $organization->telephone,['class'=>'form-control', 'placeholder'=>'Enter Telephone No.','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('email', 'Email Address* ')}}
                        <div class="form-group">
                            {{Form::email('email', $organization->email,['class'=>'form-control', 'placeholder'=>'Email Address','required'=>'required'])}}
                        </div>
                    </div>
                </div>





                <div class="row">
                    <div class="col-md-6">
                        {{Form::label('country', 'Country* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('country', $countries,$organization->country, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('county', 'Town/County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('county', $counties,$organization->county, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>


                </div>


                <div class="row">

                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-12">
                                {{Form::label('sub_county', 'Sub County* ',['class'=>'control-label'])}}
                                <div class="form-group">
                                    {{ Form::select('sub_county', [$organization->sub_county=>$organization->sub_county_name],$organization->sub_county, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('address', 'Address* ')}}
                                <div class="form-group">
                                    {{Form::textarea('address', $organization->address,['class'=>'form-control', 'placeholder'=>'Enter the farmers address','style'=>'height:120px','required'=>'required'])}}
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="col-md-6">
                        <div class="row">

                            <div class="col-md-12">
                                {{Form::label('contact_person_name', 'Contact Person Name* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_name', $organization->contact_person_name,['class'=>'form-control', 'placeholder'=>'Contact Person Name.','required'=>'required'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('contact_person_email', 'Contact Person Email* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_email', $organization->contact_person_email,['class'=>'form-control', 'placeholder'=>'Contact Person Email.','required'=>'required'])}}
                                </div>
                            </div>

                            <div class="col-md-12">
                                {{Form::label('contact_person_telephone', 'Contact Person Telephone* ')}}
                                <div class="form-group">
                                    {{Form::text('contact_person_telephone', $organization->contact_person_telephone,['class'=>'form-control', 'placeholder'=>'Contact Person Telephone.','required'=>'required'])}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>




            </div>

            <div class="col-md-5 offset-1">

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('registration_no', 'Registration No.')}}
                        <div class="form-group">
                            {{Form::text('registration_no', $organization->registration_no,['class'=>'form-control', 'placeholder'=>'Registration No'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('date_of_registration', 'Date Of Registration ')}}
                        <div class="form-group">
                            {{Form::text('date_of_registration', \Carbon\Carbon::parse($organization->date_of_registration)->format('d-m-Y'),['class'=>'form-control dob', 'placeholder'=>'Date of Registration','autocomplete'=>'off'])}}
                        </div>
                    </div>
                </div>

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('website', 'Website')}}
                        <div class="form-group">
                            {{Form::text('website', $organization->website,['class'=>'form-control', 'placeholder'=>'Enter the website'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputFile">Upload Organization Logo</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input logo_upload" id="logo_upload"
                                        name="logo_upload">
                                    <label class="custom-file-label" for="logo_upload"> Select the Logo
                                    </label>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('specialization[]', 'Specialization/Category* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('specialization[]', $categories,$selected_categories, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        {{Form::label('focus_areas[]', 'Focus Areas* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('focus_areas[]', $focus_areas,$selected_focus_areas, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
                    </div>

                    <div class="col-md-12">
                        {{Form::label('sdgs[]', 'Sustainable Development Goals* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sdgs[]', $sdgs,$selected_sdgs, ['style'=>'width:100%','class' => 'select2 form-control','required'=>'required','multiple'=>'multiple']) }}
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

    <div class="card-footer">
        <div class="row">

            <div class="col-md-12">
                <button type="submit" class="btn btn-success"><strong> UPDATE DETAILS</strong></button>
            </div>
        </div>
    </div>
</div>

{{Form::hidden('_method','PUT')}}
{!! Form::close() !!}