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


	$uno	= $_REQUEST['uno'];
  	$sSQL =  " Select count(user_id) as num_login,epname FROM tbluserlog_saca where user_id =".$uno." and  url_capture=''";
   $sSQL1=  mysqli_query($con, $sSQL); 
  $sSQL3=  mysqli_fetch_array($sSQL1);
  $epname=$sSQL3['epname'];
$num_login=$sSQL3['num_login'];

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - User Log Detail</title>

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
        <h1 style="text-align:center;font-size:1.5em;" ><?php echo "Log Details :- &nbsp ".$epname;  ?></h1>
      </div>
    </div>
    <!-- /.container-fluid --> 
  </section>
  
  <div class="card" id="card_update">
    <div class="card-header" id="card_header-abcd">
      <h3 class="card-title"><b>Number of times login: &nbsp </b><?php echo $num_login; ?></h3><span style="float:right;color:white"><a href="sacadashboard_log.php" style="color:white">Back</a></span>
    </div>
    <!-- /.card-header -->
    <div class="card-body" id="card_body">
      <table id="example1" class="table table-bordered table-striped">
        <thead id="th-abcd">
          
          <tr>              
			<th id="th-abcd"  width="5%" >Sr.#</th> 
           
            <th id="th-abcd"  width="10%" >User Name</th>
			 <th  id="th-abcd"   width="10%">Login </th>
          
            <th id="th-abcd"   width="15%" >User IP</th>
            <th  id="th-abcd"   width="15%">User PC Name</th>
            <th  id="th-abcd"   width="35%" >Url Capture</th>
                            </tr>
        </thead>
        <tbody>
          <?php
 		$prSQL_login = "SELECT * FROM tbluserlog_saca where user_id=".$uno. " order by logintime asc";
        $queryres= mysqli_query($con,$prSQL_login);
		$i=0;			
            while($abc_result= mysqli_fetch_array($queryres) )
            {
			$i=$i+1;
            $user_id  		= $abc_result['user_id'];
			 $epname  		= $abc_result['epname'];
			 $logintime  	= $abc_result['logintime'];
          
            $user_ip  		= $abc_result['user_ip'];
            $user_pcname  	= $abc_result['user_pcname'];
            $url_capture 	= $abc_result['url_capture'];
            
			
			
			?>

           
            
             <tr align="center">
            <td ><?=$i?></td>			 
            <td style="text-align:left"><?=$epname?></td>
			<td  width="20%"><?=$logintime?></td>
			<td ><?=$user_ip?></td>
			<td ><?=$user_pcname?></td>
			<td style="max-width: 20px; text-align:left     "> 
      <?php  if ($url_capture=="") {echo '<span style="color: green;" /> <strong>Login Successful!! </strong> </span>';
}
			else if ($url_capture=="Logout") {echo '<span style="color: red;" /> <strong>Logout!! </strong> </span>';
}
			else if (strpos($url_capture, 'http://') === false) {echo '<span style="color:blue;"  style="width: 30px;" /> <strong>'.wordwrap($url_capture  ,10,"<br>\n") .'</strong> </span>';
			}
 else {
     echo '<span   style=" width: 20px; max-width: 20px ; word-wrap: break-word; " /> '.wordwrap($url_capture ,12,"<br>\n") .' </span>'; ;
     } ?></td>
            </tr>
          
          <?php
         
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
      "responsive": true, "pageLength": 40, "autoWidth": false, "order":[[2, 'asc'], [ 0, 'asc' ]], 
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
