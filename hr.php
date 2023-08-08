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
header('location:hr.php');
}
if(isset($_REQUEST['sts_tbl2id'])){
 $tbl1id = $_REQUEST['tbl1id'] ;


echo $query = "UPDATE `hr_loc_pos` SET 

`status`='0'


WHERE  id = '".$_REQUEST['sts_tbl2id']."'
";
$qry_fcn = mysqli_query($con,$query); 
header('location:hr.php');
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
  .lftMar{
    margin-left: 855px;
  }
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
            <button class="btn  btn-primary  float-sm-right" type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_list.php?<?php if(isset($incListRes['total_head_count'])) echo "last_total_head_count=".  $incListRes['total_head_count'].'&'."last_month=".$incListRes['month'].'&'."last_year=".$incListRes['year'].'&'."last_country=".$incListRes['country_id']?>';"><h6>Show All Country Attrition Data</h6>
                  </button>
    </section>

       <div class="col-3 input-group-append pull-right lftMar ">
               <?php 
                        $incListQuery  = "SELECT * FROM `hr_emp_attrition` ORDER BY id DESC 
                                                LIMIT 1 ";
                        $incListResult = mysqli_query($con,$incListQuery);
                        //$incListCount  = mysqli_num_rows($incListResult);
                        $incListRes = mysqli_fetch_assoc($incListResult)
                         ?>

               
                   <!--  <button class="btn  btn-primary  float-sm-right" type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_list.php?<?php if(isset($incListRes['total_head_count'])) echo "last_total_head_count=".  $incListRes['total_head_count'].'&'."last_month=".$incListRes['month'].'&'."last_year=".$incListRes['year'].'&'."last_country=".$incListRes['country_id']?>';"><h6>Show All Country Attrition Data</h6>
                  </button> -->
            </div>


    <section class="content-header">
      <!--saca total attrition -->
       <div class="row">
            <?php
               $qry = "SELECT Distinct(country_id) from hr_emp_attrition group by country_id";
               $qry_result = mysqli_query($con, $qry); 
               $res = mysqli_fetch_assoc($qry_result);
               $cnt_rws = mysqli_num_rows($qry_result);
               if($cnt_rws > 0){
                $c_id = $res['country_id'];
                }
               ?>
              <div class="col-12">
                <div class="card">
                  <div class="card-header" style="background-color: #336992; color: white; ">
                    <h3 class="card-title"><bold>Attrition Positions: SACA DIVISION</bold></h3>
                    
                  </div>
                 <!--  <button type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_form.php?last_total_head_count=<?php echo $currentCountryHeadCount.'&last_month='.$currentCountryMonth.'&last_year='.$currentCountryYear.'&last_country='.$currentCountryCountry;?>';"><h6>Add More data</h6>
                  </button> -->
                   
                <?php
                 $qry = "SELECT * from hr_emp_attrition ";
                 $qry_result = mysqli_query($con, $qry); 
                 $res = mysqli_fetch_assoc($qry_result);
                 $cnt_rws1 = mysqli_num_rows($qry_result);
                 if($cnt_rws1 > 0){
                  $c_id1 = $res['country_id'];
                 ?>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                      <thead id="">
                        <tr>
                          <th>
                             Month & Year 
                          </th>
                              <?php
                              $incListQuery = "SELECT distinct month, year  FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition) ";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                               while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                               <th> <?php  if($incListRes['month'] == '1')echo "Jan"." ".$incListRes['year'];
                                      if($incListRes['month'] == '2')echo "Feb"." ".$incListRes['year'];
                                      if($incListRes['month'] == '3')echo "Mar"." ".$incListRes['year'];
                                      if($incListRes['month'] == '4')echo "Apr"." ".$incListRes['year'];
                                      if($incListRes['month'] == '5')echo "May"." ".$incListRes['year'];
                                      if($incListRes['month'] == '6')echo "June"." ".$incListRes['year'];
                                      if($incListRes['month'] == '7')echo "July"." ".$incListRes['year'];
                                      if($incListRes['month'] == '8')echo "Aug"." ".$incListRes['year'];
                                      if($incListRes['month'] == '9')echo "Sep"." ".$incListRes['year'];
                                      if($incListRes['month'] == '10')echo "Oct"." ".$incListRes['year'];
                                      if($incListRes['month'] == '11')echo "Nov"." ".$incListRes['year'];
                                      if($incListRes['month'] == '12')echo "Dec"." ".$incListRes['year'];
                                       ?></th>
                              <?php }
                              } 
                              ?>
                            <th>
                            Total(YTD)
                            </th>
                        </tr>
                      </thead>
                      <tbody>
                        <th>
                        Employees Left Voluntary
                        </th>
                            <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_vol) as saca_emp_left_vol, emp_left_vol ,year FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <td> <?php echo $incListRes['saca_emp_left_vol'] ; 
                                     $sum_vol = $sum_vol + $incListRes['saca_emp_left_vol'];
                                  } 
                                }
                              }
                            }?>
                        </td>
                         <td><?php if(isset($sum_vol))echo $sum_vol; ?></td>
                       </tbody> 
                       <tbody>
                         <th>
                        Employees Left Involuntary
                        </th>
                          <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_invol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_invol) as saca_emp_left_invol, emp_left_invol ,year FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <td> <?php echo $incListRes['saca_emp_left_invol'] ; 
                                     $sum_invol = $sum_invol + $incListRes['saca_emp_left_invol'];
                                  } 
                                }
                              }
                            }?>
                        </td>
                         <td><?php if(isset($sum_invol))echo $sum_invol; ?></td>
                       </tbody>
                       <tbody>
                         <th>
                        Employees Joined
                        </th>
                           <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_emp_joined = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_joined) as saca_emp_joined, emp_joined ,year FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <td> <?php echo $incListRes['saca_emp_joined'] ; 
                                     $sum_emp_joined = $sum_emp_joined + $incListRes['saca_emp_joined'];
                                  } 
                                }
                              }
                            }?>
                        </td>
                         <td><?php if(isset($sum_emp_joined))echo $sum_emp_joined; ?></td>
                       </tbody>
                       <tbody>
                         <th>
                        Opening Head Count
                        </th>
                          
                           <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                               //$fst_opening_head_count = 0;
                             
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(opening_head_count) as saca_opening_head_count,opening_head_count,year FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )  AND month = '".$uniqueMonth."'  ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                    
                                    while($incListRes = mysqli_fetch_assoc($incListResult)){?> 
                                      <td> <?php echo $incListRes['saca_opening_head_count'] ;
                                     //$fst_opening_head_count =  $incListRes['opening_head_count'];
                                    }
                              }
                            }
                          }?>
                        </td>
                          <td> <?php $ytdFstOpeningHeadQuery = "SELECT opening_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = 1";
                            $ytdFstOpeningHeadResult = mysqli_query($con,$ytdFstOpeningHeadQuery);
                            $ytdFstOpeningHeadCount  = mysqli_num_rows($ytdFstOpeningHeadResult);
                            if($ytdFstOpeningHeadCount > 0){
                              
                              $fst_opening_head_count = 0;
                              while($ytdFstOpeningHeadRes = mysqli_fetch_assoc($ytdFstOpeningHeadResult)){
                                  $fst_opening_head_count =  $fst_opening_head_count + $ytdFstOpeningHeadRes['opening_head_count'];
                                
                                }
                            }  
                             if(isset($fst_opening_head_count)) { echo $fst_opening_head_count;}   ?></td>
                       </tbody>
                       <tbody>
                         <th>
                        Total head count 
                        </th>
                            <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_total_head_count = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(total_head_count) as saca_total_head_count, total_head_count ,year FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <td> <?php echo $incListRes['saca_total_head_count'] ; 
                                     $sum_total_head_count = $sum_total_head_count + $incListRes['saca_total_head_count'];
                                  } 
                                }
                              }
                            }?>
                        </td>
                         <td><?php   
                                   if(isset($sum_emp_joined)&& isset($fst_opening_head_count)&& isset($sum_invol)&& isset($sum_vol)){
                                    $thc1 = $sum_emp_joined + $fst_opening_head_count;
                                   $thc2 = $sum_invol + $sum_vol;
                                 echo  $thc = ($thc1) - ($thc2); } ?> </td>
                       </tbody>
                      </tbody>
                       <tbody>
                        <th>
                        Voluntary Attrition (monthly)
                        </th>
                            <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                             
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_vol) as saca_emp_left_vol, emp_left_vol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <th> <?php $saca_emp_left_vol =  $incListRes['saca_emp_left_vol'];
                                    $saca_total_head_count =  $incListRes['saca_total_head_count'] ;
                                      $monthly_attrition = $saca_emp_left_vol/(($fst_opening_head_count + $saca_total_head_count) /2) ;
                                     echo number_format($monthly_attrition,2).'<bold>%</bold>';

                                  } 
                                }
                              }
                            }?>
                        </th>
                         <th><?php   
                                  if(isset($sum_emp_joined)&& isset($fst_opening_head_count)&& isset($sum_invol)&& isset($sum_vol)){
                                    $thc1 = $sum_emp_joined + $fst_opening_head_count;
                                    $thc2 = $sum_invol + $sum_vol;
                                    $thc = ($thc1) - ($thc2); 
                                    $total_vol_monthly_attrition = $sum_vol/(($fst_opening_head_count + $thc) /2)  ;

                                     echo number_format($total_vol_monthly_attrition,2).'<bold>%</bold>';
                              }?></th>
                       </tbody> 
                        <tbody>
                        <th>
                        Involuntary Attrition (monthly)
                        </th>
                            <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_invol) as saca_emp_left_invol, emp_left_invol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <th> <?php $saca_emp_left_invol =  $incListRes['saca_emp_left_invol'];
                                    $saca_total_head_count =  $incListRes['saca_total_head_count'];
                                      $monthly_attrition1 = $saca_emp_left_invol/(($fst_opening_head_count + $saca_total_head_count) /2) ;
                                     echo number_format($monthly_attrition1,2).'<bold>%</bold>';
                                  } 
                                }
                              }
                            }?>
                        </th>
                       <th><?php   
                                  if(isset($sum_emp_joined)&& isset($fst_opening_head_count)&& isset($sum_invol)&& isset($sum_vol)){
                                    $thc1 = $sum_emp_joined + $fst_opening_head_count;
                                    $thc2 = $sum_invol + $sum_vol;
                                    $thc = ($thc1) - ($thc2); 
                             $total_invol_monthly_attrition = $sum_invol/(($fst_opening_head_count + $thc) /2) ;
                                     echo number_format($total_invol_monthly_attrition,2).'%';
                              }?></th>
                       </tbody> 
                        <tbody>
                        <th>
                        Total Attrition (monthly)
                        </th>
                            <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_invol) as saca_emp_left_invol, sum(emp_left_vol) as saca_emp_left_vol, emp_left_invol ,emp_left_vol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition ) AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <th> <?php $saca_emp_left_invol =  $incListRes['saca_emp_left_invol'];
                                    $saca_total_head_count =  $incListRes['saca_total_head_count'];
                                      $monthly_attrition1 = $saca_emp_left_invol/(($fst_opening_head_count + $saca_total_head_count) /2) ;
                                    
                                        $saca_emp_left_vol =  $incListRes['saca_emp_left_vol'];
                                              //$saca_total_head_count =  $incListRes['saca_total_head_count'] ;
                                        $monthly_attrition = $saca_emp_left_vol/(($fst_opening_head_count + $saca_total_head_count) /2);
                                    
                                       $volInvol =  $monthly_attrition + $monthly_attrition1;
                                       echo  number_format($volInvol,2);
                                  } 
                                }
                              }
                            }?>
                        </th>
                         <th><?php if(isset($total_invol_monthly_attrition)){
                          $sum_vol_invol_total = ($total_invol_monthly_attrition) + ($total_vol_monthly_attrition); 
                        echo  number_format($sum_vol_invol_total,2);}?></th>
                       </tbody> 
                    </table>
                  </div>
                  <?php  }
                  else{
                    echo "<h4><center>No Data Found.</center></h4>";
                  }
                 ?>
                </div>
                <!-- /.card -->
              </div>
            
        </div>
        <!-- saca total attrition-->
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
