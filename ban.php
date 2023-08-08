<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($bd_dashboard==0)
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
             <iframe  scrolling="no" frameBorder="0" height="1000" width="1280" src="https://sacaapps.com:2053/Oppurtunity_ban/qrdash-home.php"> </iframe> 
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
   
  

  <!-- Control Sidebar -->
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
