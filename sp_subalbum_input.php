<?php
ob_start();
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($photo_video==0)
{
header("Location:index.php");	
}
include("saveurl.php");
$pid=1;

$file_path="photos/";
 
 $aid=$_REQUEST['cat_id'];
 $pdSQL2 = "SELECT user_right FROM t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$aid;
$pdSQLResult2 = mysqli_query($con,$pdSQL2);
$result2=mysqli_fetch_assoc($pdSQLResult2);

$result2['user_right'];
if($_SESSION['user_type']==1)
			{
			}
			




if(isset($_REQUEST['delete'])&&isset($_REQUEST['albumid'])&$_REQUEST['albumid']!=""){
				 $category_cd_c = $_GET['albumid'];
				$cat_id = $_GET['cat_id'];
				
			   $sql2c="Select * from t031project_albums where parent_album=$category_cd_c";
				$res2c=mysqli_query($con,$sql2c);
				if(mysqli_num_rows($res2c)>=1)
				{
					
					$message=  "<span style='color:red;'>You should delete its sub folders(s) first</span>";
					$activity=$category_cd_c." - You should delete its sub album(s) firstt";
				
				}
				else
				{
				
			
				
				
			 $sql2t="Select * from t027project_photos where album_id=$category_cd_c";
				$res2t=mysqli_query($con,$sql2t);
				$row2d=mysqli_fetch_assoc($res2t);
				
					if(mysqli_num_rows($res2t)>=1)
					{
						$message=  "<span style='color:red;'>You should delete its Photos first</span>";
						 $activity=$category_cd_c." - You should delete its Photos first";
										
					}
					else
					{
					 $sdeletet= "Delete from t031project_albums where albumid=$category_cd_c";
					  mysqli_query($con,$sdeletet);
						
						 $message=  "<span style='color:green;'>album deleted successfully</span>";
						 $activity=$category_cd_c." - album deleted successfully";
					
					}				
				
				
				}
	
	$log_id = $_SESSION['log_id'];
	//echo $message;
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);

}





if(isset($_REQUEST['albumid']))
{
$albumid=$_REQUEST['albumid'];
$pdSQL1="SELECT albumid, pid, album_name,album_order, status, parent_album FROM t031project_albums  WHERE pid= ".$pid." and  albumid = ".$albumid. " order by album_order asc";
$pdSQLResult1 = mysqli_query($con,$pdSQL1);
$pdData1=mysqli_fetch_assoc($pdSQLResult1);
$status=$pdData1['status'];
$album_name=$pdData1['album_name'];
$album_order=$pdData1['album_order'];
$parent_album=$pdData1['parent_album'];
}
if(isset($_REQUEST['save']))
{ 
     $album_name=addslashes($_REQUEST['album_name']);
	  $album_order=$_REQUEST['album_order'];
	  if( $album_order!=="")
	  {
		  $album_order=$album_order;
	  }
	  else
	  {
		  $album_order=0;
	  }
	 $status=$_REQUEST['status'];
	 
	 
	 $created_by	= $_SESSION['ne_fullname_name'];
	 $userid_owner	= $uid;
	
	$datt=date('Y-m-d H:i:s');
	$creater=$created_by." ".$datt;
	$last_modified_by="";
	 
	 $parent_album=$_REQUEST['parent_album'];
	if($_SESSION['user_type']==1)
	{
	}
	else
	{
	$user_rs=$uid."_".$read_right;		
	$user_ids=$uid;
	}
	
$sql_pro1="INSERT INTO t031project_albums(pid, album_name, status,user_ids, user_right,parent_album, creater, creater_id,last_modified_by, album_order) Values(".$pid.", '".$album_name."', ".$status.",'".$user_ids."','".$user_rs."', '".$parent_album."' , '".$creater."', ".$userid_owner.", '".$last_modified_by."', ".$album_order.")";
	$sql_pro=mysqli_query($con,$sql_pro1);
	$album_id=mysqli_insert_id($con);
	//$album_id=$con->lastInsertId();
	if($parent_album==0)
		{
		//$parent_group=$category_cd;
			if(strlen($album_id)==1)
			{
			$parent_group="00".$album_id;
			}
			else if(strlen($album_id)==2)
			{
			$parent_group="0".$album_id;
			}
			else
			{
			$parent_group=$album_id;
			}
		}
	else
	{
		$parent_group1=$parent_album."_".$album_id;
		echo $sql="select parent_group from t031project_albums where albumid=$parent_album";
		$sqlrw=mysqli_query($con,$sql);
		$sqlrw1=mysqli_fetch_assoc($sqlrw);
	
		
		if(strlen($album_id)==1)
			{
			$category_cd_pg="00".$album_id;
			}
			else if(strlen($album_id)==2)
			{
			$category_cd_pg="0".$album_id;
			}
			else
			{
			$category_cd_pg=$album_id;
			}
		
		$parent_group=$sqlrw1['parent_group']."_".$category_cd_pg;
	}
	
	$sql_pro="UPDATE t031project_albums SET parent_group='$parent_group' where albumid=$album_id";
	
	$sql_proresult=mysqli_query($con,$sql_pro);
	
	if ($sql_pro == TRUE) {
    $message=  "New record added successfully";
	$activity=  $album_id." - New Album added successfully";
	} else {
    $message= "Error in uploading record";
	$activity= "Error in uploading Albums";
	}
	
	$log_id = $_SESSION['log_id'];
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
	
	$album_name="";
	$album_order="";
	
	print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "</script>";
	
}

