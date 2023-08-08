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
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
              <?php
               $pname = "select distinct project_name as project_name, country_name, links from pmis_update_data where project_id=".$pid;
 $pname_r = mysqli_query($con,$pname);
 $pnameres=mysqli_fetch_assoc($pname_r);
 ?>
               <p class="lead" style="margin-left:5px"><?php echo $pnameres['project_name'];?> - <?php echo $pnameres['country_name'];?></p>
                <div class="col-12 table-responsive">
                  
                </div>
                
                <div class="col-6">
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
                </div>
                <div class="col-6">
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
                </div>
                <!-- /.col -->
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
