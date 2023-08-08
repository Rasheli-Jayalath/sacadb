<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($samepage_log==0)
{
header("Location:index.php");	
}
include("saveurl.php");


$usernameselected = $_REQUEST[ 'user_name' ];
$fulldatesel = $_REQUEST['dateselect1'];

$year = date( 'yY', strtotime( $datesel ) );
$month = date( 'M', strtotime( $datesel ) );


//$currentdate = CURRENT_DATE();

$dateValue = strtotime( $datesel );
$year = date( 'Y', $dateValue );
$monthName = date( 'F', $dateValue );
$monthNo = date( 'm', $dateValue );
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - Visit Detail</title>

 <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
<!-- Font Awesome -->
<link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
<!-- DataTables -->
<link rel="stylesheet" href="theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
<link rel="stylesheet" href="theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
<!-- Theme style -->
<link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
<style>
#main-body {
    font-family: Arial;
    width: inherit;
}
label {
    font-size: 1em;
}
option {
    font-size: 2vh;
}
#th {
    vertical-align: top;
    font-size: 1em;
    text-align: center;
    background-color: #79a9ce;
    color: white;
}
#th-abcd {
    vertical-align: top;
    font-size: 1em;
    text-align: center;
    background-color: #1d3a67;
    color: white;
}

.table td{
   padding:.25rem;
}	
td {
    font-size: 1em;
    text-align: center;
    max-width: 15vh;
}
#card_update {
    margin: .75em 1.25em;
}
#card_body {
    overflow-x: scroll;
    overflow-y: scroll;
}
.badge {
    padding: .75em 1.2em;
    width: 6vh;
}
#report_section {
    padding: 0.75em 1.2em;
}
#card_header {
    font-weight: 500;
    background-color: #79a9ce;
    font-size: 1em;
    color: white;
}
#card_header-abcd {
    font-weight: 500;
    background-color: #1d3a67;
    font-size: 1em;
    color: white;
}
#title_div {
    margin-top: 1vh;
}
#abc {
    overflow-y: auto;
    font-size: 1em;
}
#abcd {
    overflow-y: auto;
    font-size: 1em;
}
#abcg {
    overflow-y: auto;
    font-size: 1em;
}
#report_section_single {
}
.card-body {
    overflow-y: auto;
    font-size: 1.1em;
}
#td-title {
    text-align: left;
    font-size: 1em;
}
#td-title-total {
    font-weight: bold;
    text-align: left;
    font-size: 1em;
}
#td-data {
    font-size: 1em;
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
    <div class="container-fluid">
      <div class="col-sm-12" id="title_div">
        <h1 style="text-align:center;font-size:1.5em;" ><?php echo $usernameselected?></h1>
      </div>
    </div>
    <!-- /.container-fluid --> 
  </section>
  
  <div class="card" id="card_update">
    <div class="card-header" id="card_header-abcd">
      <h3 class="card-title"><?php echo "Visits Detail ";?></h3><span style="float:right;color:white"><a href="site_log.php" style="color:white">Back</a></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body" id="card_body">
      <table id="example1" class="table table-bordered table-striped">
        <thead id="th-abcd">
          <tr>
            <th id="th-abcd" width="30%">User Name</th>
            <th id="th-abcd" width="30%">Email</th>
            <th id="th-abcd" width="20%">Date</th>
            <th id="th-abcd" width="20%">No. of Visits</th>
          </tr>
        </thead>
        <tbody>
          <?php

if ($fulldatesel!="") {
 	$sql1 = "SELECT user_name, email,DATE_FORMAT(user_time_stamp, '%Y-%m-%d') AS year_and_month,COUNT(email) totalCount FROM users_logs WHERE DATE(user_time_stamp) = '$fulldatesel' group by email";
	}
	
 	else if($usernameselected!="") 
	{
         $sql1 = "SELECT user_name, email,DATE_FORMAT(user_time_stamp, '%Y-%m-%d') AS year_and_month,COUNT(email) totalCount FROM users_logs WHERE user_name = '$usernameselected' group by year_and_month order by year_and_month DESC";

	}
		  $result = mysqli_query( $con, $sql1 );
          while ( $data = mysqli_fetch_array( $result ) ) {


            ?>
          <tr>
            <td style="text-align: left">
              <?=$data['user_name']?>
              </td>
            <td style="text-align:left; width:25%"><?php echo $data['email']?></td>
            <td><?php echo $data['year_and_month']?></td>
            <td><?php echo $data['totalCount']?></td>
          </tr>
          <?php
          }
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body --> 
  </div>
</div>
  
  
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="theme/plugins/jquery/jquery.min.js"></script> 
<!-- Bootstrap 4 --> 
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script> 
<!-- DataTables  & Plugins --> 
<script src="theme/plugins/datatables/jquery.dataTables.min.js"></script> 
<script src="theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script> 
<script src="theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script> 
<script src="theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> 
<script src="theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script> 
<script src="theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script> 
<script src="theme/plugins/jszip/jszip.min.js"></script> 
<script src="theme/plugins/pdfmake/pdfmake.min.js"></script> 
<script src="theme/plugins/pdfmake/vfs_fonts.js"></script> 
<script src="theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script> 
<script src="theme/plugins/datatables-buttons/js/buttons.print.min.js"></script> 
<script src="theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script> 
<!-- AdminLTE App --> 
<script src="theme/dist/js/adminlte.min.js"></script> 
<!-- AdminLTE for demo purposes --> 
<script src="theme/dist/js/demo.js"></script> 
<!-- Page specific script --> 
<script>
  $(function () {
    dattable1();
  });
  function dattable1(){
	  $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false, "order":[[2, 'desc'], [ 0, 'asc' ]], 
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	
    $('#example2').DataTable({
      "paging": true,
	  "pageLength": 5,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scroll": false,
    });
	$('#example3').DataTable({
      "paging": true,
	  "pageLength": 5,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scroll": false,
    });
  }
</script>


</body>
</html>
