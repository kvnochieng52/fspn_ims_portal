@extends('adminlte::page')
@section('title', 'Dashboard')

{{-- @section('content_header')
<h1>Dashboard</h1>
@stop --}}

@section('content')
<div class="row">

    <div class="col-md-3 col-sm-6 col-xs-12">


        <div class="info-box">


            <span class="info-box-icon bg-green"><i class="fa fa-users"></i></span>
            <div class="info-box-content">
                <span class="info-box-text">Farmers Registered</span>


                <span class="info-box-number">{{$farmers_count}}</span>



                <br>
                <span class="progress-description">
                    <a href="/farmer"> Details</a>
                </span>
            </div>

            <!-- /.info-box-content -->
        </div>

        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-file-invoice"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Farmer Groups </span>
                <span class="info-box-number">{{$group_count}}</span>
                <span class="info-box-text" style="padding-top:15px"><a href="/group">Details</a></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->

    <!-- fix for small devices only -->
    <div class="clearfix visible-sm-block"></div>

    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-leaf"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Farm Inputs Requests</span>
                <span class="info-box-number">{{$farmer_input_count}}</span>
                <span class="info-box-text" style="padding-top:15px"><a href="/farmer_input">Details</a></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
    <div class="col-md-3 col-sm-6 col-xs-12">
        <div class="info-box">
            <span class="info-box-icon bg-green"><i class="fa fa-sitemap"></i></span>

            <div class="info-box-content">
                <span class="info-box-text">Regsitered Organizations</span>
                <span class="info-box-number">{{$org_count}}</span>
                <span class="info-box-text" style="padding-top:15px"><a href="/organization">Details</a></span>
            </div>
            <!-- /.info-box-content -->
        </div>
        <!-- /.info-box -->
    </div>
    <!-- /.col -->
</div>
<div style="clear: both"></div>


<div class="row">

    <div class="col-md-7">
        <div class="card">
            <div class="card-header border-transparent">
                <h3 class="card-title">Latest Registred Farmers</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>

                </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body p-0">
                <div class="table-responsive">

                    <table id="example1" class="table table-bordered table-striped table m-0">
                        <thead>
                            <tr>

                                <th>Full Names</th>
                                <th>Telephone</th>
                                <th>County</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($latest_farmers as $farmer)
                            <tr>

                                <td><img src="/images/no_photo.png" alt="" class="img-circle img-size-32 mr-2">
                                    <a href="{{url('/')}}/farmer/{{$farmer->id}}"> <strong> {{$farmer->first_name}}
                                            {{$farmer->last_name}}</strong></a>
                                </td>
                                <td>{{$farmer->phone1}}</td>

                                <td><span class="badge badge-default">{{$farmer->county_name}}</span></td>
                                <td>
                                    <a href="{{url('/')}}/farmer/{{$farmer->id}}" title="View Details"
                                        class="btn btn-xs btn-default"><strong> <i class="fas fa-search"></i></strong>
                                    </a>

                                </td>
                            </tr>

                            @endforeach


                        </tbody>
                    </table>

                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.card-body -->

            <!-- /.card-footer -->
            <br />
        </div>
    </div>

    <div class="col-md-5">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Farm Inputs Stats</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>

                </div>
            </div>
            <div class="card-body">
                <canvas id="donutChart"
                    style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
            </div>
            <!-- /.card-body -->
        </div>
    </div>
</div>


<div class="card">
    <div class="card-header">
        <h3 class="card-title">Farmers By regions</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
            </button>

        </div>
    </div>
    <div class="card-body">
        <div class="chart">
            <canvas id="areaChart"
                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
        </div>
    </div>
    <!-- /.card-body -->
</div>


@stop

@section('css')
<link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

<script>
    $(function () {
        
            /* ChartJS
             * -------
             * Here we will create a few charts using ChartJS
             */

            //--------------
            //- AREA CHART -
            //--------------

            // Get context with jQuery - using jQuery's .get() method.
            var areaChartCanvas = $('#areaChart').get(0).getContext('2d')

            var areaChartData = {
                labels: <?php echo $region_names ?>,
                datasets: [
                    {
                        label: 'No. of Registered Farmers by the Region',
                        backgroundColor: 'rgba(30,151,58,1)',
                        borderColor: 'rgba(30,151,58,0.8)',
                        pointRadius: true,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(30,151,58,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(30,151,58,1)',
                        data: <?php echo $region_count ?>
                    },
                    {
                        label: '-',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: [0, 0, 0, 0,0, 0, 0]
                    },
                ]
            }

            var areaChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position:'bottom'
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: true,
                        }
                    }],
                    
                }
            }

            // This will get the first returned node in the jQuery collection.
            var areaChart = new Chart(areaChartCanvas, {
                type: 'line',
                data: areaChartData,
                options: areaChartOptions
            })

            //-------------
            //- LINE CHART -
            //--------------
          //  var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
            var lineChartOptions = jQuery.extend(true, {}, areaChartOptions)
            var lineChartData = jQuery.extend(true, {}, areaChartData)
            lineChartData.datasets[0].fill = false;
            lineChartData.datasets[1].fill = false;
            lineChartOptions.datasetFill = false

            // var lineChart = new Chart(lineChartCanvas, {
            //     type: 'line',
            //     data: lineChartData,
            //     options: lineChartOptions
            // })

            // //-------------
            //- DONUT CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
            var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
            var donutData = {
                labels: [
                    'Pending Farm Inputs Requests',
                    'Closed Farm Inputs Requests',
                    
                    
                ],
                datasets: [
                    {
                        data: [{{$completed_farm_inputs}},{{$pending_farm_inputs}}],
                        backgroundColor: ['#dbdbdb', '#00a65a'],
                    }
                ]
            }
            var donutOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true,
                    position:'bottom'
                }
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            var donutChart = new Chart(donutChartCanvas, {
                type: 'doughnut',
                data: donutData,
                options: donutOptions
            })

            //-------------
            //- PIE CHART -
            //-------------
            // Get context with jQuery - using jQuery's .get() method.
           // var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
            var pieData = donutData;
            var pieOptions = {
                maintainAspectRatio: false,
                responsive: true,
            }
            //Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // var pieChart = new Chart(pieChartCanvas, {
            //     type: 'pie',
            //     data: pieData,
            //     options: pieOptions
            // })

            //-------------
            //- BAR CHART -
            //-------------
         //   var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = jQuery.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                datasetFill: false
            }

            // var barChart = new Chart(barChartCanvas, {
            //     type: 'bar',
            //     data: barChartData,
            //     options: barChartOptions
            // })

            //---------------------
            //- STACKED BAR CHART -
            //---------------------
         //   var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
            var stackedBarChartData = jQuery.extend(true, {}, barChartData)

            var stackedBarChartOptions = {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    xAxes: [{
                        stacked: true,
                    }],
                    yAxes: [{
                        stacked: true
                    }]
                }
            }

            // var stackedBarChart = new Chart(stackedBarChartCanvas, {
            //     type: 'bar',
            //     data: stackedBarChartData,
            //     options: stackedBarChartOptions
            // })
        })
</script>
@stop