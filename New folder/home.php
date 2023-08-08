
<?php 
require 'db.php'; 
//print_r($_POST);
if($_REQUEST){
$Region      = $_REQUEST['Region'];
$Location    = $_REQUEST['Location'];
$project     = $_REQUEST['project'];

$fmonth      = $_REQUEST['fmonth'];

$year        = $_REQUEST['year'];

  if(isset($_REQUEST)&& empty($_REQUEST['Field'])){
     $eshsListQuery  = "SELECT  smt.*, sp.*

                     FROM saca_project_master as smt

                     Inner Join saca_profitability as sp

                     ON smt.project_code = sp.project
                       ";
                  if(!empty($Region)){
                         $eshsListQuery .= " AND sp.Region = '".$Region."' ";
                  }
                  if(!empty($Location)){
                         $eshsListQuery .= " AND sp.Location = '".$Location."' ";
                  }
                   if(!empty($project)){
                       
                         $eshsListQuery .= " AND sp.project = '".$project."' ";
                  }
                  // if(!empty($fmonth )){
                  //     $eshsListQuery .= " AND sp.month = '".$fmonth."' ";
                  // } 
                  // if(!empty($year)){
                       
                  //        $eshsListQuery .= " AND sp.year  = '".$year."' ";
                  // }
     $eshsListResult = mysqli_query($con,$eshsListQuery);
     $eshsListCount  = mysqli_num_rows($eshsListResult);
     $filterArrayData = array();
     $singleProjectdata = array();
    if($eshsListCount > 0){ 
        $counterListLoop   = 0;
       while($singleProjectRes = mysqli_fetch_assoc($eshsListResult)){
     
         $singleProjectdata['Fees_MTD'] = $singleProjectRes['Fees'];
        $singleProjectdata['Reimb_MTD'] = $singleProjectRes['Reimb'];
        $singleProjectdata['Total_Rev_MTD'] = $singleProjectRes['Total_Rev'];
        $singleProjectdata['Salary_MTD'] = $singleProjectRes['Salary'];
        $singleProjectdata['Reim_Cost_MTD'] = $singleProjectRes['Reim_Cost'];
        $singleProjectdata['Total_Cost_MTD'] =  $singleProjectRes['Total_Cost'];
        $singleProjectdata['Contrib_MTD'] =  $singleProjectRes['Contrib'];
        $singleProjectdata['Cont_Margin_MTD'] =  $singleProjectRes['Cont_Margin'];

        $singleProjectdata['Fees_YTD'] = $singleProjectRes['Fees1'];
        $singleProjectdata['Reimb_YTD'] = $singleProjectRes['Reimb1'];
        $singleProjectdata['Total_Rev_YTD'] = $singleProjectRes['Total_Rev1'];
        $singleProjectdata['Salary_YTD'] = $singleProjectRes['Salary1'];
        $singleProjectdata['Reim_Cost_YTD'] = $singleProjectRes['Reim_Cost1'];
        $singleProjectdata['Total_Cost_YTD'] =  $singleProjectRes['Total_Cost1'];
        $singleProjectdata['Contrib_YTD'] =  $singleProjectRes['Contrib1'];
        $singleProjectdata['Cont_Margin_YTD'] =  $singleProjectRes['Cont_Margin1'];

        $singleProjectdata['Fees_LTD'] = $singleProjectRes['Fees2'];
        $singleProjectdata['Reimb_LTD'] = $singleProjectRes['Reimb2'];
        $singleProjectdata['Total_Rev_LTD'] = $singleProjectRes['Total_Rev2'];
        $singleProjectdata['Salary_LTD'] = $singleProjectRes['Salary2'];
        $singleProjectdata['Reim_Cost_LTD'] = $singleProjectRes['Reim_Cost2'];
        $singleProjectdata['Total_Cost_LTD'] =  $singleProjectRes['Total_Cost2'];
        $singleProjectdata['Contrib_LTD'] =  $singleProjectRes['Contrib2'];
        $singleProjectdata['Cont_Margin_LTD'] =  $singleProjectRes['Cont_Margin2'];

        $singleProjectdata['project'] =  $singleProjectRes['project'];
        $singleProjectdata['Project_Description'] =  $singleProjectRes['Project_Description'];


         $counterListLoop++;
       } 
    }
  }
  ###### search project by field
}  
//print_r($singleProjectdata['Cont_Margin_LTD']);exit;
####get sum of whole project in saca###


     $totalProjectQuery  = "SELECT 
                              smt.*, 
                           SUM(sp.Fees)  AS MTD_Fees,
                           SUM(sp.Reimb) AS MTD_Reimb,
                           SUM(sp.Total_Rev) AS MTD_Total_Rev,
                           SUM(sp.Salary) AS MTD_Salary,
                           SUM(sp.Reim_Cost) AS MTD_Reim_Cost,
                           SUM(sp.Total_Cost) AS MTD_Total_Cost,
                           SUM(sp.Contrib) AS MTD_Contrib,
                           SUM(sp.Cont_Margin) AS MTD_Cont_Margin,

                            SUM(sp.Fees1)  AS YTD_Fees1,
                           SUM(sp.Reimb1) AS YTD_Reimb1,
                           SUM(sp.Total_Rev1) AS YTD_Total_Rev1,
                           SUM(sp.Salary1) AS YTD_Salary1,
                           SUM(sp.Reim_Cost1) AS YTD_Reim_Cost1,
                           SUM(sp.Total_Cost1) AS YTD_Total_Cost1,
                           SUM(sp.Contrib1) AS YTD_Contrib1,
                           SUM(sp.Cont_Margin1) AS YTD_Cont_Margin1,


                            SUM(sp.Fees2)  AS LTD_Fees2,
                           SUM(sp.Reimb2) AS LTD_Reimb2,
                           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                           SUM(sp.Salary2) AS LTD_Salary2,
                           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                           SUM(sp.Contrib2) AS LTD_Contrib2,
                           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON smt.project_code = sp.project
                         
                           Where 1 ";
                           
                
     $totalProjectResult = mysqli_query($con,$totalProjectQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
        $counterListLoop   = 0;
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
        $totalProjectdata['sum_Fees_MTD'] = $totalProjectRes['MTD_Fees'];
        $totalProjectdata['sum_Reimb_MTD'] = $totalProjectRes['MTD_Reimb'];
        $totalProjectdata['sum_Total_Rev_MTD'] = $totalProjectRes['MTD_Total_Rev'];
        $totalProjectdata['sum_Salary_MTD'] = $totalProjectRes['MTD_Salary'];
        $totalProjectdata['sum_Reim_Cost_MTD'] = $totalProjectRes['MTD_Reim_Cost'];
        $totalProjectdata['sum_Total_Cost_MTD'] =  $totalProjectRes['MTD_Total_Cost'];
        $totalProjectdata['sum_Contrib_MTD'] =  $totalProjectRes['MTD_Contrib'];
        $totalProjectdata['sum_Cont_Margin_MTD'] =  $totalProjectRes['MTD_Cont_Margin'];

        $totalProjectdata['sum_Fees_YTD'] = $totalProjectRes['YTD_Fees1'];
        $totalProjectdata['sum_Reimb_YTD'] = $totalProjectRes['YTD_Reimb1'];
        $totalProjectdata['sum_Total_Rev_YTD'] = $totalProjectRes['YTD_Total_Rev1'];
        $totalProjectdata['sum_Salary_YTD'] = $totalProjectRes['YTD_Salary1'];
        $totalProjectdata['sum_Reim_Cost_YTD'] = $totalProjectRes['YTD_Reim_Cost1'];
        $totalProjectdata['sum_Total_Cost_YTD'] =  $totalProjectRes['YTD_Total_Cost1'];
        $totalProjectdata['sum_Contrib_YTD'] =  $totalProjectRes['YTD_Contrib1'];
        $totalProjectdata['sum_Cont_Margin_YTD'] =  $totalProjectRes['YTD_Cont_Margin1'];

        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
       
         $counterListLoop++;
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
       } 
    }
    ####get sum of whole project inside saca###
 ?>
 <?php //print_r($totalProjectdata['sum_Cont_Margin_LTD']);?>

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
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" >
  <!-- Navbar -->
