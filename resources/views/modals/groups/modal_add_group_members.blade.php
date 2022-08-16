<div class="modal fade" id="modal-add-group-members">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            {!!
            Form::open(['action'=>'GroupMemberController@store','method'=>'POST','class'=>'form user_form',
            'enctype'=>'multipart/form-data'])
            !!}
            <div class="modal-header">
                <h4 class="modal-title">Add Members</h4>
                {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button> --}}
            </div>
            <div class="modal-body">
                <div class="table-responsive">
                    <table id="" class="table table-bordered table-striped display nowrap example1">
                        <thead>
                            <tr>
                                <th>Full Names</th>
                                <th>Telephone</th>
                                <th>ID Number</th>
                                <th>Account No.</th>
                                <th>Town/County</th>
                                <th>Sub County</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($farmers as $farmer)
                            <tr>
                                <td><a href=""><b><i class="fas fa-user"></i> {{$farmer->first_name}}
                                            {{$farmer->last_name}}</b></a></td>
                                <td>{{$farmer->phone1}}</td>
                                <td>{{$farmer->id_passport}}</td>
                                <td>{{$farmer->id}}</td>
                                <td>{{$farmer->county_name}}</td>
                                <td>{{$farmer->sub_county_name}}</td>
                                <td>
                                    <button data-group_id="{{$group->id}}" data-farmer_id="{{$farmer->id}}"
                                        class="btn btn-block btn-outline-success btn-sm add_farmer add_farmer_action_{{$farmer->id}}"
                                        @if(in_array($farmer->id,$group_members_array))
                                        disabled
                                        @endif >

                                        @if(in_array($farmer->id,$group_members_array)) <b><i class="fas fa-check"></i>
                                            ADDED</b>
                                        @else
                                        <b><i class="fas fa-plus"></i> ADD</b>
                                        @endif
                                    </button>

                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


            </div>
            <div class="modal-footer justify-content-between">

                <div style="text-align: right"><a href="" class="btn btn-default"><b>CLOSE</b></a></div>
                {{-- <button type="submit" class="btn btn-primary"><b>ADD MEMBERS</b></button> --}}
            </div>

            <input type="hidden" name="group_id" value="{{$group->id}}">

            {!! Form::close() !!}
        </div>
        <!-- /.modal-content -->
    </div>
</div>