<?php 

 require 'db.php'; 
$class = null;
$update = null;

if (isset($_GET['id'])){

   $active=$_GET['id'];
   $uid=$_GET['uid'];
  if($active==0)
  {
	  $status=1;
  }
  else
  {
	  $status=0;
  }
        // SQL query that sets the status to
        // 0 to indicate deactivation.
       $sql="UPDATE direct_users SET 
            active=$status WHERE active=$active and uid=$uid";
  
        // Execute the query
        mysqli_query($con,$sql);
		header('location: manage_user.php');
    }
	if (isset($_GET['action']) && ($_GET['action']=='delete')){

 
   $uid=$_GET['uid'];
  
        // SQL query that sets the status to
        // 0 to indicate deactivation.
       $sql="delete from direct_users WHERE uid=$uid";
  
        // Execute the query
        mysqli_query($con,$sql);
		header('location: manage_user.php');
    }
  
    // Go back to course-page.php
// header('location: manage_user.php');



 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Manage Users</title>  
  
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
 .badge{
	 padding:.75em 1.2em;
 }
 </style> 
  <style>
        .btn{
          /*  background-color: red;
            border: none;
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;*/
        }
        .green{
            background-color: #199319;
			border: none;
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
			
        }
        .red{
            background-color: red;
			border: none;
            color: white;
            padding: 5px 5px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 14px;
            margin: 4px 2px;
            cursor: pointer;
            border-radius: 12px;
        }
    
    </style> 
    
	<script type="text/javascript">
function confirm_click()
{
return confirm("Are you sure, you want to delete user ?");
}


	</script>  
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Rights Management</h1>
           
                      <!-- select -->
                      
                   
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Manage Users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  	<th>Sr#</th>
                  	<th>Name</th>
                    <th>Email</th>
                     <th>Status</th>
                     <th>Toggle</th>
                    <th>Date and Time</th>
                    <th>User Type</th>
                     <th>Manage Rights</th>
                    <th>Action</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php  $pmisUpdataDataQuery  = "select * from direct_users";
                      $pmisUpdataDataResult = mysqli_query($con,$pmisUpdataDataQuery);
                      $pmisUpdataDataCount  = mysqli_num_rows($pmisUpdataDataResult);
					  $i=1;
                      while($pmisres=mysqli_fetch_assoc($pmisUpdataDataResult))
				  	 {
					   ?>
                       <tr>
                       <td>
                     <?php  echo  $i++;?>
                       </td>
                       <td>
                     <?php  echo  $pmisres['login_name'];?>
                       </td>
                        <td>
                     <?php  echo  $pmisres['email'];?>
                       </td>
                       <td>
                     <?php   if($pmisres['active']==1)
					 {
						 echo "Active";
					 }
					 else
					 {
						 echo "Inactive";
					 }?>
                       </td>
                         <td>
                         
                    <?php 
					
                    if($pmisres['active']==1 && $pmisres['user_type']==1) 
					{
	  ?>
                      
<a href="#" class='btn red' style="pointer-events: none; display: inline-block; opacity:0.3">Deactivate</a>
<?php
  }
  else 
  {
	   if($pmisres['active']==1 ) 
	   {
	  ?>
                      
    <a href="manage_user.php?id=<?php echo $pmisres['active']?>&uid=<?php echo $pmisres['uid']?>" class='btn red'>Deactivate</a>
    <?php
  		}
	else
	{ 
	?>
	<a href="manage_user.php?id=<?php echo $pmisres['active']?>&uid=<?php echo $pmisres['uid']?>" class='btn green'>Activate</a>
	<?php
	}
  }
                    ?>
                       </td>
                        <td>
                     <?php  echo  $pmisres['time_stamp'];?>
                       </td>
                       <td>
                     <?php  if($pmisres['user_type']==1)
					 {
						 echo "Super admin";
					 }
					 else
					 {
						 echo "User";
					 }?>
                     
                     <?php 
                     /* echo  $pmis1 = "select * from rs_tbl_user_rights where user_cd=".$pmisres['uid'];
                      $pmisR = mysqli_query($con,$pmis1);
                     
						 $pmisres1=mysqli_fetch_assoc($pmisR);
						echo  $pmisres1['div_cd'];
						echo $pmisres1['region_cd'];
						 if(($pmisres1['div_cd']!='') && ($pmisres1['region_cd']=='') && ($pmisres1['count_cd']=='') && ($pmisres1['project_cd']==''))
						 {
							echo  $update="&update=d";
							$class='';
						 }
					
						 else
						 {
							 $class='class="disabled"';
						 }*/
					 
					 
					 ?>
                     <style>
					 a.disabled {
  pointer-events: none;
  cursor: default;
  opacity:.3;
}
					 </style>
                       </td>
                      
                        <td><?php  if(($pmisres['active']==1) && ($pmisres['user_type']==1))
				{
					echo "Full Rights";}else if(($pmisres['active']==1) && ($pmisres['user_type']!=1)){?>
                  <a href="pages_rights.php?id=<?php echo  $pmisres['uid']?>">Pages Rights</a> | <a href="assign_rights.php?id=<?php echo  $pmisres['uid']?>&lid=1<?php echo $update;?>" <?php echo $class;?>>Division Level</a> | <a href="assign_rights.php?id=<?php echo  $pmisres['uid']?>&lid=2<?php echo $update;?>" <?php echo $class;?>>Region Level</a> | <a href="assign_rights.php?id=<?php echo  $pmisres['uid']?>&lid=3<?php echo $update;?>" <?php echo $class;?>>Country Level</a> | <a href="assign_rights.php?id=<?php echo  $pmisres['uid']?>&lid=4<?php echo $update;?>" <?php echo $class;?>>Project Level</a><?php }
				else
				{
					echo "Assign Rights";
				}
				?></td>
                <td>
               <?php  if($pmisres['user_type']==1)
			   {
			   }
			   else
			   {
				   ?>
                <a href="manage_user.php?action=delete&uid=<?php echo $pmisres['uid']?>" onclick="return confirm_click();"  >Delete</a>
                <?php
			   }
			   ?>
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
<!-- <script src="theme/dist/js/demo.js"></script> -->
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
