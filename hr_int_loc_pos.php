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
//print_r($_REQUEST);
if(isset($_REQUEST['sts_tbl1id'])){
 $tbl1id = $_REQUEST['tbl1id'] ;


echo $query = "UPDATE `hr_int_pos` SET 

`status`='0'


WHERE  id = '".$_REQUEST['sts_tbl1id']."'
";
$qry_fcn = mysqli_query($con,$query); 
header('location:hr_int_loc_pos.php');
}
if(isset($_REQUEST['sts_tbl2id'])){
 $tbl1id = $_REQUEST['tbl1id'] ;


echo $query = "UPDATE `hr_loc_pos` SET 

`status`='0'


WHERE  id = '".$_REQUEST['sts_tbl2id']."'
";
$qry_fcn = mysqli_query($con,$query); 
header('location:hr_int_loc_pos.php');
}
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
  #th{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#79a9ce;
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
        <div class="card-tools">

          <div class="col-8 input-group-append ">
                <button type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_update_form.php?addtbl1=int';"><h6>Add International Position</h6></button>
                <button type="button" style="margin-left:20px; margin-top:0px; margin-bottom:20px;" class="btn btn-block btn btn-sm" ><h6>
                  <form method="post" action="" >
                <select name="tbl1_filter_month"  class="custom-select">
                  <?php if($con){
                  $incListQuery  = "SELECT distinct(month) FROM `hr_int_pos` group by month
                                  "; 
                  $incListResult = mysqli_query($con,$incListQuery);
                  $incListCount  = mysqli_num_rows($incListResult);
                  $resArrayData  = array();
                  if($incListCount > 0){?>
                    <option value="">SELECT MONTH  </option>
                 <?php while($incListRes = mysqli_fetch_assoc($incListResult)){
                   ?>

                  <option value="<?php echo $incListRes['month'];?>"><?php if($incListRes['month'] == '1') echo "JAN"; if($incListRes['month'] == '2') echo "FEB";  if($incListRes['month'] == '3') echo "MAR";  if($incListRes['month'] == '4') echo "APR";  if($incListRes['month'] == '5') echo "MAY";
                   if($incListRes['month'] == '6') echo "JUNE";  if($incListRes['month'] == '7') echo "JULY";  if($incListRes['month'] == '8') echo "AUG";  if($incListRes['month'] == '9') echo "SEP";  if($incListRes['month'] == '10') echo "OCT";  if($incListRes['month'] == '11') echo "NOV";  if($incListRes['month'] == '12') echo "DEC";
                  ?></option>
                  
                  <?php }  }  ?>
                 </select><?php }?></h6></button>
                 <button type="button" style="margin-left:20px; margin-top:0px; margin-bottom:20px;" class="btn btn-block btn btn-sm" ><h6>
                  <select name="tbl1_filter_year" onchange="this.form.submit();" class="custom-select">
                    <?php if($con){
                    $incListQuery  = "SELECT distinct(year1) FROM `hr_int_pos` group by year1
                                    "; 
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){?>
                      <option value="">SELECT YEAR </option>
                   <?php while($incListRes = mysqli_fetch_assoc($incListResult)){
                     ?>

                    <option value="<?php echo $incListRes['year1'];?>"><?php if($incListRes['year1'] == '2023') echo "2023"; if($incListRes['year1'] == '2022') echo "2022"; 
                    ?></option>
                    
                    <?php }  }  ?>
                  </select></form><?php }?></h6>
                </button>
              </div>
          </div>
           <!--- tbl1-->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="background-color: #336992; color: white; ">
                  <?php $getMaxMonth =  $incListQuery  = "SELECT month FROM `hr_int_pos` WHERE month = (SELECT MAX(month) FROM hr_int_pos) AND status = 1";
                   $getMaxMonthResult = mysqli_query($con,$getMaxMonth);
                   $getMaxMonthRes    = mysqli_fetch_assoc($getMaxMonthResult);
                   $getMaxYear =  $incListQuery  = "SELECT year1 FROM `hr_int_pos` WHERE year1 = (SELECT MAX(year1) FROM hr_int_pos) AND status = 1";
                   $getMaxYearResult = mysqli_query($con,$getMaxYear);
                   $getMaxYearRes    = mysqli_fetch_assoc($getMaxYearResult);
                  
                   ?>
                  <h3 class="card-title"><bold>International Positions: The current status as of <?php
                  if(isset($getMaxMonthRes) && isset($getMaxYearRes) && !isset($_REQUEST['tbl1_filter_year'])){
                    if($getMaxMonthRes['month'] == '1') echo "JAN"; if($getMaxMonthRes['month'] == '2') echo "FEB";  if($getMaxMonthRes['month'] == '3') echo "MAR";  if($getMaxMonthRes['month'] == '4') echo "APR";  if($getMaxMonthRes['month'] == '5') echo "MAY";if($getMaxMonthRes['month'] == '6') echo "JUNE";  if($getMaxMonthRes['month'] == '7') echo "JULY";  if($getMaxMonthRes['month'] == '8') echo "AUG";  if($getMaxMonthRes['month'] == '9') echo "SEP";  if($getMaxMonthRes['month'] == '10') echo "OCT";  if($getMaxMonthRes['month'] == '11') echo "NOV";  if($getMaxMonthRes['month'] == '12') echo "DEC"; echo" "; if($getMaxYearRes['year1'] == '2023') echo "2023"; if($getMaxYearRes['year1'] == '2022') echo "2022";
                   }
                   if(isset($_REQUEST['tbl1_filter_month']) && isset($_REQUEST['tbl1_filter_year']) ){
                       if($_REQUEST['tbl1_filter_month'] == '1') echo "JAN"; if($_REQUEST['tbl1_filter_month'] == '2') echo "FEB";  if($_REQUEST['tbl1_filter_month'] == '3') echo "MAR";  if($_REQUEST['tbl1_filter_month'] == '4') echo "APR";  if($_REQUEST['tbl1_filter_month'] == '5') echo "MAY";if($_REQUEST['tbl1_filter_month'] == '6') echo "JUNE";  if($_REQUEST['tbl1_filter_month'] == '7') echo "JULY";  if($_REQUEST['tbl1_filter_month'] == '8') echo "AUG";  if($_REQUEST['tbl1_filter_month'] == '9') echo "SEP";  if($_REQUEST['tbl1_filter_month'] == '10') echo "OCT";  if($_REQUEST['tbl1_filter_month'] == '11') echo "NOV";  if($_REQUEST['tbl1_filter_month'] == '12') echo "DEC"; echo" "; if($_REQUEST['tbl1_filter_year'] == '2023') echo "2023"; if($_REQUEST['tbl1_filter_year'] == '2022') echo "2022";
                   } 
                          ?></bold></h3>
                </div>
                <!-- /.card-header -->
               
                <div class="card-body table-responsive p-0">
                  <table class="table table-head-fixed text-nowrap">
                    <thead id="th">
                      <tr>
                        <th style="vertical-align: middle; text-align:center;" id="th">Country</th>
                        <th style="vertical-align: middle; text-align:center;" id="th">Live Billable <br> Open Positions <br>   (FY’<?php if(isset($getMaxYearRes) && $getMaxYearRes['year1'] == '2023') echo "2023"; if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2022') echo "2022"; ?>) </th>
                        <th style="vertical-align: middle; text-align:center;" id="th">Positions Incurring <br> Revenue Loss <br>(FY’<?php if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2023') echo "2023"; if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2022') echo "2022"; ?>)</th>

                        <th style="vertical-align: middle; text-align:center;" id="th">Loss due to <br> Non mobilization <br>(AUD)</th>
                          <th style="vertical-align: middle; text-align:center;" id="th">Loss due to <br> Non mobilization <br>(Previous Month)</th>
                        <th style="vertical-align: middle; text-align:center;" id="th">Billable Staff<br> mobilized <br> (FY’<?php if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2023') echo "2023"; if( isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2022') echo "2022"; ?>)</th>
                        <th style="vertical-align: middle; text-align:center;" id="th">Update</th>
                         <th style="vertical-align: middle; text-align:center;" id="th">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                     
                     <?php if($con && !isset($_REQUEST['tbl1_filter_month'])){
                          $incListQuery  = "SELECT * FROM `hr_int_pos` WHERE month = (SELECT MAX(month) FROM hr_int_pos) AND status = 1";   

                      } 
                      else if($con && isset($_REQUEST['tbl1_filter_month'])){
                         $incListQuery  = "SELECT * FROM `hr_int_pos` WHERE month = '".$_REQUEST['tbl1_filter_month']."'
                          AND year1 = '".$_REQUEST['tbl1_filter_year']."' AND status = 1
                                        "; 
                      }           
                      $incListResult = mysqli_query($con,$incListQuery);
                      $incListCount  = mysqli_num_rows($incListResult);
                      $resArrayData  = array();
                      if($incListCount > 0){
                        $sum_bill_open_pos = 0;
                        $sum_pos_incurr_rev_loss = 0;
                        $sum_loss_non_mobilize = 0;
                        $sum_bill_staff_mobilize = 0;
                        $sum_lnm = 0;
                          while($incListRes = mysqli_fetch_assoc($incListResult)){
                           ?>
                     
                       <tr>
                          <td><?php echo $incListRes['country']; ?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes['bill_open_pos']);
                            $sum_bill_open_pos = $sum_bill_open_pos + $incListRes['bill_open_pos'];?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes['pos_incurr_rev_loss']); 
                             $sum_pos_incurr_rev_loss = $sum_pos_incurr_rev_loss + $incListRes['pos_incurr_rev_loss'];
                          ?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes['loss_non_mobilize']);
                          $sum_loss_non_mobilize = $sum_loss_non_mobilize + $incListRes['loss_non_mobilize'];
                           ?></td>
                        <?php 
                         $incListQueryk1  = "SELECT loss_non_mobilize as lnm FROM hr_int_pos WHERE month = (SELECT MAX(month) FROM hr_int_pos WHERE month < (SELECT MAX(month) FROM hr_int_pos) ) AND country ='".$incListRes['country']."' " ; 

                            $incListResultk1 = mysqli_query($con,$incListQueryk1);
                            $incListCountk1  = mysqli_num_rows($incListResultk1);
                            $incListResk1 = mysqli_fetch_assoc($incListResultk1);

                             $min_month_qry = "SELECT MIN(month) as fst_month FROM hr_int_pos ";
                            $min_month_result = mysqli_query($con,$min_month_qry);
                            $min_month_res1 = mysqli_fetch_assoc($min_month_result);
                          ?>
                          <td style="vertical-align: middle; text-align:center;">
                          <?php 
                           if(isset($_POST['tbl1_filter_month'] ) && $_POST['tbl1_filter_month'] !== $min_month_res1['fst_month']){
                              if($incListCountk1 > 0) { 
                                echo number_format($incListResk1['lnm']);
                               $sum_lnm = $sum_lnm + $incListResk1['lnm']; }
                              else{
                              echo 'No data';
                             }
                         }
                         else if(!isset($_POST['tbl1_filter_month']) && $incListCountk1 > 0 ){
                         
                          if($incListCountk1 > 0){
                           echo number_format($incListResk1['lnm']);  
                            $sum_lnm = $sum_lnm + $incListResk1['lnm'];
                          }
                          else{
                          echo 'No data';
                         }
                         }
                         else{
                        echo   "No Prev. Data";
                         }?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes['bill_staff_mobilize']); 
                          $sum_bill_staff_mobilize = $sum_bill_staff_mobilize + $incListRes['bill_staff_mobilize'];?></td>
                          
                          <td style="vertical-align: middle; text-align:center;"> <a href="hr_update_form.php?tbl1id=<?php echo  $incListRes['id'] ?>"> EDIT</a></td>
                           <td style="vertical-align: middle; text-align:center;"> <a  href="hr.php?sts_tbl1id=<?php echo  $incListRes['id'] ?>"> Delete</a></td> 
                          
                        </tr>
                      <?php } } else{ echo "<pre><h5><center>"."NO RECORD FOUND" ."</center></h5></pre>";} ?>
                       
                    </tbody>
                     <tbody>
                        <th>
                        Total SUM
                        </th>
                         <th style="vertical-align: middle; text-align:center;"> 
                          <?php echo $sum_bill_open_pos; ?>
                        </th>
                         <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_pos_incurr_rev_loss;?>
                       </th>
                        <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_loss_non_mobilize;?>
                       </th>
                        <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_lnm;?>
                       </th>
                        <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_bill_staff_mobilize;?>
                       </th>
                    </tbody>
                  </table>
                </div>
               
                <!--YTD-->

                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
           <!--- tbl1-->
           <br> </br>
            <div class="card-tools">

                   <div class="col-6 input-group-append ">
                     
                      <button type="button" style="margin-left:0px; margin-top:0px; margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_update_form.php?addtbl2=lcl';"><h6>Add Local Position</h6></button>
                      <button type="button" style="margin-left:20px; margin-top:0px; margin-bottom:20px;" class="btn btn-block btn btn-sm" ><h6>
                        <form method="post" action="" >
                      <select name="tbl2_filter_month" class="custom-select" >
                        <?php if($con){
                        $incListQuery  = "SELECT distinct(month) FROM `hr_loc_pos` group by month
                                        "; 
                        $incListResult = mysqli_query($con,$incListQuery);
                        $incListCount  = mysqli_num_rows($incListResult);
                        $resArrayData  = array();
                        if($incListCount > 0){?>
                          <option value="">SELECT MONTH  </option>
                       <?php while($incListRes = mysqli_fetch_assoc($incListResult)){
                         ?>

                        <option value="<?php echo $incListRes['month'];?>"><?php if($incListRes['month'] == '1') echo "JAN"; if($incListRes['month'] == '2') echo "FEB";  if($incListRes['month'] == '3') echo "MAR";  if($incListRes['month'] == '4') echo "APR";  if($incListRes['month'] == '5') echo "MAY";
                         if($incListRes['month'] == '6') echo "JUNE";  if($incListRes['month'] == '7') echo "JULY";  if($incListRes['month'] == '8') echo "AUG";  if($incListRes['month'] == '9') echo "SEP";  if($incListRes['month'] == '10') echo "OCT";  if($incListRes['month'] == '11') echo "NOV";  if($incListRes['month'] == '12') echo "DEC";
                        ?></option>
                        
                        <?php }  }  ?>
                       </select><?php }?>
                     </h6>
                     </button>
                       <button type="button" style="margin-left:20px; margin-top:0px; margin-bottom:20px;" class="btn btn-block btn btn-sm" ><h6>
                        <select name="tbl2_filter_year" onchange="this.form.submit();" class="custom-select">
                          <?php if($con){
                          $incListQuery  = "SELECT distinct(year1) FROM `hr_loc_pos` group by year1
                                          "; 
                          $incListResult = mysqli_query($con,$incListQuery);
                          $incListCount  = mysqli_num_rows($incListResult);
                          $resArrayData  = array();
                          if($incListCount > 0){?>
                            <option value="">SELECT YEAR </option>
                         <?php while($incListRes = mysqli_fetch_assoc($incListResult)){
                           ?>

                          <option value="<?php echo $incListRes['year1'];?>"><?php if($incListRes['year1'] == '2023') echo "2023"; if($incListRes['year1'] == '2022') echo "2022"; 
                          ?></option>
                          
                          <?php }  }  ?>
                        </select></form><?php }?></h6>
                      </button>
                     </div>
            </div>
          <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #336992; color: white; ">
                <?php $getMaxMonth =  $incListQuery  = "SELECT month
                 FROM `hr_loc_pos` WHERE month = (SELECT MAX(month) FROM hr_loc_pos)";
                 $getMaxMonthResult = mysqli_query($con,$getMaxMonth);
                 $getMaxMonthRes    = mysqli_fetch_assoc($getMaxMonthResult);
                 $getMaxYear =  $incListQuery  = "SELECT year1 FROM `hr_loc_pos` WHERE year1 = (SELECT MAX(year1) FROM hr_loc_pos)";
                 $getMaxYearResult = mysqli_query($con,$getMaxYear);
                 $getMaxYearRes    = mysqli_fetch_assoc($getMaxYearResult);
                 ?>
              
                <h3 class="card-title"><bold>Local Positions: The current status as of <?php
                  if(isset($getMaxMonthRes) && isset($getMaxYearRes) && !isset($_REQUEST['tbl2_filter_year'])){
                    if($getMaxMonthRes['month'] == '1') echo "JAN"; if($getMaxMonthRes['month'] == '2') echo "FEB";  if($getMaxMonthRes['month'] == '3') echo "MAR";  if($getMaxMonthRes['month'] == '4') echo "APR";  if($getMaxMonthRes['month'] == '5') echo "MAY";if($getMaxMonthRes['month'] == '6') echo "JUNE";  if($getMaxMonthRes['month'] == '7') echo "JULY";  if($getMaxMonthRes['month'] == '8') echo "AUG";  if($getMaxMonthRes['month'] == '9') echo "SEP";  if($getMaxMonthRes['month'] == '10') echo "OCT";  if($getMaxMonthRes['month'] == '11') echo "NOV";  if($getMaxMonthRes['month'] == '12') echo "DEC"; echo" "; if($getMaxYearRes['year1'] == '2023') echo "2023"; if($getMaxYearRes['year1'] == '2022') echo "2022";
                   }
                   if(isset($_REQUEST['tbl2_filter_month']) && isset($_REQUEST['tbl2_filter_year']) ){
                       if($_REQUEST['tbl2_filter_month'] == '1') echo "JAN"; if($_REQUEST['tbl2_filter_month'] == '2') echo "FEB";  if($_REQUEST['tbl2_filter_month'] == '3') echo "MAR";  if($_REQUEST['tbl2_filter_month'] == '4') echo "APR";  if($_REQUEST['tbl2_filter_month'] == '5') echo "MAY";if($_REQUEST['tbl2_filter_month'] == '6') echo "JUNE";  if($_REQUEST['tbl2_filter_month'] == '7') echo "JULY";  if($_REQUEST['tbl2_filter_month'] == '8') echo "AUG";  if($_REQUEST['tbl2_filter_month'] == '9') echo "SEP";  if($_REQUEST['tbl2_filter_month'] == '10') echo "OCT";  if($_REQUEST['tbl2_filter_month'] == '11') echo "NOV";  if($_REQUEST['tbl2_filter_month'] == '12') echo "DEC"; echo" "; if($_REQUEST['tbl2_filter_year'] == '2023') echo "2023"; if($_REQUEST['tbl2_filter_year'] == '2022') echo "2022";
                   } 
                          ?></bold></h3>

               
              </div>
              <!-- /.card-header -->
             
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead id="th">
                    <tr>
                      <th style="vertical-align: middle; text-align:center;" id="th">Country</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Live Billable <br> Open Positions</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Loss due to <br> Non mobilization<br>(In AUD)</th>
                        <th style="vertical-align: middle; text-align:center;" id="th">Loss due to <br> Non mobilization<br>(Previous Month)</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Billable <br>Staff Mobilized<br>(FY’<?php if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2023') echo "2023"; if(isset($getMaxYearRes['year1']) && $getMaxYearRes['year1'] == '2022') echo "2022"; ?>)</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Update</th>
                       <th style="vertical-align: middle; text-align:center;" id="th">Action</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                   <?php if($con && !isset($_REQUEST['tbl2_filter_month'])){
                        $incListQuery  = "SELECT * FROM `hr_loc_pos` WHERE month = (SELECT MAX(month) FROM hr_loc_pos)
                                      AND status = 1  ";   
                    }
                    else if($con && isset($_REQUEST['tbl2_filter_month'])){
                       $incListQuery  = "SELECT * FROM `hr_loc_pos` WHERE month = '".$_REQUEST['tbl2_filter_month']."' and year1 = '".$_REQUEST['tbl2_filter_year']."'  AND status = 1 
                                        "; 
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        $sum_bop = 0;
                        $sum_lnm = 0;
                        $sum_lnmpv = 0;
                        $sum_sm  = 0;

                        while($incListRes1 = mysqli_fetch_assoc($incListResult)){
                         ?>
                   
                     <tr>
                        <td><?php echo $incListRes1['country']; ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['bill_open_pos']); 
                        $sum_bop = $sum_bop + $incListRes1['bill_open_pos'] ; ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['loss_non_mobilize']); 
                        $sum_lnm = $sum_lnm + $incListRes1['loss_non_mobilize'];?></td>
                        <?php 
                          $incListQueryk  = "SELECT loss_non_mobilize as lnm1 FROM hr_loc_pos WHERE month = (SELECT MAX(month) FROM hr_loc_pos WHERE month < (SELECT MAX(month) FROM hr_loc_pos) ) AND country ='".$incListRes1['country']."' " ; 

                            $incListResultk = mysqli_query($con,$incListQueryk);
                            $incListCountk  = mysqli_num_rows($incListResultk);
                            $incListResk = mysqli_fetch_assoc($incListResultk);

                            $min_month_qry = "SELECT MIN(month) as fst_month FROM hr_loc_pos ";
                            $min_month_result = mysqli_query($con,$min_month_qry);
                            $min_month_res = mysqli_fetch_assoc($min_month_result);

                          ?>
                         <td style="vertical-align: middle; text-align:center;"><?php 
                         if(isset($_POST['tbl2_filter_month'] ) && $_POST['tbl2_filter_month'] !== $min_month_res['fst_month']){
                          if($incListCountk > 0){
                         
                           echo number_format($incListResk['lnm1']);  
                           $sum_lnmpv = $sum_lnmpv + $incListResk['lnm1'];
                         }
                         else{
                          echo 'No data';
                         }
                         }
                         else if(!isset($_POST['tbl2_filter_month']) && $incListCountk > 0 ){
                          if($incListCountk > 0){
                           echo number_format($incListResk['lnm1']);  
                            $sum_lnmpv = $sum_lnmpv + $incListResk['lnm1'];
                          }
                          else{
                          echo 'No data';
                         }
                         }
                         else{
                        echo   "No Prev. Data";
                         } ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['staff_mobilize']); 
                        $sum_sm = $sum_sm + $incListRes1['staff_mobilize'];?></td>
                        <td style="vertical-align: middle; text-align:center;"> <a href="hr_update_form.php?tbl2id=<?php echo  $incListRes1['id'] ?>"> EDIT</a></td>
                       <td style="vertical-align: middle; text-align:center; tex"> <a  href="hr.php?sts_tbl2id=<?php echo  $incListRes1['id'] ?>"> Delete</a></td> 
                        
                      </tr>
                    <?php }} else{ echo "<pre><h5><center>"."NO RECORD FOUND" ."</center></h5></pre>";} ?>
                     
                  </tbody>
                  <tbody>
                        <th>
                        Total SUM
                        </th>
                         <th style="vertical-align: middle; text-align:center;"> 
                          <?php echo $sum_bop; ?>
                        </th>
                         <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_lnm;?>
                       </th>
                        <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_lnmpv;?>
                       </th>
                        <th style="vertical-align: middle; text-align:center;">
                         <?php echo  $sum_sm;?>
                       </th>
                       
                    </tbody>
                </table>
              </div>
             
              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
            </div>
          </div>
            <!--- tbl2-->

          <!--- tbl3-->
         <!--  <div class="row">
            <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #336992; color: white; ">
                <h3 class="card-title"><bold>Total Positions: The current status as of Mar’23</bold></h3>

              
              </div>
             
             
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead id="th">
                    <tr>
                      <th style="vertical-align: middle; text-align:center;" id="th">Country</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Head Position</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Male</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Female</th>
                      <th style="vertical-align: middle; text-align:center;" id="th">Attrition</th>
                     
                       <th style="vertical-align: middle; text-align:center;" id="th">Update</th>


                     
                    </tr>
                  </thead>
                  <tbody>
                   <?php if($con){
                        $incListQuery  = "SELECT * FROM `hr_total_pos` WHERE month = (SELECT MAX(month) FROM hr_total_pos)
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes1 = mysqli_fetch_assoc($incListResult)){
                         ?>
                   
                     <tr>
                        <td><?php echo $incListRes1['country']; ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['headcount']); ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['male']); ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['female']); ?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo number_format($incListRes1['attrition']); ?></td>
                        <td style="vertical-align: middle; text-align:center;"> <a href="hr_update_form.php?tbl3id=<?php echo  $incListRes1['id'] ?>"> EDIT</a></td>
                        
                      </tr>
                    <?php }} ?>
                     
                  </tbody>
                </table>
              </div>
             
            </div>
           
            </div>
          </div>  -->
          <!-- tbl3-->
       
      </div>
    </section>

     


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

</body>
</html>
