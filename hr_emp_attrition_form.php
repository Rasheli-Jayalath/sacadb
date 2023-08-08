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
########### add hr Attrition #######
echo $query = "Insert  into `hr_emp_attrition` SET 
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
                        if($_REQUEST['last_month'] == '12'){
                          while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['id']; ?>" 
                          
                            ><?php echo $incListRes['name']; ?></option>
                           <?php $i ++;
                          } 
                        }
                        else{
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option <?php if(isset($_REQUEST['last_country']) && $_REQUEST['last_country'] == $incListRes['id']){ echo "selected";} ?> value="<?php echo $incListRes['id']; ?>" 
                          
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
                 <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month'] == '12'){?>
                 <input type="text"  name="opening_head_count" class="form-control" id="opening_head_count" onkeyup="sum();" > 
                 <?php } 
                 else if(!isset($_REQUEST['last_month']) ){ ?>
                <input type="text" name="opening_head_count" value="" class="form-control" id="opening_head_count" onkeyup="sum();" >
                <?php } 
                else if(isset($_REQUEST['last_month']) ){ ?>
                <input type="text" name="opening_head_count" value="<?php 
                if(isset($_REQUEST['last_total_head_count'])){ echo $_REQUEST['last_total_head_count']; }?>" <?php if(isset($_REQUEST['last_total_head_count'])){ echo "readonly"; } ?> class="form-control" id="opening_head_count" onkeyup="sum();" >
                <?php } ?>
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
                      <option readonly value="1" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month'] == '12' ){ echo "selected"; }  ?> >January</option>
                      <option readonly value="2" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '2' ){ echo "selected"; }  ?>>February</option>
                      <option readonly value="3" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '3' ){ echo "selected"; }  ?>>March</option>
                      <option readonly value="4" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '4' ){ echo "selected"; }  ?>>April</option>
                      <option readonly value="5" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '5' ){ echo "selected"; }  ?>>May</option>
                      <option readonly value="6" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '6' ){ echo "selected"; }  ?>>June</option>
                      <option readonly value="7" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '7' ){ echo "selected"; }  ?>>July</option>
                      <option readonly value="8" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '8' ){ echo "selected"; }  ?>>August</option>
                      <option readonly value="9" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '9' ){ echo "selected"; }  ?>>September</option>
                      <option readonly value="10" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '10' ){ echo "selected"; }  ?>>October</option>
                      <option readonly value="11" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '11' ){ echo "selected"; }  ?>>November </option>
                      <option readonly value="12" <?php if(isset($_REQUEST['last_month']) && $_REQUEST['last_month']+1 == '12' ){ echo "selected"; }  ?>>December</option>
                    </select>
                  </div>
                  <div class="form-group">
                  <label for="exampleInputPassword1">Year</label>
                   <select name="year" id="year" class="form-control" required="">
                    <option readonly value="">Select Year</option>
                    <option value="2022" <?php if(isset($_REQUEST['last_year']) && $_REQUEST['last_year'] == '2022' && $_REQUEST['last_month'] != '12' ){ echo "selected"; }  ?>>2022</option>
                    <option readonly value="2023" <?php if(isset($_REQUEST['last_year']) && $_REQUEST['last_year'] == '2023' && $_REQUEST['last_month'] != '12' ){ echo "selected"; }  ?>>2023</option>

                     <option readonly value="2024" <?php if(isset($_REQUEST['last_year']) && $_REQUEST['last_year'] == '2024' && $_REQUEST['last_month'] != '12'){ echo "selected"; }  ?>>2024</option>

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
