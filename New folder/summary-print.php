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
 
</head>
<body>
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-12">
        <h2 class="page-header">
          <i class="fas fa-globe"></i> Project Code: <?php echo $pid;?>
                    <small class="float-right">Date: <?php echo date("Y/m/d");?></small>
        </h2>
        <?php $pname = "select distinct project_name as project_name, country_name, links from pmis_update_data where project_id=".$pid;
 $pname_r = mysqli_query($con,$pname);
 $pnameres=mysqli_fetch_assoc($pname_r);
 ?>
               <p class="lead" style="margin-left:5px"><?php echo $pnameres['project_name'];?> - <?php echo $pnameres['country_name'];?></p>
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
             
              </div>
    <!-- /.row -->

    
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
<!-- Page specific script -->
<script>
  window.addEventListener("load", window.print());
</script>
</body>
</html>
