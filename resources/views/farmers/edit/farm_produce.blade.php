<div class="card">

    <div class="card-header">
        <h3 class="card-title">Production Details</h3>
        <p style="float: right; margin-bottom:0px"><a href="new_farm_produce" data-toggle="modal"
                data-target="#new_farm_produce" style="float: right" data-backdrop="static" data-keyboard="false"
                class="btn btn-success btn-xs"><b><i class="fas fa-fw fa-plus "></i>NEW
                    PRODUCE</b></a> </p>
    </div>

    <div class="card-body">


        <table class="table table-striped table-bordered records" style="width: 100%">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produces</th>
                    <th>Capacity</th>
                    <th>Production Area</th>
                    <th>Description</th>
                    <th></th>

                </tr>
            </thead>

            <tbody>
                @foreach($farmer_produces as $key=>$farmer_produce)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>
                        <div class="row d-flex d-block">
                            <div class="col-md-2"><img src="/{{$farmer_produce->placeholder_image}}" alt="Product 1"
                                    class="img-circle img-size-50 mr-2"></div>
                            <div class="col-md-10" style="padding-left: 20px">
                                <a href="#"> <strong> {{$farmer_produce->produce_name}}</strong></a><br />
                                <i>{{$farmer_produce->produce_sub_type_name}}</i>
                            </div>
                        </div>

                    </td>

                    <td>{{$farmer_produce->capacity}} {{$farmer_produce->unit_name}}</td>
                    <td>{{$farmer_produce->production_area}} Acres</td>
                    <td>{{$farmer_produce->description}}</td>

                    <td>
                        {!!
                        Form::open(['action'=>['FarmerProduceController@destroy',$farmer_produce->id],'method'=>'POST','class'=>'floatit','enctype'=>'multipart/form-data'])
                        !!}
                        {{Form::hidden('_method','DELETE')}}

                        <button type="submit" class="btn btn-secondary btn-xs btn-flat"
                            onClick="return confirm('Are you sure you want to delete this User?');"> <strong>
                                <strong> <i class="fas fa-trash"></i></strong></button>

                        {!! Form::close() !!}

                    </td>

                </tr>
                @endforeach
            </tbody>

        </table>
    </div>

</div>

@include('modals.farm_produce.modal_add_farm_produce')