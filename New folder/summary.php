<?php 

 require 'db.php'; 
 
$pid= $_REQUEST['id'];


 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Saca_Dashboard<?php echo $_SERVER['DOCUMENT_ROOT'];
 ?></title>


  
  
  
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
  /*font-size:10px;*/
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
  
            </div>
            
        <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Summary</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Summary</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            


            <!-- Main content -->
            <div class="invoice p-3 mb-3">
              <!-- title row -->
              <div class="row">
                <div class="col-12" >
                  <h4>
                    <i class="fas fa-globe"></i> Project Code: <?php echo $pid;?>
                    <small class="float-right">Date: <?php echo date("Y/m/d");?></small>
                  </h4>
                   <?php
               $pname = "select distinct project_name as project_name, country_name, links from pmis_update_data where project_id=".$pid;
 $pname_r = mysqli_query($con,$pname);
 $pnameres=mysqli_fetch_assoc($pname_r);
 ?>
               <p class="lead"><b><?php echo $pnameres['project_name'];?> - <?php echo $pnameres['country_name'];?></b></p>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->
              
              <!-- /.row -->

              <!-- Table row -->
             
              <div class="row">
              
                
               <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header" id="card_header">
                <h3 class="card-title" id="card_header">PMIS Updates</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                      <table class="table table-bordered" id="abc">
                  <thead id="th">
                    <tr>
                      
                      <th id="th" >Item Name</th>
                      <th id="th" >Updated Date</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                   <?php 
 $pdetail = "select * from pmis_update_data where project_id=".$pid." and item_name!='DMS' and item_name!='GIS'";
 $pdetail_r = mysqli_query($con,$pdetail);
 $pdetail_count  = mysqli_num_rows($pdetail_r);
  while($pdetaires=mysqli_fetch_assoc($pdetail_r))
	{
 ?>
  <tr>
                      <td><?php echo $pdetaires['item_name'];?></td>
                      <td><?php echo $pdetaires['item_value1'];?></td>
                      
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
          
          <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header" id="card_header">
                <h3 class="card-title" id="card_header">DMS Updates</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              
                      <table class="table table-bordered" id="abc">
                  <thead id="th">
                    <tr>
                      
                      <th id="th" >Item Name</th>
                      <th id="th" >Updated Date</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                   <?php 
 $pdetail = "select * from pmis_update_data where project_id=".$pid." and item_name='DMS'";
 $pdetail_r = mysqli_query($con,$pdetail);
 $pdetail_count  = mysqli_num_rows($pdetail_r);
  while($pdetaires=mysqli_fetch_assoc($pdetail_r))
	{
 ?>
  <tr>
                      <td><?php echo $pdetaires['item_name'];?></td>
                      <td><?php echo $pdetaires['item_value1'];?></td>
                      
                    </tr>
                 <?php
				 
	}
	?>         
                  </tbody>
                </table>
                <table class="table table-bordered" id="abc">
                  <thead id="th">
                  <tr>
                  <th colspan="2" style="text-align:center">Files Uploaded during Date <br/>
From <?php echo date('Y-m-d', strtotime('-7 days'))?> To  <?php echo date('Y-m-d');?></th>
                  </tr>
                    <tr>
                      
                      <th id="th" >Description</th>
                      <th id="th" >No. Of Files</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                   
 					 <tr>
                      <td><?php echo "All Files"?></td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td><?php echo "PDF Files"?></td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>DOC,XLSX,TXT Files</td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Images Files</td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Other Files</td>
                      <td></td>                      
                    </tr>
                      
                  </tbody>
                </table>
                 <table class="table table-bordered" id="abc">
                  <thead id="th">
                  <tr>
                  <th colspan="2" style="text-align:center">Total Files </th>
                  </tr>
                    <tr>
                      
                      <th id="th" >Description</th>
                      <th id="th" >No. Of Files</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                   
 					 <tr>
                      <td><?php echo "All Files"?></td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td><?php echo "PDF Files"?></td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>DOC,XLSX,TXT Files</td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Images Files</td>
                      <td></td>                      
                    </tr>
                    <tr>
                      <td>Other Files</td>
                      <td></td>                      
                    </tr>
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
           
            <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header" id="card_header">
                <h3 class="card-title" id="card_header">GIS Updates</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
               <table class="table table-bordered" id="abc">
                  <thead id="th">
                    <tr>
                      
                      <th id="th" >Item Name</th>
                      <th id="th" >Updated Date</th>
                     
                    </tr>
                  </thead>
                  <tbody>
                  
                   <?php 
 /*$pdetail = "select * from pmis_update_data where project_id=".$pid." and item_name='GIS'";
 $pdetail_r = mysqli_query($con,$pdetail);
 $pdetail_count  = mysqli_num_rows($pdetail_r);
  while($pdetaires=mysqli_fetch_assoc($pdetail_r))
	{*/
 ?>
  <tr>
                      <td><?php echo "Reports";?></td>
                      <td></td>
                      
                    </tr>
                    <tr>
                      <td><?php echo "Images";?></td>
                      <td></td>
                      
                    </tr>
                    <tr>
                      <td><?php echo "Videos";?></td>
                      <td></td>
                      
                    </tr>
                    <tr>
                      <td><?php echo "Shape File";?></td>
                      <td></td>
                      
                    </tr>
                 <?php
				 
	//}
	?>         
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>     
                
                
                
                
                
                <div class="col-12 table-responsive">
                  
                </div>
                
                <!--<div class="col-6">
                  <p class="lead">Project Updates</p>

                  <div class="table-responsive">
                    <table class="table table-striped">
                    <thead>
                    <tr>
                      <th>Item Name</th>
                      <th>Updated Date</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    <?php 
 $pdetail = "select * from pmis_update_data where project_id=".$pid;
 $pdetail_r = mysqli_query($con,$pdetail);
 $pdetail_count  = mysqli_num_rows($pdetail_r);
  while($pdetaires=mysqli_fetch_assoc($pdetail_r))
	{
 ?>
  <tr>
                      <td><?php echo $pdetaires['item_name'];?></td>
                      <td><?php echo $pdetaires['item_value1'];?></td>
                      
                    </tr>
                 <?php
				 
	}
	?>
                    
                    
                    
                   
                    
                    </tbody>
                  </table>
                  </div>
                </div>-->
                <!--<div class="col-6">
                  <p class="lead">System Links</p>

                  <div class="table-responsive">
                    <table class="table">
                    <thead>
                    <tr>
                      <th>System Name</th>
                      <th>Link</th>
                    </tr>
                     </thead>
                       <tbody>
                    <tr>
                      <td>PMIS</td>
                      <td>                
                      <a href='<?php echo $pnameres['links'];?>' target="_blank"><?php echo $pnameres['links'];?></a></td>
                      
                    </tr>
                     <tr>
                      <td>DMS</td>
                      <td>
                    <?php  $dname = "select links from pmis_update_data where project_id=".$pid." and item_name='DMS'";
 $dname_r = mysqli_query($con,$dname);
 $dnameres=mysqli_fetch_assoc($dname_r);
 ?>
                      <a href='<?php echo $dnameres['links'];?>' target="_blank"><?php echo $dnameres['links'];?></a></td>
                      
                    </tr>
                     <tr>
                      <td>GIS</td>
                      <td>
                      <?php  $gname = "select links from pmis_update_data where project_id=".$pid." and item_name='GIS'";
 $gname_r = mysqli_query($con,$gname);
 $gnameres=mysqli_fetch_assoc($gname_r);
 ?>
                      <a href='<?php echo $gnameres['links'];?>' target="_blank"><?php echo $gnameres['links'];?></a></td>
                      
                    </tr>
                    </tbody>
                   
                      
                      
                      
                    </table>
                  </div>
                </div>-->
                <!-- /.col -->
              </div>
              <!-- /.row -->

              
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                  <a href="summary-print.php?id=<?php echo $pid?>" rel="noopener" target="_blank" class="btn btn-default" style="float:right; margin:5px"><i class="fas fa-print"></i> Print</a>
                 
                  <!--<button type="button" class="btn btn-primary float-right" style="margin-right: 5px;">
                    <i class="fas fa-download"></i> Generate PDF
                  </button>-->
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
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
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scrollX": true,
    });
  });
</script>

</body>

</html>