if(isset($_REQUEST['update']))
{
$album_name=addslashes($_REQUEST['album_name']);
$album_order=$_REQUEST['album_order'];
if( $album_order!=="")
	  {
		  $album_order=$album_order;
	  }
	  else
	  {
		  $album_order=0;
	  }
$status=$_REQUEST['status'];
 $parent_album=$_REQUEST['parent_album'];
 $created_by	= $_SESSION['ne_fullname_name'];
	 $userid_owner	= $uid;
	
	$datt=date('Y-m-d H:i:s');
	
	$last_modified_by=$created_by." ".$datt;
 
 if($parent_album==0)
		{
		//$parent_group=$category_cd;
			if(strlen($album_id)==1)
			{
			$parent_group="00".$album_id;
			}
			else if(strlen($album_id)==2)
			{
			$parent_group="0".$album_id;
			}
			else
			{
			$parent_group=$album_id;
			}
		}
	else
	{
		$parent_group1=$parent_album."_".$album_id;
		$sql="select parent_group from t031project_albums where albumid='$parent_album'";
		$sqlrw=mysqli_query($con,$sql);
		$sqlrw1=mysqli_fetch_assoc($sqlrw);
	
		
		if(strlen($album_id)==1)
			{
			$category_cd_pg="00".$album_id;
			}
			else if(strlen($album_id)==2)
			{
			$category_cd_pg="0".$album_id;
			}
			else
			{
			$category_cd_pg=$album_id;
			}
		
		$parent_group=$sqlrw1['parent_group']."_".$category_cd_pg;
	}
$sql_pro="UPDATE t031project_albums SET album_name='$album_name',status='$status', parent_album='$parent_album', creater_id=$userid_owner, last_modified_by='$last_modified_by', album_order=$album_order where albumid=$albumid";
	
	$sql_proresult=mysqli_query($con,$sql_pro);
	
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
		$activity=  $albumid." - Album updated successfully";
	} else {
		 $message= "Error in uploading record";
	$activity= "Error in updating Albums";
	}	
	$log_id = $_SESSION['log_id'];
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
	$album_name="";
	$album_order="";
	print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "</script>";

}
if(isset($_REQUEST['cancel']))
{
	print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "self.close();";
    print "</script>";
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - Photos Videos Gallery</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
  <script>
function cancelButton()
{
 window.opener.location.reload();
 self.close();
}
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12">
           
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Manage Albums</h3>
                </div>
              
                <form class="forms-sample"  action="sp_subalbum_input.php?cat_id=<?php echo $aid;?>" target="_self" method="post"  enctype="multipart/form-data"  id="add_details" >
                   <input type="hidden" name="parent_album" id="parent_album" value="<?php echo $aid;?>" />
                <div class="card-body">
                
               
                <div class="form-group">
                <label for="exampleInputPassword1">Album Name</label>
                  <input   type="text"  class="form-control" id="exampleInputPassword1" name="album_name" placeholder="Enter The Album Name Here" value="<?php echo $album_name;?>" Required maxlength="245">

                </div>
                 <div class="form-group">
                 <label for="exampleInputPassword1">Album Order</label>               
               <input class="form-control"  type="number"  id="exampleInputPassword1" name="album_order" placeholder="Enter The Album Order Here" value="<?php echo $album_order;?>" >Numbers Only
                </div>
                 <div class="form-group">
                 <?php if(!isset($status))
				  {
				  $status=1;
				  } ?>
     
                <label for="exampleInputPassword1" style="margin-left:25px">
                              <input type="radio" class="form-check-input"  name="status" value="1" <?php if($status==1){ echo "checked";} ?> >
                              Active
                            </label>
                            <label for="exampleInputPassword1" style="padding-left: 10%">
                              <input type="radio" class="form-check-input" name="status"   value="0" <?php if($status==0){ echo "checked";} ?>>
                              Inactive
                            </label>
                </div>
                 
              
                </div>
                <div class="card-footer">
                
                <?php if(isset($_REQUEST['albumid']))
	 {
		 
	 ?>
     <button type="submit" class="btn btn-primary" name="update" id="update" style="width:20%"> Update</button>
     <input type="hidden" name="albumid" id="albumid" value="<?php echo $_REQUEST['albumid']; ?>" />
     <!--<input  type="submit" name="update" id="update" value="<?php echo UPDATE;?>" />-->
     <?php
	 }
	 else
	 {
	 ?>
	 <!--<input  type="submit" name="save" id="save" value="<?php echo SAVE;?>" />-->
      <button type="submit" class="btn btn-primary" name="save" id="save" style="width:20%"> Submit </button>
	 <?php
	 }  
	 ?> 
    
      <button type="submit" class="btn btn-primary" name="cancel" id="cancel" style="width:20%" onclick="cancelButton();">Cancel</button>
              
                </div>
                </form>
              </div>
                        
              <!--add form-->
             
            
              <!-- add form-->
          </div>
      </div>
      <div class="row">
          <div class="col-12">
            <div class="card">
              
              <!-- /.card-header -->
             
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead id="th" style="background-color: #336992; ">
                    <tr >
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">#</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Album Name</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Album Order</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Status</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Action</th>
                     
                    </tr>
                  </thead>                  <tbody>
                      <tbody>
                  <?php
							  
					$pdSQL = "SELECT albumid,parent_group, pid, album_name,user_right, status, album_order FROM t031project_albums  WHERE pid= ".$pid." and parent_album=".$aid."   order by album_order desc";
						 $pdSQLResult = mysqli_query($con,$pdSQL);
						$i=1;
							  if(mysqli_num_rows($pdSQLResult)>=1)
							  {
							  while($pdData=mysqli_fetch_assoc($pdSQLResult))
							  { 
							  
							  $p_group=$pdData['parent_group'];
				$arr_gp=explode("_", $p_group);
				$get_album_id=$arr_gp[0];
			 $pdSQL_get_right = "SELECT user_ids,user_right FROM t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$get_album_id;
			 $pdSQLResult_get_right =mysqli_query($con,$pdSQL_get_right);
			 $result_get_right=mysqli_fetch_assoc($pdSQLResult_get_right);
	
							  
							
							  if($_SESSION['user_type']==1)
			{
				
							
                         ?>
                   
                     <tr>
                      
                        <td style="vertical-align: middle; text-align:center;"><?php echo $i;?></td>
                        <td style="vertical-align: middle; text-align:left;"><?php echo $pdData['album_name'];?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php echo $pdData['album_order'];?></td>
                        <td style="vertical-align: middle; text-align:center;"><?php if($pdData['status']==1)
						  {
						  echo "active";
						  }
						  else
						  {
						  echo "Inactive";
						  }?></td>
                        
                       
                       
                       
                       
                        <td style="vertical-align: middle; text-align:center;">
                        <span style="float:left"><form action="sp_subalbum_input.php?albumid=<?php echo $pdData['albumid'] ?>&cat_id=<?php echo $aid ?>" method="post"><input type="submit" name="edit" id="edit" value="Edit" /></form></span>
						   
						   <span style="float:right"><form action="sp_subalbum_input.php?albumid=<?php echo $pdData['albumid'] ?>&cat_id=<?php echo $aid ?>" method="post"><input type="submit" name="delete" id="delete" value="Del" onclick="return confirm('Are you sure, you want to delete this album and its photos?')" /></form></span>
                        
                        </td> 
                        
                      </tr>
                  <?php
				 $i++;		
			}
		
						
						
						
						
						}
							  }else
						{
						?>
						<tr>
                          <td colspan="4" >No Record Found</td>
                        </tr>
						<?php
						}
						?>
                     
                  </tbody>
                      
                  </tbody>
                </table>
              </div>
             
              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        </div>
    </section>
    <!-- Main content -->
    <!-- /.content -->
  </div>
   <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b> 
    </div>
    <strong><a href="https://adminlte.io"></a></strong> 
  </footer>
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../sacadb/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../sacadb/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../sacadb/theme/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../sacadb/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../sacadb/theme/dist/js/demo.js"></script> -->
<!-- Page specific script -->


</body>
</html>
