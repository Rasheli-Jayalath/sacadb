<?php
session_start();
 require 'db.php'; 
 include("check_rights.php");
 if(!isset($_SESSION['uid']) || $_SESSION['user_type']!=1)
{
header("Location:index.php");	
}
include("saveurl.php");

 $userid=$_REQUEST['id'];
  $level=$_REQUEST['lid'];

 $pmisCount5 =null;
 
 
 if($_SERVER['REQUEST_METHOD'] == "POST" && $_POST['update']=="Update"){
  $uid=$_POST['uid'];
 $kpi=$_POST['kpi'];
 $ppr=$_POST['ppr'];
 $pmis=$_POST['pmis'];
 $cvbank=$_POST['cvbank'];
 
 
 $hr=$_POST['hr'];
 $software_portal=$_POST['software_portal'];
 $team_finder=$_POST['team_finder'];
 $bd_dashboard=$_POST['bd_dashboard'];
 
   $div_dms=$_POST['div_dms'];
 $aibot=$_POST['aibot'];
  $eshs=$_POST['eshs'];
 $photo_video=$_POST['photo_video'];
 $apps=$_POST['apps'];
 
 
 $sql_pstt="update direct_users set kpi=$kpi, ppr=$ppr,pmis=$pmis, cvbank=$cvbank,hr=$hr,software_portal=$software_portal,team_finder=$team_finder,bd_dashboard=$bd_dashboard,div_dms=$div_dms,eshs=$eshs,aibot=$aibot,photo_video=$photo_video,apps=$apps where uid=$uid";
mysqli_query($con,$sql_pstt);
//header("Location:manage_user.php");
 
 }
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
 .badge{
	 padding:.75em 1.2em;
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
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>User Rights Management</h1>
           
                      <!-- select -->
                      
                   
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Users Rights</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Manage User Rights</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
               <?php  $pmisUpdataDataQuerye  = "select * from direct_users where uid=".$userid;
                      $pmisUpdataDataResulte = mysqli_query($con,$pmisUpdataDataQuerye);
                      $pmisUpdataDataCounte  = mysqli_num_rows($pmisUpdataDataResulte);
					 $pmisrese=mysqli_fetch_assoc($pmisUpdataDataResulte);
					 
					 
					
					
				  	
					   ?>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" >Name</label>
                    <div class="col-sm-10">
                      <input type="name" class="form-control" id="name" placeholder="Name" readonly value=" <?php  echo  $pmisrese['login_name'];?>">
                      <input type="hidden" class="form-control" id="uid"  name="uid" readonly value=" <?php  echo  $userid;?>">
                     <!-- <input type="hidden" class="form-control" id="user_type" name="user_type" readonly value=" <?php  echo  $user_type;?>">-->
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" >Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" readonly value=" <?php  echo  $pmisrese['email'];?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" ></label>
                    <div class="col-sm-10">
                      <table class="table table-striped" style="  text-align:left">
			
			 
		  <tr>
    <td align="right">&nbsp;</td>
    <td width="130" valign="middle">KPI</td>
    <td  ><select name="kpi" id="kpi" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['kpi']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['kpi']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td  width="130" valign="middle"  >PPR Dashboard</td>
    <td  ><select name="ppr" id="ppr" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['ppr']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['ppr']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td  width="130" valign="middle"  >PMIS</td>
    <td   ><select name="pmis" id="pmis" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['pmis']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['pmis']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
   
    <td>&nbsp;</td>
    </tr>
	
	      
		  
	
	
		  
	
	
		  <tr>
    <td align="right">&nbsp;</td>
    <td width="130"  valign="middle">CV Bank</td>
    <td    ><select name="cvbank" id="cvbank" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['cvbank']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['cvbank']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td width="130" valign="middle"  >HR Update</td>
    <td  ><select name="hr" id="hr" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['hr']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['hr']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td width="130" valign="middle"  >Software Portal</td>
    <td    ><select name="software_portal" id="software_portal" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['software_portal']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['software_portal']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
   
    <td>&nbsp;</td>
    </tr>
	
	
	
		  <tr>
    <td  align="right">&nbsp;</td>
    <td  width="130" valign="middle">Taam Finder </td>
    <td    ><select name="team_finder" id="team_finder" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['team_finder']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['team_finder']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td width="130" valign="middle"  >BD Dashboard</td>
    <td  ><select name="bd_dashboard" id="bd_dashboard" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['bd_dashboard']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['bd_dashboard']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td width="130" valign="middle"  >Divisional DMS</td>
    <td    ><select name="div_dms" id="div_dms" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['div_dms']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['div_dms']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
   
    <td>&nbsp;</td>
    </tr>
	
     <tr>
    <td align="right">&nbsp;</td>
    <td   width="130" valign="middle">AI Chatbot </td>
    <td    ><select name="aibot" id="aibot" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['aibot']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['aibot']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
   
    <td  width="130" valign="middle">ESHS</td>
    <td    ><select name="eshs" id="eshs" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['eshs']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['eshs']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td width="130" valign="middle"  >Photo and Video Gallery</td>
    <td  ><select name="photo_video" id="photo_video" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['photo_video']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['photo_video']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
       
    <td>&nbsp;</td>
    </tr>
    <tr>
    <td align="right">&nbsp;</td>
   <td width="130" valign="middle"  >Apps</td>
    <td    ><select name="apps" id="apps" class="form-control form-control-sm"  style="width:80px; height:35px; background-color:#FFF; color:black">
      <option value="0" <?php if ($pmisrese['apps']==0) {echo "selected='selected'";} ?>>Deny</option>
      <option value="1" <?php if ($pmisrese['apps']==1) {echo "selected='selected'";} ?>>Allow</option>
    </select></td>
    <td></td>
    <td    ></td>
    <td width="85" valign="middle"  ></td>
    <td  ></td>   
    <td>&nbsp;</td>
    </tr>
    
    <tr><td colspan="8"><input type="button" class="btn btn-default float-left" value="Cancel" onClick="document.location='manage_user.php';" style="margin-right:10px"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                  <input type="submit" class="btn btn-default float-left" name="update" id="update" value="Update" style="margin-right:10px"/> </td></tr>

			</table>
                    </div>
                  </div>
                  
                  
                </div>
        
              </form>
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
