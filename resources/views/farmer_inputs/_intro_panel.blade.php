<div class="table-responsive">
    <table class="table table-bordered table-striped info-table">
        <tr>
            <td><strong> FullNames</strong></td>
            <td><strong>Account Number</strong></td>
            <td><strong>ID/Passport No.</strong></td>
            <td><strong>Phone</strong></td>
        </tr>

        <tr>
            <td>{{$farmer->first_name}} {{$farmer->last_name}}</td>
            <td><span class=" badge badge-success">{{$farmer->id}}</span></td>
            <td>{{$farmer->id_passport}}</td>
            <td>{{$farmer->phone1}}</td>
        </tr>
        <tr>
            <td><strong>Country</strong></td>
            <td><strong>Town/County</strong></td>
            <td><strong>Sub County</strong></td>
            <td><strong>Physical Address</strong></td>
        </tr>
        <tr>
            <td>{{$farmer->country_name}}</td>
            <td>{{$farmer->county_name}}</td>
            <td>{{$farmer->sub_county_name}}</td>
            <td>{{$farmer->address}}</td>
        </tr>

        <tr>
            <td><strong>Total Land Size</strong></td>
            <td><strong>Consent form</strong></td>
            <td></td>
            <td></td>
        </tr>

        <tr>
            <td>{{$farmer->land_size}} Acres</td>
            <td><a href="/{{$farmer->consent_form_upload}}" target="_blank"><b><i class="fas fa-download"></i>
                        Download</b></a> </td>
            <td></td>
            <td></td>

        </tr>
    </table>
</div>