{!!
Form::open(['action'=>['FarmerController@update',$farmer->id],'method'=>'POST','class'=>'form
user_form','enctype'=>'multipart/form-data'])
!!}
<div class="card">

    {{-- <div class="card-header">
        <h3 class="card-title">Basic Details</h3>
        <p style="float: right; margin-bottom:0px">Fields marked * are mandatory </p>
    </div> --}}

    <div class="card-body">

        <div class="row">

            <div class="col-md-5">
                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('first_name', 'First Name* ')}}
                        <div class="form-group">
                            {{Form::text('first_name', $farmer->first_name,['class'=>'form-control', 'placeholder'=>'Enter Farmers First Name','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('last_name', 'Last  Name* ')}}
                        <div class="form-group">
                            {{Form::text('last_name', $farmer->last_name,['class'=>'form-control', 'placeholder'=>'Enter Farmers Last Name','required'=>'required'])}}
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('id_passport', 'ID/Passport No')}}
                        <div class="form-group">
                            {{Form::text('id_passport', $farmer->id_passport,['class'=>'form-control', 'placeholder'=>'Enter Farmers ID/Passport No.'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('email', 'Email Address ')}}
                        <div class="form-group">
                            {{Form::email('email', $farmer->email,['class'=>'form-control', 'placeholder'=>'Email Address'])}}
                        </div>
                    </div>
                </div>


                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('phone', 'Phone* ')}}
                        <div class="form-group">
                            {{Form::text('phone', $farmer->phone1,['class'=>'form-control', 'placeholder'=>'Phone','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('phone2', 'Alternate Phone ')}}
                        <div class="form-group">
                            {{Form::text('phone2', $farmer->phone2,['class'=>'form-control', 'placeholder'=>'Alternate Phone'])}}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6">
                        {{Form::label('country', 'Country* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('country', $countries,$farmer->country, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('town', 'Town/County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('town', $counties,$farmer->town, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>


                </div>

                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('sub_county', 'Sub County* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('sub_county', [$farmer->sub_county => $farmer->sub_county_name],$farmer->sub_county, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('address', 'Physical Address*')}}
                        <div class="form-group">
                            {{Form::textarea('address', $farmer->address,['class'=>'form-control', 'placeholder'=>'Enter the farmers address','style'=>'height:70px','required'=>'required'])}}
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-5 offset-1">

                <div class="row">

                    <div class="col-md-6">
                        {{Form::label('gender', 'Gender* ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('gender', $genders,$farmer->gender, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Specify--','required'=>'required']) }}
                        </div>
                    </div>

                    <div class="col-md-6">
                        {{Form::label('age_group', 'Age Group ',['class'=>'control-label'])}}
                        <div class="form-group">
                            {{ Form::select('age_group', $age_group,$farmer->age_group_id, ['style'=>'width:100%','class' => 'select2 form-control','placeholder'=>'--Select Age Group--']) }}
                        </div>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-12">
                        {{Form::label('land_size', 'Land Size in Acre* ')}}
                        <div class="form-group">
                            {{Form::text('land_size', $farmer->land_size,['class'=>'form-control', 'placeholder'=>'Enter the Farmers land size','required'=>'required'])}}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p style="padding: 0px; margin:0px">Type of the Produce</p>
                        @foreach($produce_types as $key=>$produce_type)
                        <label class="radio-inline">
                            <input type="checkbox" name="produce_type[]" value="{{$key}}" required
                                @if(in_array($key,$farmer_produce_types)) checked @endif> {{$produce_type}}
                        </label> &nbsp;&nbsp;
                        @endforeach


                    </div>



                    <div class="col-md-12">
                        {{Form::label('comments', 'Additional Notes(optional)')}}
                        <div class="form-group">
                            {{Form::textarea('comments', $farmer->description,['class'=>'form-control', 'placeholder'=>'Any Addtional Notes or Comments?','style'=>'height:70px'])}}
                        </div>
                    </div>

                    <div class="col-md-12">
                        <p>
                            <label>
                                <input type="checkbox" name="consent_provided" value="1"
                                    @if($farmer->consent_form_provided==1) checked @endif >
                                Farmer has been provided & signed Consent Form*
                            </label>
                        </p>
                        {{-- {{Form::label('consent_upload', 'Upload Consent form')}}
                        <div class="form-group">
                            <input type="file" name="consent_upload" id="consent_upload">
                        </div> --}}
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