<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($hr==0)
{
header("Location:index.php");	
}
include("saveurl.php");
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
  <style>
 #th-abcd{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#1d3a67;
color:white;}
  </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">

  <!-- Navbar -->
<?php 

require 'partials/header.php'; ?> 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require 'partials/sidebar.php'; ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
           
    </section>
    <section class="content">
      <div class="container-fluid">
        
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold>PMIS Mobile Applications</bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" name="search" id="search" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
             
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead align="center" id="th-abcd"> 
                    <tr>
                      <th align="center" id="th-abcd">Project Name</th>
                      <th align="center" id="th-abcd">Country</th>

                      <th align="center" id="th-abcd">Modules</th>
                      <th align="center" id="th-abcd">Android</th>
                      <th align="center" id="th-abcd">iOS</th>
                  
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Haryana Orbital Rail Corporation Project (HORC)</td>
                        <td>India</td>
                        <td>RFI/ESHS/SITE DIARY</td>
                        <td align="center" ><a href="apk/PMIS2_3.apk" download >Download</a></a></td>
                        <td align="center" ><a href="https://apps.apple.com/redeem?code=XEYRJRXA4T6N&ctx=apps" >Link</a></td>
                        
                    </tr>
                    

                      <tr>
                        <td>Irrigation and Drainage Improvement Program (IDIP2)</td>
                        <td>Kazakhstan</td>
                        <td>PMIS DASHBOARD</td>
                        <td align="center" ><a href="apk/idip2.apk" download>Download</a></a>
                        <td align="center"><a  href="https://apps.apple.com/redeem?code=EYN7P6LEFW9X&ctx=apps" >Link</a></td>
                      
                      </tr>
                      <tr>
                        <td>Pakhtunkhwa Hydropower & Renewable Energy Development (PEDO)</td>
                        <td>Pakistan</td>
                        <td >RFI/ESHS/SITE DIARY</td>
                        <td align="center" ><a href="apk/PEDO.apk" download>Download</a></a>
                        <td align="center">NA</td>
                     
                      </tr>
                      
                       
                      
                      
                     
                  </tbody>
                </table>
              </div>
             
              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
      </div>
    </section>

     


    <!-- Main content -->
  
    <!-- /.content -->
  </div>
  
  
  <!-- /.content-wrapper -->

  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../sacadb/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../sacadb/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../sacadb/theme/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../sacadb/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../sacadb/theme/dist/js/demo.js"></script> -->
<!-- Page specific script -->
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
      labels  : ['Total Projects:-<?php echo $projectRes['total_saca_project']; ?>','WIP','Debtors','Lockup','Billings'],
      datasets: [
        {
          label               : 'SACA PROJECT',
          backgroundColor  : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
          borderColor         : 'rgba(60,141,188,0.8)',
          pointRadius         : false,
          pointColor          : '#3b8bba',
          pointStrokeColor    : 'rgba(60,141,188,1)',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(60,141,188,1)',
          data                : [<?php echo $projectRes['total_saca_project']; ?>, <?php echo $wipRes['total_saca_wip']; ?>, <?php echo $debtorsRes['total_saca_debtors']; ?>,<?php echo $lockupRes['total_saca_lockup']; ?> ,<?php echo $billingsRes['total_saca_billings']; ?>
        ]
        },
        {
          label               : '',
          backgroundColor     : 'rgba(210, 214, 222, 1)',
          borderColor         : 'rgba(210, 214, 222, 1)',
          pointRadius         : false,
          pointColor          : 'rgba(210, 214, 222, 1)',
          pointStrokeColor    : '#c1c7d1',
          pointHighlightFill  : '#fff',
          pointHighlightStroke: 'rgba(220,220,220,1)',
          data                : []
        
        },
      ]
    }

    var areaChartOptions = {
      maintainAspectRatio : false,
      responsive : true,
      legend: {
        display: false
      },
      scales: {
        xAxes: [{
          gridLines : {
            display : false,
          }
        }],
        yAxes: [{
          gridLines : {
            display : false,
          }
        }]
      }
    }

    // This will get the first returned node in the jQuery collection.
    new Chart(areaChartCanvas, {
      type: 'line',
      data: areaChartData,
      options: areaChartOptions
    })

    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
    var lineChartOptions = $.extend(true, {}, areaChartOptions)
    var lineChartData = $.extend(true, {}, areaChartData)
    lineChartData.datasets[0].fill = false;
    lineChartData.datasets[1].fill = false;
    lineChartOptions.datasetFill = false

    var lineChart = new Chart(lineChartCanvas, {
      type: 'line',
      data: lineChartData,
      options: lineChartOptions
    })

    //-------------
    //- DONUT CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.

    var donutChartCanvas = $('#donutChart').get(0).getContext('2d')
    var donutData        = {
      labels: [
        'Total Projects',
          'WIP',
          'Debtors',
          'Lockup',
          'Billings',
      ],
      datasets: [
        {
          data: [<?php echo $projectRes['total_saca_project']; ?>, <?php echo $wipRes['total_saca_wip']; ?>, <?php echo $debtorsRes['total_saca_debtors']; ?>,<?php echo $lockupRes['total_saca_lockup']; ?> ,<?php echo $billingsRes['total_saca_billings']; ?>],
          backgroundColor : ['#f56954', '#00a65a', '#f39c12', '#00c0ef', '#3c8dbc', '#d2d6de'],
        }
      ]
    }
    var donutOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(donutChartCanvas, {
      type: 'doughnut',
      data: donutData,
      options: donutOptions
    })

    //-------------
    //- PIE CHART -
    //-------------
    // Get context with jQuery - using jQuery's .get() method.
    var pieChartCanvas = $('#pieChart').get(0).getContext('2d')
    var pieData        = donutData;
    var pieOptions     = {
      maintainAspectRatio : false,
      responsive : true,
    }
    //Create pie or douhnut chart
    // You can switch between pie and douhnut using the method below.
    new Chart(pieChartCanvas, {
      type: 'pie',
      data: pieData,
      options: pieOptions
    })

    //-------------
    //- BAR CHART -
    //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    var temp1 = areaChartData.datasets[1]
    barChartData.datasets[0] = temp1
    barChartData.datasets[1] = temp0

    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })

    //---------------------
    //- STACKED BAR CHART -
    //---------------------
    var stackedBarChartCanvas = $('#stackedBarChart').get(0).getContext('2d')
    var stackedBarChartData = $.extend(true, {}, barChartData)

    var stackedBarChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      scales: {
        xAxes: [{
          stacked: true,
        }],
        yAxes: [{
          stacked: true
        }]
      }
    }

    new Chart(stackedBarChartCanvas, {
      type: 'bar',
      data: stackedBarChartData,
      options: stackedBarChartOptions
    })
  })
</script>

</body>
</html>
