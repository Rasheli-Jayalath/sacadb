<?php 

 require 'db.php'; ?>


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
             <iframe  scrolling="no" frameBorder="0" height="1000" width="1280" src="http://117.247.187.20:8071/Oppurtunity/qrdash-home.php"> </iframe> 
    </section>

     <div class="card card-danger">
      <!-- <div class="card-header">
        <h3 class="card-title">Different Width</h3>
      </div> -->
      <!-- <div class="card-body">
        <form method="post" id="form-id" action="">
          <div class="row">
              <div class="col-2"> 
                 <select class="custom-select" name="Region">
                   <option value="">SELECT REGION</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM saca GROUP BY Region
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['Region']; ?>"><?php echo $incListRes['Region']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
              <div class="col-2">
                  <select class="custom-select" name="Location">
                  <option value="">SELECT Location</option>
                  <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM saca GROUP BY Location
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['Location']; ?>"><?php echo $incListRes['Location']; ?></option>
                         <?php
                     }}?>
                 </select>
              </div>
              <div class="col-2">
                   <select class="custom-select" name="project">
                   <option value="">SELECT Project</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM saca GROUP BY project 
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['project']; ?>"><?php echo $incListRes['project']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
               <div class="col-2"> 
                 <select class="custom-select" name="Field">
                   <option value="">Select Field</option>
                   <option value="Billings">Billings</option>
                   <option value="WIP">WIP</option>
                   <option value="Debtors">Debtors</option>
                   <option value="Lockup">Lockup</option>


                   </select>
              </div>

               <div class="col-1"> 
                 <select name="fmonth" id="month" class="form-control" required>
                  <option value="">FROM</option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November ">November </option>
                  <option value="December">December</option>
                </select>
              </div>
              <div class="col-1">
                  <select name="tmonth" id="month" class="form-control" required>
                  <option value="">TO</option>
                  <option value="January">January</option>
                  <option value="February">February</option>
                  <option value="March">March</option>
                  <option value="April">April</option>
                  <option value="May">May</option>
                  <option value="June">June</option>
                  <option value="July">July</option>
                  <option value="August">August</option>
                  <option value="September">September</option>
                  <option value="October">October</option>
                  <option value="November ">November </option>
                  <option value="December">December</option>
                </select>
              </div>
              <div class="col-1">
                   <select name="year" id="year" class="form-control" required="">
                    <option value="">Year</option>
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                  </select>
              </div>
               <div class="col-1">
                <button type="button" onclick="document.getElementById('form-id').submit();" class="btn btn-success" onclick="docume">SEARCH</button>
              </div>
             
          </div>
        </form>
      </div> -->
      <!-- /.card-body -->
    </div>


    <!-- Main content -->
  
    <!-- /.content -->
  </div>
  
  
  <!-- /.content-wrapper -->
   
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b> 
    </div>
    <strong><a href="https://adminlte.io"></a></strong> 
  </footer>
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
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
