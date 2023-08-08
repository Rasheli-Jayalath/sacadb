
<?php 
require 'db.php'; 
//print_r($_POST);
if(isset($_REQUEST)){ 
$Region      = isset($_REQUEST['Region']);
$Location    = isset($_REQUEST['Location']);
$project     = isset($_REQUEST['project']);

$fmonth      = isset($_REQUEST['fmonth']);

$year        = isset($_REQUEST['year']);

  if(isset($_REQUEST) && isset($_REQUEST['Region']) or isset($_REQUEST['Location']) or isset($_REQUEST['project'])){
     $eshsListQuery  = "SELECT 

                    smt.*, sp.*

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
                       
                         $eshsListQuery .= " AND sp.project = '".$project."' order by month DESC";
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
     
       
        $singleProjectdata['Fees_EAC'] = $singleProjectRes['Fees3'];
        $singleProjectdata['Reimb_EAC'] = $singleProjectRes['Reimb3'];
        $singleProjectdata['Total_Rev_EAC'] = $singleProjectRes['Total_Rev3'];
        $singleProjectdata['Salary_EAC'] = $singleProjectRes['Salary3'];
        $singleProjectdata['Reim_Cost_EAC'] = $singleProjectRes['Reim_Cost3'];
        $singleProjectdata['Total_Cost_EAC'] =  $singleProjectRes['Total_Cost3'];
        $singleProjectdata['Contrib_EAC'] =  $singleProjectRes['Contrib3'];
        $singleProjectdata['Cont_Margin_EAC'] =  $singleProjectRes['Cont_Margin3'];

        $singleProjectdata['Fees_ETC'] = $singleProjectRes['Fees4'];
        $singleProjectdata['Reimb_ETC'] = $singleProjectRes['Reimb4'];
        $singleProjectdata['Total_Rev_ETC'] = $singleProjectRes['Total_Rev4'];
        $singleProjectdata['Salary_ETC'] = $singleProjectRes['Salary4'];
        $singleProjectdata['Reim_Cost_ETC'] = $singleProjectRes['Reim_Cost4'];
        $singleProjectdata['Total_Cost_ETC'] =  $singleProjectRes['Total_Cost4'];
        $singleProjectdata['Contrib_ETC'] =  $singleProjectRes['Contrib4'];
        $singleProjectdata['Cont_Margin_ETC'] =  $singleProjectRes['Cont_Margin4'];

        $singleProjectdata['project'] =  $singleProjectRes['project'];
        $singleProjectdata['Project_Description'] =  $singleProjectRes['Project_Description'];


         $counterListLoop++;
       } 
    }
    else{
      header('location:ee_graph.php?msg=1');
    }
  }
  ###### search project by field
}  
//print_r($singleProjectdata['Cont_Margin_LTD']);exit;
####get sum of whole project in saca###

     $totalProjectQuery  = "SELECT 
                              smt.*,
                           SUM(sp.Fees3)  AS EAC_Fees3,
                           SUM(sp.Reimb3) AS EAC_Reimb3,
                           SUM(sp.Total_Rev3) AS EAC_Total_Rev3,
                           SUM(sp.Salary3) AS EAC_Salary3,
                           SUM(sp.Reim_Cost3) AS EAC_Reim_Cost3,
                           SUM(sp.Total_Cost3) AS EAC_Total_Cost3,
                           SUM(sp.Contrib3) AS EAC_Contrib3,
                           SUM(sp.Cont_Margin3) AS EAC_Cont_Margin3,


                           SUM(sp.Fees4)  AS ETC_Fees4,
                           SUM(sp.Reimb4) AS ETC_Reimb4,
                           SUM(sp.Total_Rev4) AS ETC_Total_Rev4,
                           SUM(sp.Salary4) AS ETC_Salary4,
                           SUM(sp.Reim_Cost4) AS ETC_Reim_Cost4,
                           SUM(sp.Total_Cost4) AS ETC_Total_Cost4,
                           SUM(sp.Contrib4) AS ETC_Contrib4,
                           SUM(sp.Cont_Margin4) AS ETC_Cont_Margin4

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
      
        $totalProjectdata['sum_Fees_EAC'] = $totalProjectRes['EAC_Fees3'];
        $totalProjectdata['sum_Reimb_EAC'] = $totalProjectRes['EAC_Reimb3'];
        $totalProjectdata['sum_Total_Rev_EAC'] = $totalProjectRes['EAC_Total_Rev3'];
        $totalProjectdata['sum_Salary_EAC'] = $totalProjectRes['EAC_Salary3'];
        $totalProjectdata['sum_Reim_Cost_EAC'] = $totalProjectRes['EAC_Reim_Cost3'];
        $totalProjectdata['sum_Total_Cost_EAC'] =  $totalProjectRes['EAC_Total_Cost3'];
        $totalProjectdata['sum_Contrib_EAC'] =  $totalProjectRes['EAC_Contrib3'];
        $totalProjectdata['sum_Cont_Margin_EAC'] =  $totalProjectRes['EAC_Cont_Margin3'];

        $totalProjectdata['sum_Fees_ETC'] = $totalProjectRes['ETC_Fees4'];
        $totalProjectdata['sum_Reimb_ETC'] = $totalProjectRes['ETC_Reimb4'];
        $totalProjectdata['sum_Total_Rev_ETC'] = $totalProjectRes['ETC_Total_Rev4'];
        $totalProjectdata['sum_Salary_ETC'] = $totalProjectRes['ETC_Salary4'];
        $totalProjectdata['sum_Reim_Cost_ETC'] = $totalProjectRes['ETC_Reim_Cost4'];
        $totalProjectdata['sum_Total_Cost_ETC'] =  $totalProjectRes['ETC_Total_Cost4'];
        $totalProjectdata['sum_Contrib_ETC'] =  $totalProjectRes['ETC_Contrib4'];
        $totalProjectdata['sum_Cont_Margin_ETC'] =  $totalProjectRes['ETC_Cont_Margin4'];
       
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
  <title>EAC & ETC Analysis</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<style type="text/css">
    .card-success:not(.card-outline)>.card-header {
    background-color: #79a9ce; 
    }
    .card-danger:not(.card-outline)>.card-header {
    background-color: #1d3a67;

    }
     #filter-sec{
      margin-left:1em;
      margin-right:1em;
    }
    #result-sec{
      margin-left:1em;
      margin-right:1em;
    }
    </style>
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Fee Analysis";}if(isset($singleProjectdata)){ echo 'Fee Analysis &raquo '.$singleProjectdata['project']." - ".$singleProjectdata['Project_Description'];}?>
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <div class="card card-danger" id="filter-sec">
      <!-- <div class="card-header">
        <h3 class="card-title">Different Width</h3>
      </div> -->
      <div class="card-body">
        <form method="post" id="form-id" action="">
          <div class="row">
              <div class="col-2"> 
                 <select class="custom-select" name="Region" id="Region">
                   <option value="">Select Region</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM saca_profitability GROUP BY Region
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
                <select class="custom-select" name="Location" id="Location">
                    <option value="">Select Region first</option>
                </select>
              </div>
              <div class="col-2">
                <select class="custom-select" name="project" id="project">
                  <option value="">Select Location first</option>
                </select>
              </div>
              <script>
                $(document).ready(function(){
                    $('#Region').on('change', function(){
                        var RegionID = $(this).val();
                        //alert(RegionID);
                       
                      
                        if(RegionID){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'Region_id='+RegionID,
                                success:function(html){
                                    $('#Location').html(html);
                                    $('#project').html('<option value="">Select project first</option>'); 
                                }
                            }); 
                        }else{
                            $('#Location').html('<option value="">Select Region first</option>');
                            $('#project').html('<option value="">Select Location first</option>'); 
                        }
                    });
                    
                    $('#Location').on('change', function(){
                        var LocationID = $(this).val();
                        if(LocationID){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'Location_id='+LocationID,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
                        }else{
                            $('#project').html('<option value="">Select Location first</option>'); 
                        }
                    });
                });
                </script>
                <div class="col-1">
                <button type="button" name="search" id="search" onclick="document.getElementById('form-id').submit();" class="btn btn-success" onclick="docume">SEARCH</button>
              </div>
               <!-- <div class="col-1.5">
                <button type="button" onclick="document.getElementById('form-id').submit();" class="btn btn-success">SEARCH</button>
              </div> -->
               <div class="col-2" style="text-align:right;margin-top:5px;">
                  <label style="text-align:right;">Data Update Month: </label>
              </div>
              <div class="col-1.5" style="margin-right:1em">
                <select class="custom-select" name="fmonth">
                  <option value="">Month</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT month
                                  FROM saca_profitability  GROUP BY month order by month DESC ";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['month'].$i; ?>" 
                            <?php if($incListCount == $i){ echo "selected";} ?>
                            ><?php echo $incListRes['month']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
              <div class="col-1.5">
                   <select class="custom-select" name="year">
                  <option value="">----Year----</option>
                  <?php 
                   if($con){
                        $incListQuery  = "SELECT year
                           FROM saca_profitability  GROUP BY year order by year ASC ";
                                           
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['year'].$i; ?>" 
                            <?php if($incListCount == $i){ echo "selected";} ?>
                            ><?php echo $incListRes['year']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
             
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    <div class="card card-danger" id="result-sec">
      
        <?php if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == '1'){ ?>
      <div class="card-body" style="color: red; text-align: center;">
        
     
          <div class="row">
              <div class="col-12"> 
                 <span  style="color: red; text-align: right;font-size:1.25em"><?php echo "Record Not Found"; ?></span>
              </div>
           </div>   
      </div>
        <?php } ?>
      
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
        
        
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Fee EAC</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="Fee-EAC" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
          
             <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Fee ETC</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="Fee-ETC" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- BAR CHART -->
           
          </div>
          <!-- /.col (RIGHT) -->

        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #1d3a67; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Fee EAC";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoFee EAC';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Fees EAC</th>
                      <th>Reimb EAC</th>
                      <th>Total Rev EAC</th>
                      <th>Salary EAC</th>
                      <th>Reim Cost EAC</th>
                      <th>Total Cost EAC</th>
                      <th>Contrib EAC</th>
                      <th>Cont Margin EAC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['sum_Fees_EAC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Reimb_EAC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Total_Rev_EAC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Salary_EAC'];?></td>
                        <td><?php echo $totalProjectdata['sum_Reim_Cost_EAC']?></td>
                        <td><?php echo $totalProjectdata['sum_Total_Cost_EAC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Contrib_EAC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Cont_Margin_EAC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Fees EAC</th>
                      <th>Reimb EAC</th>
                      <th>Total Rev EAC</th>
                      <th>Salary EAC</th>
                      <th>Reim Cost EAC</th>
                      <th>Total Cost EAC</th>
                      <th>Contrib EAC</th>
                      <th>Cont Margin EAC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['Fees_EAC']; ?></td>
                        <td><?php echo $singleProjectdata['Reimb_EAC']; ?></td>
                        <td><?php echo $singleProjectdata['Total_Rev_EAC']; ?></td>
                        <td><?php echo $singleProjectdata['Salary_EAC'];?></td>
                        <td><?php echo $singleProjectdata['Reim_Cost_EAC']?></td>
                        <td><?php echo $singleProjectdata['Total_Cost_EAC']; ?></td>
                        <td><?php echo $singleProjectdata['Contrib_EAC']; ?></td>
                        <td><?php echo $singleProjectdata['Cont_Margin_EAC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <!--YTD-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Fee ETC";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoFee ETC';}?></bold></h3>

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
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Fees ETC</th>
                      <th>Reimb ETC</th>
                      <th>Total Rev ETC</th>
                      <th>Salary ETC</th>
                      <th>Reim Cost ETC</th>
                      <th>Total Cost ETC</th>
                      <th>Contrib ETC</th>
                      <th>Cont Margin ETC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['sum_Fees_ETC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Reimb_ETC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Total_Rev_ETC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Salary_ETC'];?></td>
                        <td><?php echo $totalProjectdata['sum_Reim_Cost_ETC']?></td>
                        <td><?php echo $totalProjectdata['sum_Total_Cost_ETC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Contrib_ETC']; ?></td>
                        <td><?php echo $totalProjectdata['sum_Cont_Margin_ETC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Fees ETC</th>
                      <th>Reimb ETC</th>
                      <th>Total Rev ETC</th>
                      <th>Salary ETC</th>
                      <th>Reim Cost ETC</th>
                      <th>Total Cost ETC</th>
                      <th>Contrib ETC</th>
                      <th>Cont Margin ETC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['Fees_ETC']; ?></td>
                        <td><?php echo $singleProjectdata['Reimb_ETC']; ?></td>
                        <td><?php echo $singleProjectdata['Total_Rev_ETC']; ?></td>
                        <td><?php echo $singleProjectdata['Salary_ETC'];?></td>
                        <td><?php echo $singleProjectdata['Reim_Cost_ETC']?></td>
                        <td><?php echo $singleProjectdata['Total_Cost_ETC']; ?></td>
                        <td><?php echo $singleProjectdata['Contrib_ETC']; ?></td>
                        <td><?php echo $singleProjectdata['Cont_Margin_ETC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        

        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
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
  var $salesChart = $('#Fee-EAC')
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
                 <?php  echo $totalProjectdata['sum_Fees_EAC']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_EAC']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_EAC']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_EAC']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_EAC'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_EAC']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_EAC']; ?>,
                 <?php  echo $singleProjectdata['Salary_EAC']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_EAC'];?>, 
                  <?php  echo $singleProjectdata['Salary_EAC'];?>, 
                  <?php  echo $singleProjectdata['Salary_EAC']; ?>,
                  <?php  echo $singleProjectdata['Salary_EAC']; 
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
  var $salesChart = $('#Fee-ETC')
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
                 <?php  echo $totalProjectdata['sum_Fees_ETC']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_ETC']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_ETC']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_ETC']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_ETC'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_ETC']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_ETC']; ?>,
                 <?php  echo $singleProjectdata['Salary_ETC']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_ETC'];?>, 
                  <?php  echo $singleProjectdata['Salary_ETC'];?>, 
                  <?php  echo $singleProjectdata['Salary_ETC']; ?>,
                  <?php  echo $singleProjectdata['Salary_ETC']; 
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
