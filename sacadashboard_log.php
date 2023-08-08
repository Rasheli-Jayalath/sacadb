<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($user_type!=1)
{
header("Location:index.php");	
}
include("saveurl.php");


$datesel = $_REQUEST[ 'dateselect' ];
$fulldatesel = $_REQUEST[ 'dateselect1' ];
//echo "<br>fulldateflag".$fulldate_flag = $_REQUEST['d1'];
$userselected = $_REQUEST[ 'userselect' ];
$usernameselected = $_REQUEST[ 'user_name' ];

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
  <title>SACA DASHBOARD - Site Visits</title>

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


  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="col-sm-12" id="title_div">
        <h1 style="text-align:center;font-size:1.5em;" >SACA Dashboard Log</h1>
      </div>
    </div>
    <!-- /.container-fluid --> 
  </section>
  
  <div class="card" id="card_update">
    <div class="card-header" id="card_header-abcd">
      <h3 class="card-title"><?php echo "Users login";?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" id="card_body">
      <table id="example1" class="table table-bordered table-striped">
        <thead id="th-abcd">
          <tr>
            <th id="th-abcd" width="10%">Sr%</th>
            <th id="th-abcd" width="70%">User Name</th>
            <!--<th id="th-abcd">Date</th>-->
            <th id="th-abcd" width="20%">Number of times login</th>
          </tr>
        </thead>
        <tbody>
          <?php


        $sql1 = "select DISTINCT user_id, epname from tbluserlog_saca where url_capture=''";

          $result = mysqli_query($con, $sql1 );
            $piCount = mysqli_num_rows($result);
           if($piCount>0)
           {
               $i=0;
          while ( $data = mysqli_fetch_array( $result ) ) {
              $i=$i+1;
            $user_id  		= $data['user_id'];
            $epname  		= $data['epname'];
			$prSQL_w = "select count(user_id) as num_of_login from tbluserlog_saca where user_id=".$user_id." and url_capture=''";
        	$queryres_w=mysqli_query( $con, $prSQL_w);
        	$pres =  mysqli_fetch_array($queryres_w);
			$num_of_login=$pres['num_of_login'];		
			//$prSQL_n = "select first_name, last_name from mis_tbl_users where user_cd=".$user_id;
        	//$queryres_n=$objDb2->dbCon->query ($prSQL_n);
			//$abc_result_n= $queryres_n->fetch();
			//$fullname=$abc_result_n['first_name']." ".$abc_result_n['last_name'];
            ?>


           
            
             <tr align="center" >
            <td class="text-dark"><?php echo $i?></td>
            <td class="text-dark"><?php echo $epname?></td>
			
            <td class="text-dark" ><a href="sacalog_detail.php?uno=<?php echo $user_id; ?>" style="text-decoration:none" ><?php echo $num_of_login;?></a></td>
            </tr>
          
          <?php
          }
           }
          ?>
        </tbody>
      </table>
    </div>
    <!-- /.card-body --> 
  </div>


    


    <!-- Main content -->
   
    <!-- /.content -->
  </div>
  
  
  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<<script src="theme/plugins/jquery/jquery.min.js"></script> 
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
	   "order":[[ 0, 'desc' ]], 
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
