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
//print_r($_REQUEST);exit;
// if($_REQUEST['country'] && $_REQUEST['year'])
// $get_qry = "SELECT * FROM hr_emp_attrition where country = '".$_REQUEST['country']."' AND year =  '".$_REQUEST['year']."'";

########### add hr Attrition #######
if(isset($_REQUEST['emp_left_vol']) &&  $_REQUEST['total_head_count']){
$country = $_REQUEST['country'];
$emp_left_vol = $_REQUEST['emp_left_vol'];
$emp_left_invol = $_REQUEST['emp_left_invol'];
$emp_joined = $_REQUEST['emp_joined'];
$opening_head_count = $_REQUEST['opening_head_count'];
$total_head_count = $_REQUEST['total_head_count'];
$month = $_REQUEST['month'];
$year = $_REQUEST['year'];
#########
$qryCountryYearChk = "SELECT country_id,year FROM hr_emp_attrition where country_id = '".$country."' AND '".$year."'  ";
$resultCountryYearChk = mysqli_query($con,$qryCountryYearChk);
echo $countCountryYearChk = mysqli_num_rows($resultCountryYearChk);
#########
########### add hr Attrition #######
  if($countCountryYearChk < 1){
  $query = "Insert  into `hr_emp_attrition` SET 
  `country_id`='$country',
  `emp_left_vol`='$emp_left_vol',
  `emp_left_invol`='$emp_left_invol',
  `emp_joined`='$emp_joined',
  `opening_head_count`='$opening_head_count',
  `total_head_count`='$total_head_count',
  `month`='$month',
  `year`='$year'

  ";
  $qry_fcn = mysqli_query($con,$query);
  header('location:hr_emp_attrition_list.php');
  }
  else{
    header('location:hr_emp_attrition_list.php?msz=countryAdded');

  }
}
//print_r($_REQUEST);

######### edit tbl1  ###########

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
             
              <!--add form addtbl1-->
                 <?php if(1 ==1){?>
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Attrition DATA</h3>
                </div>
                <form action="" method="get">
                <div class="card-body">
                
                <div class="form-group">
                <input type="hidden"  name="addtbl1" value="<?php //echo $_REQUEST['addtbl1'];?>"> 
                <label for="exampleInputEmail1">Country</label>
                <select class="form-control" name="country">
                  <option value="">Country</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT *
                                  FROM hr_country_list  GROUP BY name";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        if(1 == 1){
                          while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['id']; ?>" 
                          
                            ><?php echo $incListRes['name']; ?></option>
                           <?php $i ++;
                          } 
                        }
                       
                    }
                    ?>
                 </select>
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Employees Left Voluntary</label>
                <input type="text" name="emp_left_vol"  class="form-control" id="emp_left_vol" onkeyup="sum();" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Employees Left  Involuntary</label>
                <input type="text" class="form-control" name="emp_left_invol"  id="emp_left_invol" onkeyup="sum();" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Employees Joined</label>
                <input type="text" class="form-control" name="emp_joined" id="emp_joined" onkeyup="sum();" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Opening Head Count</label>
                
                <input type="text" name="opening_head_count" value="" class="form-control" id="opening_head_count" onkeyup="sum();" >
                
                </div>
                 <script type="text/javascript">
                  function sum(){
                    //alert('sdfsdg')
                    var val1 = +document.getElementById('emp_left_vol').value;
                    var val2 = +document.getElementById('emp_left_invol').value;
                    var val3 = +document.getElementById('emp_joined').value;
                    var val4 = +document.getElementById('opening_head_count').value;
                    document.getElementById('total_head_count').value = (val4+val3)-(val1+val2);
                    //alert(total_head_count);
                  }     
                </script>
                 <div class="form-group">
                  <?php //$emp_left_vol = 1; ?>
                  <label for="exampleInputPassword1">Total Head Count</label>
                  <input type="text" name="total_head_count"  class="form-control" id="total_head_count" >
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Month</label>
                    <select name="month" id="month" class="form-control" required>
                      <option readonly value="">Select month</option>
                      <option readonly value="1" >January</option>
                      <option readonly value="2">February</option>
                      <option readonly value="3" >March</option>
                      <option readonly value="4" >April</option>
                      <option readonly value="5" >May</option>
                      <option readonly value="6">June</option>
                      <option readonly value="7" >July</option>
                      <option readonly value="8" >August</option>
                      <option readonly value="9" >September</option>
                      <option readonly value="10" >October</option>
                      <option readonly value="11" >November </option>
                      <option readonly value="12" >December</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Year</label>
                   <select name="year" id="year" class="form-control" required="">
                    <option readonly value="">Select Year</option>
                    <option value="2022" >2022</option>
                    <option readonly value="2023" >2023</option>

                     <option readonly value="2024" >2024</option>
                     <option readonly value="2025" >2025</option>

                  </select>
                  </div>
                  </div>
                <div class="card-footer">
                <button type="submit" class="btn btn-primary">ADD</button>
                </div>
                </form>
              </div>
              <?php }?>
             
              <!-- add form-->
          </div>
        </div>
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
