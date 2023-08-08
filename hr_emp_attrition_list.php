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
//print_r($_REQUEST);?>
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
  .th{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#79a9ce;
  color:Black;}
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
   <section class="content-header">  
           <!--  <button class="btn  btn-primary  float-sm-right" type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_list.php?<?php if(isset($incListRes['total_head_count'])) echo "last_total_head_count=".  $incListRes['total_head_count'].'&'."last_month=".$incListRes['month'].'&'."last_year=".$incListRes['year'].'&'."last_country=".$incListRes['country_id']?>';"><h6>Show All Country Attrition Data</h6>
                  </button> -->
    </section>
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
       <section class="content">
            <button class="btn  btn-primary  float-sm-right" type="button" type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_add.php?<?php if(isset($incListRes['total_head_count'])) echo "last_total_head_count=".  $incListRes['total_head_count'].'&'."last_month=".$incListRes['month'].'&'."last_year=".$incListRes['year'].'&'."last_country=".$incListRes['country_id']?>';"><h6>Add New Country Attrition data</h6>
                  </button> 
    </section>
    <br>
      <section class="content">
        <div style="color: red;"><?php if(isset($_REQUEST['msz']) && $_REQUEST['msz'] == 'countryAdded') echo "<center>This country already added.</center>" ?></div>
        <div class="container-fluid">
          <div class="card-tools">
            <div class="col-4 input-group-append "><a href="hr.php"> <img height="40" width="40" src="../../sacadb/theme/dist/img/back3.png"></a>
               <?php 
                        $incListQuery  = "SELECT * FROM `hr_emp_attrition` ORDER BY id DESC 
                                                LIMIT 1 ";
                        $incListResult = mysqli_query($con,$incListQuery);
                        //$incListCount  = mysqli_num_rows($incListResult);
                        $incListRes = mysqli_fetch_assoc($incListResult)
                         ?>

                
               
                 
            </div>
          </div>
            <div class="row">
              <div class="card-header">
                <form method="post" action="" >
                   <?php 
                     if($con){
                          $incListQuery  = "SELECT *
                                    FROM hr_country_list  GROUP BY name";
                      }          
                      $incListResult = mysqli_query($con,$incListQuery);
                      $incListCount  = mysqli_num_rows($incListResult);?>
                  <!--  <select name="filter_country" class="custom-select" onchange="this.form.submit();">
                         <option>SELECT COUNTRY</option>
                   <?php  while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                             <option value="<?php echo $incListRes['id']; ?>"> 
                              <?php echo $incListRes['name']; ?></option>
                          <?php   } ?>
                   </select> -->
                 </form>
                </div>
               
               <?php
               $qry = "SELECT Distinct(country_id) from hr_emp_attrition group by country_id";
               $qry_result = mysqli_query($con, $qry); 
               while($res = mysqli_fetch_assoc($qry_result)){
                $c_id = $res['country_id'];
                $incListSingalQuery  = "SELECT * FROM hr_emp_attrition 
                                    WHERE year = (SELECT MAX(year) FROM hr_emp_attrition WHERE country_id = '".$c_id."') 
                                    AND  month = (
                                            SELECT MAX(month) 
                                            FROM hr_emp_attrition 
                                            WHERE year = (
                                                SELECT MAX(year) FROM hr_emp_attrition WHERE country_id = '".$c_id."'
                                            ) and country_id = '".$c_id."'
                                        )
                                    AND country_id = '".$c_id."'";
                $incListSingalResult = mysqli_query($con,$incListSingalQuery);
                $incListSingalCount  = mysqli_num_rows($incListSingalResult);
                $currentCountryCountry = 0;
                $currentCountryYear  = 0;
                $currentCountryMonth = 0;
                $currentCountryHeadCount = 0;
                if($incListSingalCount){
                  $incListSingalRes = mysqli_fetch_assoc($incListSingalResult);
                  $currentCountryCountry = $incListSingalRes['country_id'];
                  $currentCountryYear  = $incListSingalRes['year'];
                  $currentCountryMonth = $incListSingalRes['month'];
                  $currentCountryHeadCount = $incListSingalRes['total_head_count'];
                }
               ?>
              <div class="col-12">
                <div class="card">
                  <div class="card-header" style="background-color: #336992; color: white; ">
                    <h3 class="card-title"><bold>Attrition Positions:<?php if($c_id == '1') echo " ". "Bangladesh"; if($c_id == '2') echo " ". "CAR"; if($c_id == '3') echo " ". "India"; if($c_id == '4') echo " ". "Nepal"; if($c_id == '5') echo " ". "Pakistan"; if($c_id == '6') echo " ". "Sri Lanka"; ?></bold></h3>
                    
                  </div>
                  <button type="button" style="margin-right: :20px;margin-bottom:20px;" class="btn btn-block btn-primary btn-sm" onclick="location.href='hr_emp_attrition_form.php?last_total_head_count=<?php echo $currentCountryHeadCount.'&last_month='.$currentCountryMonth.'&last_year='.$currentCountryYear.'&last_country='.$currentCountryCountry;?>';"><h6>Add More data</h6>
                  </button>
                  <div class="card-body table-responsive p-0">
                    <table class="table table-head-fixed text-nowrap">
                      <thead id="th">
                        <tr>
                          <th>
                             Month & Year 
                          </th>
                              <?php
                              $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
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
                            $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                                 $sum_vol = 0;
                               while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                        <td> <?php echo $incListRes['emp_left_vol'] ; 
                              $sum_vol = $sum_vol + $incListRes['emp_left_vol'];
                           }}?>
                        </td>
                         <td><?php if(isset($sum_vol))echo $sum_vol; ?>
                       </tbody> 
                       <tbody>
                         <th>
                        Employees Left Involuntary
                        </th>
                            <?php
                             $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                                $i=1;
                                $sum_invol = 0;
                               while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                        <td> <?php echo $incListRes['emp_left_invol'] ;
                                 $sum_invol = $sum_invol + $incListRes['emp_left_invol'];
                                $i++;} } ?>
                        </td>
                        <td><?php echo $sum_invol; ?>
                        </td>
                       </tbody>
                       <tbody>
                         <th>
                        Employees Joined
                        </th>
                            <?php
                            $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                                 $sum_emp_joined = 0;
                               while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                        <td> <?php echo $incListRes['emp_joined'] ; 
                      $sum_emp_joined = $sum_emp_joined + $incListRes['emp_joined'];
                      }}?>
                        </td>
                        <td><?php echo $sum_emp_joined; ?>
                       </tbody>
                       <tbody>
                         <th>
                        Opening Head Count
                        </th>
                            <?php 
                             $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                                $i= 0;
                                //$fst_opening_head_count =   " ";
                               while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                        <td> <?php echo $incListRes['opening_head_count'] ; 
                            if($i == 0){
                              $fst_opening_head_count = $incListRes['opening_head_count'];
                            }$i++;
                           } 
                       }?>
                        </td>
                         <td><?php  if(isset($fst_opening_head_count)) { echo $fst_opening_head_count;} ?>
                       </tbody>
                       <tbody>
                         <th>
                        Total head count 
                        </th>
                            <?php
                             $incListQuery = "SELECT * FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."'";
                                $incListResult = mysqli_query($con,$incListQuery);
                                $incListCount  = mysqli_num_rows($incListResult);
                               if($incListCount > 0){
                               while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                        <td> <?php echo $incListRes['total_head_count'] ; ?>
                          <?php  }}?>
                        </td>
                         <td><?php   $thc1 = $sum_emp_joined + $fst_opening_head_count;
                                  $thc2 = $sum_invol + $sum_vol;
                                 echo  $thc = ($thc1) - ($thc2); ?> </td>
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
                              //$sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_vol) as saca_emp_left_vol, emp_left_vol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."' AND month = '".$uniqueMonth."' ";
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
                                    $total_invol_monthly_attrition = $sum_invol/(($fst_opening_head_count + $thc) /2)  ;

                               echo number_format($total_invol_monthly_attrition,2).'<bold>%</bold>';
                              }?></th>
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
                             // $sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT sum(emp_left_invol) as saca_emp_left_invol, emp_left_invol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."' AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <th> <?php $saca_emp_left_invol =  $incListRes['saca_emp_left_invol'];
                                    $saca_total_head_count =  $incListRes['saca_total_head_count'] ;
                                      $monthly_attrition = $saca_emp_left_invol/(($fst_opening_head_count + $saca_total_head_count) /2 );
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
                        Total Attrition (monthly)1
                        </th>
                           <?php
                            $monthQuery = "SELECT distinct month FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition )";
                            $monthResult = mysqli_query($con,$monthQuery);
                            $monthCount  = mysqli_num_rows($monthResult);
                            if($monthCount > 0){
                              $sum_vol = 0;
                              while($monthListRes = mysqli_fetch_assoc($monthResult)){
                                 $uniqueMonth = $monthListRes['month'];
                                 $incListQuery = "SELECT  sum(emp_left_invol) as saca_emp_left_invol, sum(emp_left_vol) as saca_emp_left_vol, emp_left_invol ,emp_left_vol ,year,sum(total_head_count) as saca_total_head_count FROM hr_emp_attrition WHERE year=(SELECT MAX(year)FROM hr_emp_attrition WHERE country_id = '".$c_id."') and country_id = '".$c_id."' AND month = '".$uniqueMonth."' ";
                                 $incListResult = mysqli_query($con,$incListQuery);
                                 $incListCount  = mysqli_num_rows($incListResult);
                                 if($incListCount > 0){
                                  while($incListRes = mysqli_fetch_assoc($incListResult)){ ?>
                                   <th> <?php $saca_emp_left_invol =  $incListRes['saca_emp_left_invol'];
                                    $saca_total_head_count =  $incListRes['saca_total_head_count'];
                                      $monthly_attrition1 = $saca_emp_left_invol/(($fst_opening_head_count + $saca_total_head_count) /2 );
                                    
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
                      </tbody>
                    </table>
                  </div>
                </div>
                <!-- /.card -->
              </div>
              <?php } ?>


            </div>
             <!--- tbl1-->
           
        </div>
    </section>
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
