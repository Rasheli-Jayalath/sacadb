<?php 
ob_start();
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($pmis==0)
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
  <title>SACA DASHBOARD - PMIS</title>
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
label{
  font-size:1em;
}
option{
  font-size:2vh;
}
#th{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#79a9ce;
color:white;}
#th-abcd{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#1d3a67;
color:white;}
td{
  font-size:2vh;
  text-align: center;
  max-width:15vh;
}
#card_update{
  margin: .75em 1.25em;
 
 }
#card_body{
  overflow-x:scroll; 
  overflow-y: scroll; 
}
 .badge{
	 padding:.75em 1.2em;
   width:6vh;
 }

 #report_section{
  padding: 0.75em 1.2em;
 }
 #card_header{
  font-weight:500;
  background-color:#79a9ce;
  font-size:1em;
  color:white;
 }
 #card_header-abcd{
  font-weight:500;
  background-color:#1d3a67;
  font-size:1em;
  color:white;
 }
 #title_div{
  margin-top:5vh;
  
 }
 #abc{
  overflow-y:auto;
  font-size:1em;

 }
 #abcd{
  overflow-y:auto;
  font-size:1em;
 }
 #abcg{
  overflow-y:auto;
  font-size:1em;
 }
 #report_section_single{}
.card-body{
  overflow-y:auto;
  font-size:2vh;
}
#td-title{
 text-align:left;
 font-size:1em;
}
#td-title-total{
 font-weight:bold;
 text-align:left;
 font-size:1em;
}
#td-data{
 font-size:1em;
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
  <div class="content-wrapper" id="main-body">
  
  
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="col-sm-12" id="title_div">
          <h1 style="text-align:center;font-size:1.5em;" >PMIS/DMS/GIS</h1>
            <h4 style="text-align:center; margin-top: 10px;font-size:1.2em;">Status Update Page</h4>
          </div>
      </div><!-- /.container-fluid -->
    </section>
<div class="row" style="margin-left:15px">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
             
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="update_status.php?s=d" class="small-box-footer">DMS Status</a>
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
             
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="update_status.php?s=p" class="small-box-footer">PMIS Status</a>
            </div>
          </div>
      </div>
        
       <?php
      if(isset($_GET['s']))
         {
             if($_GET['s']=='d')
             {
             $updates="All DMS";
			$system='DMS';
			$table="dms_update_data";
			$condition="1=1";
                  $link_c="/dms_api/update_data.php";
               
             }
             else if($_GET['s']=='p')
             {
             $updates="All PMIS";
			$system='PMIS';
			$table="pmis_update_data";
			$condition="1=1";
                
                   $link_c="/api/update_data.php";
             }
         }
         else
         {
			$updates="All DMS";
			$system='DMS';
			$table="dms_update_data";
			$condition="1=1";
             $link_c="/dms_api/update_data.php";
         }
			?>
        <div id="pmisdiv">
        <div class="card" id="card_update">
              <div class="card-header" id="card_header-abcd">
                <h3 class="card-title"><?php echo $updates?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="card_body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead id="th-abcd">
                 
                  
                  <tr>
                  	 <th id="th-abcd">Project Code</th>
                    <th id="th-abcd">Project Name</th>
                     <th id="th-abcd">Country</th>
                    <th id="th-abcd"><?php echo $system;?> Link</th>
                    <th id="th-abcd">Update <?php echo $system;?></th>
                    <th id="th-abcd">Link Click Date</th>
                  
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php  /*echo $pmisUpdataDataQuery  = "select project_id,project_name, country_name, links,JSON_ARRAYAGG(JSON_OBJECT('item',item_name,'value',item_value1) ) as project_details
from pmis_update_data where item_name!='DMS' and item_name!='GIS' group by project_id";*/
		$pmisUpdataDataQuery  = "select project_id,project_name,links,country_name,link_click_date from $table where $condition  group by project_id";
                      $pmisUpdataDataResult = mysqli_query($con,$pmisUpdataDataQuery);
                      $pmisUpdataDataCount  = mysqli_num_rows($pmisUpdataDataResult);
                    while( $pmisUpdataDataRes = mysqli_fetch_assoc($pmisUpdataDataResult))
					{
					
							$pid= $pmisUpdataDataRes['project_id'];
							$project_name= $pmisUpdataDataRes['project_name'];
							$country_name= $pmisUpdataDataRes['country_name'];
							$links= $pmisUpdataDataRes['links'];
                        $link_click_date= $pmisUpdataDataRes['link_click_date'];
                       $arr_date= explode(" ",$link_click_date);
                       $link_click_date1= $arr_date[0];
							
							
					  ?>
                      <tr>
                      <td><a href="summary.php?id=<?php  echo $pid;?>">
                     <?php  echo $pid;?></a>
                      </td>
                      <td style="text-align:left; width:35%">
                     <?php  echo $project_name;?>
                      </td>
                      <td>
                     <?php  echo $country_name;?>
                      </td>
                      <td>
                     <a href="<?php  echo $links;?>" target="_blank">Yes</a>
                      </td>
                       <td>
                           <a href="<?php echo $links.$link_c?>" target="_blank"><?php  echo "Update Status"?></a>
                      </td>
                       <td>
                  <?php echo  $link_click_date1; ?>
                      </td>
                      
                   
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
            
            
            <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
   <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
            </div>
            
        
          <!-- jQuery -->
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
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	
   /* $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scrollX": true,
    });*/
  }
</script>
</body>
</html>
<?php ob_end_flush();?>
