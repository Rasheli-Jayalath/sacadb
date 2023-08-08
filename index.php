<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
 if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
include("saveurl.php");
//print_r($_POST);
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
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
   <style>
        .dropbtn {
            background-color: #0056b3;
            color: white;
              width: 200px;
            padding: 12px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            
        }
         .dropbtn1 {
            background-color: #0056b3;
            color: white;
              width: 200px;
            padding: 12px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            
        }
  
        .dropdown {
            position: relative;
            display: inline-block;
            position: absolute;
            top: 4%;
            left: 90%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: px;
            text-align: left;
        }
  
        .dropdown-content {
            display: none;
            position: absolute;
            background-color: #f9f9f9;
            min-width: 160px;
            box-shadow: 0px 8px 16px 
                0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
  
        .dropdown-content a {
            color: black;
            padding: 12px 34px;
            text-decoration: none;
            display: block;
        }
  
        .dropdown-content a:hover {
            background-color: #f1f1f1
        }
  
        .dropdown:hover .dropdown-content {
            display: block;
        }
  
        .dropdown:hover .dropbtn {
            background-color: #3e8e41;
        }
    </style>
    <style>
        .dropbtn2 {
            background-color: #0056b3;
            color: white;
              width: 70px;
            padding: 12px;
            font-size: 16px;
            border: none;
            cursor: pointer;
            
        }
        .dropbtn2  a{
           
            color: white;
            
        }
        .dropdown2 {
            position: relative;
            display: inline-block;
            position: absolute;
            top: 4%;
            left: 78%;
            transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            
            color: white;
            font-size: 16px;
            padding: 12px 24px;
            border: none;
            cursor: pointer;
            border-radius: px;
            text-align: left;
        }
  
        .dropdown-content2 {
            display: none;
            position: absolute;
            background-color: ;
            min-width: 160px;
            box-shadow: 0px 8px 16px 
                0px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }
    </style>
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

    <center>
        <div class="dropdown" width="110%">
          
            <button class="dropbtn" >
                Divisional Management
            </button>
              
            <div class="dropdown-content">
              <a href="../../sacadb/div_organo.php"> 
                   Divisional Structure</a>
              <a href="../../sacadb/it_organo.php"> 
                   IT Structure</a>
              <a href="../../sacadb/hr_organo.php"> 
                   HR Structure</a>
                
            </div>
        </div>
        <!-- <div class="dropdown2" width="80%">
          
          <button class="dropbtn2" >
              <a href="../../sacadb/index.php"> 
                 BACK</a>
          </button>
      </div> -->
    </center>

      <img  src="../../sacadb/theme/dist/img/sb-grp.jpg"
           alt="SACA Logo"  >
        
      </div> 
      
     
      <!-- /.card-body -->
    </div>
    <!-- Main content -->
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
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

</body>
</html>
