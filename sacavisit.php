<?
include_once( "db.php" );

/*
$uid = $_REQUEST['uid'];
$pin = $_REQUEST['pin'];

if ($uid == "Xamppaloo" && $pin == "Paloodru") {
echo "Authorized"; } 
else {
	echo "Unauthorized Access!!!";
}
mysqli_close($con);
 */

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
//printf("m=[%s], m=[%d], y=[%s]\n", $monthName, $monthNo, $year);


// @require_once("requires/session.php");

//$objDb  = new Database( );
/*
$sql = "select * from saca_dashboard.users_logs";
	$result = mysqli_query($con, $sql);
	while ($data = mysqli_fetch_array($result)){
		echo "<br />=================================";
		echo "<br />Serial: ".$data['uid'];
		echo "<br />Name: ".$data['user_name'];
		echo "<br />Email: ".$data['email'];
		echo "<br />IP Address: ".$data['ip_address'];
		echo "<br />User Time: ".$data['user_time_stamp'];	
		mysqli_close($con);
*/
//	}
//} else {
//	echo "Unauthorized Access!!!";
//}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>SACA DASHBOARD - VISITS</title>
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

<body>
<div class="wrapper" id="main-body"> 
  
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="col-sm-12" id="title_div">
        <h1 style="text-align:center;font-size:1.5em;" >SAME PAGE VISITS  DASHBOARD</h1>
      </div>
    </div>
    <!-- /.container-fluid --> 
  </section>
  <div class="row" id="report_section">
    <div class="col-md-6" id="report_section_single">
      <div class="card">
        <div class="card-header" id="card_header">
          <?php

           $sql = "SELECT DISTINCT(DATE_FORMAT(user_time_stamp,'%Y')) AS currentMonth FROM saca_dashboard.users_logs where month(user_time_stamp) = MONTH(CURRENT_DATE())";
          $result = mysqli_query( $con, $sql );
          while ( $data = mysqli_fetch_array($result)) {
            $yeardata = "Monthly Total Visits: (Year: " . $data[ 'currentMonth' ] . ")";
          }

          ?>
          <h3 class="card-title" id="card_header"><?php echo $yeardata;?></h3>
        </div>
        <!-- /.card-header -->
        
        <?php

        $sql1 = "select MONTHNAME(user_time_stamp) as Month, count(*) as countVisits FROM saca_dashboard.users_logs GROUP by MONTHNAME(user_time_stamp)
		  ORDER BY user_time_stamp desc";
        $result = mysqli_query( $con, $sql1 );
        $t_res = mysqli_num_rows( $result );
        if ( $t_res > 5 ) {
          $idbody = 'id="example3"';
        } else {
          $idbody = "";
        }
        ?>
        <div class="card-body"  id="card-body">
          <table <?php echo $idbody;?> class="table table-bordered table-striped">
            <thead id="th">
              <tr>
                <th id="th" >Month</th>
                <th id="th" >No. of Visits</th>
              </tr>
            </thead>
            <tbody>
              <?php

              while ( $data = mysqli_fetch_array( $result ) ) {
                ?>
              <tr>
                <td id="td-title"><?php echo $data['Month'];?></td>
                <td id="td-data"><?php echo $data['countVisits'];?></td>
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
    <div class="col-md-6" id="report_section_single">
      <div class="card">
        <div class="card-header" id="card_header-abcd">
          <?php
          $sql = "SELECT DISTINCT(DATE_FORMAT(`user_time_stamp`,'%M %Y')) AS currentMonth FROM saca_dashboard.users_logs where month(user_time_stamp) = MONTH(CURRENT_DATE())";
          $result = mysqli_query( $con, $sql );
          while ( $data = mysqli_fetch_array( $result ) ) {
            $mothdata = "Daily Total Visits (" . $data[ 'currentMonth' ] . ")";
           }

          ?>
          <h3 class="card-title" id="card_header-abcd"><?php echo $mothdata;?></h3>
        </div>
        <!-- /.card-header -->
        
        <?php
        $sql2 = "SELECT DATE(user_time_stamp) as date, COUNT(DISTINCT email) AS TotalVisitsToday FROM saca_dashboard.users_logs where MONTH(user_time_stamp) = MONTH(CURRENT_DATE()) GROUP BY date ORDER BY date DESC";

        $result1 = mysqli_query($con, $sql2);
        $t1_res = mysqli_num_rows($result1);

        if ( $t1_res > 5 ) {
          $idbody1 = "id='example2'";
        } else {
          $idbody1 = "";
        }
        ?>
        <div class="card-body"  id="card-body">
          <table <?php echo $idbody1;?> class="table table-bordered table-striped">
            <thead id="th">
              <tr>
                <th id="th" >Date</th>
                <th id="th" >No. of Visits</th>
              </tr>
            </thead>
            <tbody>
              <?php

              while ( $data2 = mysqli_fetch_array( $result1 ) ) {
                ?>
              <tr>
                <td id="td-title" style="text-align: center"><?php echo $data2['date'];?></td>
                <td id="td-data"><a href="sacavisit_detail.php?dateselect1=<?=$data2['date']
				?>" target="_self" title="To View User Visit Detail"><?php echo $data2['TotalVisitsToday'];?></a></td>
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
  </div>
  <div class="card" id="card_update">
    <div class="card-header" id="card_header-abcd">
      <h3 class="card-title"><?php echo "Total Visits Search";?></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body" id="card_body">
      <table id="example1" class="table table-bordered table-striped">
        <thead id="th-abcd">
          <tr>
            <th id="th-abcd" width="40%">User Name</th>
            <th id="th-abcd" width="40%">Email</th>
            <!--<th id="th-abcd">Date</th>-->
            <th id="th-abcd" width="20%">No. of Visits</th>
          </tr>
        </thead>
        <tbody>
          <?php


          $sql1 = "SELECT user_name, email,DATE_FORMAT(user_time_stamp, '%Y-%m-%d') AS year_and_month,COUNT(email) totalCount FROM saca_dashboard.users_logs  group by email order by user_time_stamp desc";

          $result = mysqli_query( $con, $sql1 );
          while ( $data = mysqli_fetch_array( $result ) ) {


            ?>
          <tr>
            <td style="text-align: left"><a href="sacavisit_detail.php?user_name=<?=$data['user_name']?>" target="_self" title="To View User Visit Detail">
              <?=$data['user_name']?>
              </a></td>
            <td style="text-align:left; width:25%"><?php echo $data['email']?></td>
            <?php /*?><td><?php echo $data['year_and_month']?></td><?php */?>
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
