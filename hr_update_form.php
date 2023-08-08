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

######### edit tbl1  ###########
//print_r($_REQUEST);
if(isset($_REQUEST['pos_incurr_rev_loss']) &&  $_REQUEST['tbl1id']){
 $tbl1id = $_REQUEST['tbl1id'] ;

$bill_open_pos = $_REQUEST['bill_open_pos'];
$pos_incurr_rev_loss = $_REQUEST['pos_incurr_rev_loss'];
$loss_non_mobilize = $_REQUEST['loss_non_mobilize'];
$bill_staff_mobilize = $_REQUEST['bill_staff_mobilize'];


echo $query = "UPDATE `hr_int_pos` SET 

`bill_open_pos`='$bill_open_pos',
`pos_incurr_rev_loss`='$pos_incurr_rev_loss',
`loss_non_mobilize`='$loss_non_mobilize',
`bill_staff_mobilize`='$bill_staff_mobilize'

WHERE  id = '$tbl1id'";
$qry_fcn = mysqli_query($con,$query); 
header('location:hr_int_loc_pos.php');
}
######### edit tbl1  ###########
######### edit tbl2  ###########
if(isset($_REQUEST['staff_mobilize']) &&  isset($_REQUEST['tbl2id'])){
 $tbl2id = $_REQUEST['tbl2id'] ;

$bill_open_pos = $_REQUEST['bill_open_pos'];
$loss_non_mobilize = $_REQUEST['loss_non_mobilize'];
$staff_mobilize = $_REQUEST['staff_mobilize'];


echo $query = "UPDATE `hr_loc_pos` SET 

`bill_open_pos`='$bill_open_pos',
`loss_non_mobilize`='$loss_non_mobilize',
`staff_mobilize`='$staff_mobilize'

WHERE  id = '$tbl2id'";
$qry_fcn = mysqli_query($con,$query);
header('location:hr_int_loc_pos.php');
}
######### edit tbl2  ###########
##########ADD tbl1 ###########
if(isset($_REQUEST['pos_incurr_rev_loss']) &&  $_REQUEST['addtbl1']){
 $addtbl1 = $_REQUEST['addtbl1'] ;
 $country = $_REQUEST['country'];
$bill_open_pos = $_REQUEST['bill_open_pos'];
$pos_incurr_rev_loss = $_REQUEST['pos_incurr_rev_loss'];
$loss_non_mobilize = $_REQUEST['loss_non_mobilize'];
$bill_staff_mobilize = $_REQUEST['bill_staff_mobilize'];
$month = $_REQUEST['month'];
$year1 = $_REQUEST['year1'];

echo $query = "Insert  into `hr_int_pos` SET 
`country`='$country',
`bill_open_pos`='$bill_open_pos',
`pos_incurr_rev_loss`='$pos_incurr_rev_loss',
`loss_non_mobilize`='$loss_non_mobilize',
`bill_staff_mobilize`='$bill_staff_mobilize',
`month`='$month',
`year1`='$year1'

";
$qry_fcn = mysqli_query($con,$query);
header('location:hr_int_loc_pos.php');
}
##########ADD tbl1 ###########
##########ADD tbl2 ##########
if(isset($_REQUEST['staff_mobilize']) &&  $_REQUEST['addtbl2']){
 $addtbl1 = $_REQUEST['addtbl2'] ;
 $country = $_REQUEST['country'];
$bill_open_pos = $_REQUEST['bill_open_pos'];
$loss_non_mobilize = $_REQUEST['loss_non_mobilize'];
$staff_mobilize = $_REQUEST['staff_mobilize'];
$month = $_REQUEST['month'];
$year1 = $_REQUEST['year1'];

echo $query = "Insert  into `hr_loc_pos` SET 
`country`='$country',
`bill_open_pos`='$bill_open_pos',
`loss_non_mobilize`='$loss_non_mobilize',
`staff_mobilize`='$staff_mobilize',
`month`='$month',
`year1`='$year1'

";
$qry_fcn = mysqli_query($con,$query);
header('location:hr_int_loc_pos.php');
}
##########ADD tbl2 ##########
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
       
          <div class="col-md-6">
          <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item" style="font-weight:bold"><a href="hr_int_loc_pos.php">Back</a></li>
             
            </ol>
             <!--edit form tbl1id-->
            <?php if(isset($_REQUEST['tbl1id'])){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">International Positions: The current status as of Mar’23
                </h3>
                </div>
                <?php $tblid_1 = $_REQUEST['tbl1id']?>
                <form action="" method="get">
                <div class="card-body">
                 <?php if($con){
                          $incListQuery  = "SELECT *
                                           FROM hr_int_pos WHERE id = '".$tblid_1."'
                                          ";   
                      }          
                      $incListResult = mysqli_query($con,$incListQuery);
                      $incListCount  = mysqli_num_rows($incListResult);
                     
                      if($incListCount > 0){
                        // $array_month = array();
                          while($incListRes = mysqli_fetch_assoc($incListResult)){
                            // $array_month['month'] = $incListRes['month'];
                           ?>
                <div class="form-group">
                  <input type="hidden"  name="tbl1id" value="<?php echo $_REQUEST['tbl1id'];?>">
                <label for="exampleInputEmail1">Country</label>
                  <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incResult = mysqli_query($con,$incQuery);
                    $incCount  = mysqli_num_rows($incResult);
                    $resArrayData  = array();
                    if($incCount > 0){
                      $i= 1;
                        while($incRes = mysqli_fetch_assoc($incResult)){?>
                           <option value="<?php echo $incRes['cname']; ?>" disabled
                          <?php if($incRes['cname'] == $incListRes['country']){ echo "selected";} ?>
                            ><?php echo $incRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Live Billable Open Positions (FY’23)</label>
                <input type="text" name="bill_open_pos" value="<?php echo  $incListRes['bill_open_pos']; ?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Positions Incurring Revenue Loss(FY’23)</label>
                <input type="text" class="form-control" name="pos_incurr_rev_loss" value="<?php echo  $incListRes['pos_incurr_rev_loss']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Loss due to Non mobilization(AUD)</label>
                <input type="text" class="form-control" name="bill_staff_mobilize" value="<?php echo  $incListRes['bill_staff_mobilize']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Billable Staff mobilized(FY’23)</label>
                <input type="text" name="loss_non_mobilize" value="<?php echo  $incListRes['loss_non_mobilize']; ?>" class="form-control" id="exampleInputPassword1" >
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                    <option value="">Select month</option>
                    <option value="1"  <?php if($incListRes['month'] == '1'){ echo "selected";} ?> disabled>January</option>
                    <option value="2"  <?php if($incListRes['month'] == '2'){ echo "selected";} ?> disabled>February</option>
                    <option value="3"  <?php if($incListRes['month'] == '3'){ echo "selected";} ?> disabled>March</option>
                    <option value="4"  <?php if($incListRes['month'] == '4'){ echo "selected";} ?> disabled>April</option>
                    <option value="5"  <?php if($incListRes['month'] == '5'){ echo "selected";} ?> disabled>May</option>
                    <option value="6"  <?php if($incListRes['month'] == '6'){ echo "selected";} ?> disabled>June</option>
                    <option value="7"  <?php if($incListRes['month'] == '7'){ echo "selected";} ?> disabled>July</option>
                    <option value="8"  <?php if($incListRes['month'] == '8'){ echo "selected";} ?> disabled>August</option>
                    <option value="9"  <?php if($incListRes['month'] == '9'){ echo "selected";} ?> disabled>September</option>
                    <option value="10"  <?php if($incListRes['month'] == '10'){ echo "selected";} ?> disabled>October</option>
                    <option value="11"  <?php if($incListRes['month'] == '11'){ echo "selected";} ?> disabled>November </option>
                    <option value="12"  <?php if($incListRes['month'] == '12'){ echo "selected";} ?> disabled>December</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                 <option value="2022" <?php if($incListRes['year1'] == '2022'){ echo "selected";} ?> disabled>2022</option>
                  <option value="2023" <?php if($incListRes['year1'] == '2023'){ echo "selected";} ?> disabled>2023</option>
                </select>
                </div>
                <?php }}?>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
                </form>
              </div>
              <?php }?>
              <!--edit formtbl1id-->
              <!--edit form tbl2id-->
               <?php if(isset($_REQUEST['tbl2id'])){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Local Positions: The current status as of Mar’23</h3>
                </div>
                <?php $tblid_2 = $_REQUEST['tbl2id']?>
                <form action="" method="get">
                <div class="card-body">
                 <?php if($con){
                          $incListQuery  = "SELECT *
                                           FROM hr_loc_pos WHERE id = '".$tblid_2."'
                                          ";   
                      }          
                      $incListResult = mysqli_query($con,$incListQuery);
                      $incListCount  = mysqli_num_rows($incListResult);
                      $resArrayData  = array();
                      if($incListCount > 0){
                          while($incListRes = mysqli_fetch_assoc($incListResult)){
                           ?>
                <div class="form-group">
                  <input type="hidden"  name="tbl2id" value="<?php echo $_REQUEST['tbl2id'];?>">
                <label for="exampleInputEmail1">Country</label>
                
                 <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incResult = mysqli_query($con,$incQuery);
                    $incCount  = mysqli_num_rows($incResult);
                    $resArrayData  = array();
                    if($incCount > 0){
                      $i= 1;
                        while($incRes = mysqli_fetch_assoc($incResult)){?>
                           <option value="<?php echo $incRes['cname']; ?> "disabled 
                          <?php if($incRes['cname'] == $incListRes['country']){ echo "selected";} ?>
                            ><?php echo $incRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Live Billable Open Positions (FY’23)</label>
                <input type="text" name="bill_open_pos" value="<?php echo  $incListRes['bill_open_pos']; ?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Loss due to Non mobilization(In AUD)</label>
                <input type="text" class="form-control" name="loss_non_mobilize" value="<?php echo  $incListRes['loss_non_mobilize']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Staff Mobilized(FY’23)</label>
                <input type="text" class="form-control" name="staff_mobilize" value="<?php echo  $incListRes['staff_mobilize']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                     <option value="">Select month</option>
                    <option value="1"  <?php if($incListRes['month'] == '1'){ echo "selected";} ?> disabled>January</option>
                    <option value="2"  <?php if($incListRes['month'] == '2'){ echo "selected";} ?> disabled>February</option>
                    <option value="3"  <?php if($incListRes['month'] == '3'){ echo "selected";} ?> disabled>March</option>
                    <option value="4"  <?php if($incListRes['month'] == '4'){ echo "selected";} ?> disabled>April</option>
                    <option value="5"  <?php if($incListRes['month'] == '5'){ echo "selected";} ?> disabled>May</option>
                    <option value="6"  <?php if($incListRes['month'] == '6'){ echo "selected";} ?> disabled>June</option>
                    <option value="7"  <?php if($incListRes['month'] == '7'){ echo "selected";} ?> disabled>July</option>
                    <option value="8"  <?php if($incListRes['month'] == '8'){ echo "selected";} ?> disabled>August</option>
                    <option value="9"  <?php if($incListRes['month'] == '9'){ echo "selected";} ?> disabled>September</option>
                    <option value="10"  <?php if($incListRes['month'] == '10'){ echo "selected";} ?> disabled>October</option>
                    <option value="11"  <?php if($incListRes['month'] == '11'){ echo "selected";} ?> disabled>November </option>
                    <option value="12"  <?php if($incListRes['month'] == '12'){ echo "selected";} ?> disabled>December</option>
                 
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                  <option value="2022" <?php if($incListRes['year1'] == '2022'){ echo "selected";} ?>>2022</option>
                  <option value="2023" <?php if($incListRes['year1'] == '2023'){ echo "selected";} ?>>2023</option>
                </select>
                </div>
                <?php }}?>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
                </form>
              </div>
              <?php }?>
               <!--edit form tbl2id-->
               <!--tbl 3-->
               <?php if(isset($_REQUEST['tbl3id'])){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Total Positions: The current status as of Mar’23</h3>
                </div>
                <?php $tblid_3 = $_REQUEST['tbl3id']?>
                <form action="" method="get">
                <div class="card-body">
                 <?php if($con){
                          $incListQuery  = "SELECT *
                                           FROM hr_total_pos WHERE id = '".$tblid_3."'
                                          ";   
                      }          
                      $incListResult = mysqli_query($con,$incListQuery);
                      $incListCount  = mysqli_num_rows($incListResult);
                      $resArrayData  = array();
                      if($incListCount > 0){
                          while($incListRes = mysqli_fetch_assoc($incListResult)){
                           ?>
                <div class="form-group">
                  <input type="hidden"  name="tbl3id" value="<?php echo $_REQUEST['tbl3id'];?>">
                <label for="exampleInputEmail1">Country</label>
                 <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incResult = mysqli_query($con,$incQuery);
                    $incCount  = mysqli_num_rows($incResult);
                    $resArrayData  = array();
                    if($incCount > 0){
                      $i= 1;
                        while($incRes = mysqli_fetch_assoc($incResult)){?>
                           <option value="<?php echo $incRes['cname']; ?>" 
                          <?php if($incRes['cname'] == $incListRes['country']){ echo "selected";} ?>
                            ><?php echo $incRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Head Count</label>
                <input type="text" name="headcount" value="<?php echo  $incListRes['headcount']; ?>" class="form-control" id="exampleInputPassword1" >
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Male</label>
                <input type="text" name="male" value="<?php echo  $incListRes['male']; ?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Famale</label>
                <input type="text" class="form-control" name="famale" value="<?php echo  $incListRes['female']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Attrition</label>
                <input type="text" class="form-control" name="attrition" value="<?php echo  $incListRes['attrition']; ?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                     <option value="">Select month</option>
                    <option value="1"  <?php if($incListRes['month'] == '1'){ echo "selected";} ?>>January</option>
                    <option value="2"  <?php if($incListRes['month'] == '2'){ echo "selected";} ?>>February</option>
                    <option value="3"  <?php if($incListRes['month'] == '3'){ echo "selected";} ?>>March</option>
                    <option value="4"  <?php if($incListRes['month'] == '4'){ echo "selected";} ?>>April</option>
                    <option value="5"  <?php if($incListRes['month'] == '5'){ echo "selected";} ?>>May</option>
                    <option value="6"  <?php if($incListRes['month'] == '6'){ echo "selected";} ?>>June</option>
                    <option value="7"  <?php if($incListRes['month'] == '7'){ echo "selected";} ?>>July</option>
                    <option value="8"  <?php if($incListRes['month'] == '8'){ echo "selected";} ?>>August</option>
                    <option value="9"  <?php if($incListRes['month'] == '9'){ echo "selected";} ?>>September</option>
                    <option value="10"  <?php if($incListRes['month'] == '10'){ echo "selected";} ?>>October</option>
                    <option value="11"  <?php if($incListRes['month'] == '11'){ echo "selected";} ?>>November </option>
                    <option value="12"  <?php if($incListRes['month'] == '12'){ echo "selected";} ?>>December</option>
                 
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                  <option value="2022" <?php if($incListRes['year1'] == '2022'){ echo "selected";} ?>>2022</option>
                  <option value="2023" <?php if($incListRes['year1'] == '2023'){ echo "selected";} ?>>2023</option>
                </select>
                </div>
                <?php }}?>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
                </form>
              </div>
              <?php }?>
               <!--tbl 3-->
               <!--edit form-->
              <!--add form addtbl1-->
                 <?php if(isset($_REQUEST['addtbl1']) && $_REQUEST['addtbl1'] == 'int'){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">International Positions: The current status as of Mar’23</h3>
                </div>
                <form action="" method="get">
                <div class="card-body">
                
                <div class="form-group">
                <input type="hidden"  name="addtbl1" value="<?php echo $_REQUEST['addtbl1'];?>"> 
                <label for="exampleInputEmail1">Country</label>
               <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['cname']; ?>" 
                          
                            ><?php echo $incListRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Live Billable Open Positions (FY’23)</label>
                <input type="text" name="bill_open_pos"  class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Positions Incurring Revenue Loss(FY’23)</label>
                <input type="text" class="form-control" name="pos_incurr_rev_loss"  id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Loss due to Non mobilization(AUD)</label>
                <input type="text" class="form-control" name="bill_staff_mobilize" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Billable Staff mobilized(FY’23)</label>
                <input type="text" name="loss_non_mobilize"  class="form-control" id="exampleInputPassword1" >
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                    <option value="">Select month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11 ">November </option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
                </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">ADD</button>
                </div>
                </form>
              </div>
              <?php }?>
              <!--add form addtbl1-->
              <!--add form addtbl2-->
               <?php if(isset($_REQUEST['addtbl2']) && $_REQUEST['addtbl2']== 'lcl'){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Local Positions: The current status as of Mar’23</h3>
                </div>
               
                <form action="" method="get">
                <div class="card-body">
                 <input type="hidden"  name="addtbl2" value="<?php echo $_REQUEST['addtbl2'];?>"> 
                <div class="form-group">
                
                <label for="exampleInputEmail1">Country</label>
               <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['cname']; ?>"
                            ><?php echo $incListRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Live Billable Open Positions (FY’23)</label>
                <input type="text" name="bill_open_pos" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Loss due to Non mobilization(In AUD)</label>
                <input type="text" class="form-control" name="loss_non_mobilize"  id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Staff Mobilized(FY’23)</label>
                <input type="text" class="form-control" name="staff_mobilize" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                    <option value="">Select month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11 ">November </option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
                </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">ADD</button>
                </div>
                </form>
              </div>
              <?php }?>
              <!--add form addtbl2-->
               <!--add form addtbl3-->
               <?php if(isset($_REQUEST['addtbl3']) && $_REQUEST['addtbl3']== 'total'){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Total Positions: The current status as of Mar’23</h3>
                </div>
               
                <form action="" method="get">
                <div class="card-body">
                 <input type="hidden"  name="addtbl3" value="<?php echo $_REQUEST['addtbl3'];?>"> 
                <div class="form-group">
                
                <label for="exampleInputEmail1">Country</label>
               <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT *
                                  FROM ds003country  GROUP BY cname";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['cname']; ?>"
                            ><?php echo $incListRes['cname']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Head Count</label>
                <input type="text" name="headcount" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Male</label>
                <input type="text" class="form-control" name="male"  id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Female</label>
                <input type="text" class="form-control" name="female" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Attrition</label>
                <input type="text" class="form-control" name="female" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Month</label>
                  <select name="month" id="month" class="form-control" required>
                    <option value="">Select month</option>
                    <option value="1">January</option>
                    <option value="2">February</option>
                    <option value="3">March</option>
                    <option value="4">April</option>
                    <option value="5">May</option>
                    <option value="6">June</option>
                    <option value="7">July</option>
                    <option value="8">August</option>
                    <option value="9">September</option>
                    <option value="10">October</option>
                    <option value="11 ">November </option>
                    <option value="12">December</option>
                  </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Year</label>
                 <select name="year1" id="year1" class="form-control" required="">
                  <option value="">Select Year</option>
                  <option value="2022">2022</option>
                  <option value="2023">2023</option>
                </select>
                </div>
                </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">ADD</button>
                </div>
                </form>
              </div>
              <?php }?>
              <!--add form addtbl2-->
              <!-- add form-->
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


</body>
</html>