<?php 

require 'partials/header.php'; ?> 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require 'partials/sidebar.php'; ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="padding:10px 10px;">
    <!-- Content Header (Page header) -->
    

     <div class="card card-danger">
      <img  src="../../sacadb/theme/dist/img/sb-grp.jpg"
           alt="SACA Logo"  >
        
      </div> 
     
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

<script type="text/javascript">
  

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true
////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-MTD')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Fee', 'Reimb', 'Total Rev', 'Salary', 'Reim Cost', 'Total Cost', 'Contrib','Cont Margin'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['sum_Fees_MTD']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_MTD']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_MTD']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_MTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_MTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_MTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_MTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_MTD']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_MTD'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_MTD']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_MTD']; ?>,
                 <?php  echo $singleProjectdata['Salary_MTD']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_MTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_MTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_MTD']; ?>,
                  <?php  echo $singleProjectdata['Salary_MTD']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-YTD')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Fee', 'Reimb', 'Total Rev', 'Salary', 'Reim Cost', 'Total Cost', 'Contrib','Cont Margin'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['sum_Fees_YTD']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_YTD']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_YTD']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_YTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_YTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_YTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_YTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_YTD']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_YTD'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_YTD']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_YTD']; ?>,
                 <?php  echo $singleProjectdata['Salary_YTD']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_YTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_YTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_YTD']; ?>,
                  <?php  echo $singleProjectdata['Salary_YTD']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////

  
////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-LTD')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Fee', 'Reimb', 'Total Rev', 'Salary', 'Reim Cost', 'Total Cost', 'Contrib','Cont Margin'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['sum_Fees_LTD']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_LTD']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_LTD']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_LTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_LTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_LTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_LTD']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_LTD']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_LTD'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_LTD']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_LTD']; ?>,
                 <?php  echo $singleProjectdata['Salary_LTD']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_LTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_LTD'];?>, 
                  <?php  echo $singleProjectdata['Salary_LTD']; ?>,
                  <?php  echo $singleProjectdata['Salary_LTD']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////

  

///////////////////////////////////////////////////////////




  
  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})

</script>
</script>
</body>
</html>
