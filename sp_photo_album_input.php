<?php
ob_start();
session_start();
require 'db.php'; 
include("check_rights.php");
header("Content-Type: text/html; charset=utf-8");
$strusername = $_SESSION['user_name'];
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($photo_video==0)
{
header("Location:index.php");	
}
include("saveurl.php");
 $user_cd=$_SESSION['uid'];
$pid=1;
$file_path="photos/";
$file_thumb_path="photos/thumb/";
 
 function genRandom($char = 5){
	$md5 = md5(time());
	return substr($md5, rand(5, 25), $char);
}
function getExtention($type){
	if($type == "image/jpeg" || $type == "image/jpg" || $type == "image/pjpeg")
		return "jpg";
	elseif($type == "image/png")
		return "png";
	elseif($type == "image/gif")
		return "gif";
	elseif($type == "application/pdf")
		return "pdf";
	elseif($type == "application/msword")
		return "doc";
	elseif($type == "application/vnd.openxmlformats-officedocument.wordprocessingml.document")
		return "docx";
	elseif($type == "text/plain")
		return "doc";
		
}
$album_id=$_REQUEST['album_id'];
 $pdSQL_get_right1 = "SELECT parent_group FROM  t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$album_id;
			                $pdSQLResult_get_right1 = mysqli_query($con,$pdSQL_get_right1);
							$result_get_right1 = mysqli_fetch_assoc($pdSQLResult_get_right1);
			                //$result_get_right1 = $objDb->dbFetchArray(); 
							$p_group=$result_get_right1['parent_group'];
				$arr_gp=explode("_", $p_group);
				$group_count=count($arr_gp);
				if($group_count>1)
				{
				 $get_album_id=$arr_gp[0];
				$pdSQL_get_right = "SELECT user_ids,user_right FROM t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$get_album_id;
			 $pdSQLResult_get_right = mysqli_query($con,$pdSQL_get_right);
			 $result_get_right = mysqli_fetch_assoc($pdSQLResult_get_right);
			// $result_get_right = $objDb1->dbFetchArray();
				}
if(isset($_REQUEST['phid']))
{
$phid=$_REQUEST['phid'];
$pdSQL1="SELECT phid, pid, album_id, al_file, ph_cap FROM t027project_photos  WHERE pid= ".$pid." and album_id= ".$album_id." and  phid = ".$phid;
$pdSQLResult1 = mysqli_query($con,$pdSQL1);
$pdData1 = mysqli_fetch_assoc($pdSQLResult1);
//$pdData1 = $objDb->dbFetchArray();
$al_file=$pdData1['al_file'];
$ph_cap=$pdData1['ph_cap'];
}
if(isset($_REQUEST['delete'])&&isset($_REQUEST['phid'])&&isset($_REQUEST['album_id'])&&$_REQUEST['phid']!="")
{
@unlink($file_path.$al_file);
@unlink($file_thumb_path.$al_file);
  mysqli_query($con,"Delete from t027project_photos where phid=".$_REQUEST['phid']." and album_id=".$_REQUEST['album_id']);
 $activity="Album id(".$_REQUEST['album_id'].") photo id(".$_REQUEST['phid'].") - Photo Deleted Successfully";
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
 header("Location:sp_photo_album_input.php?album_id=$album_id");
}
/*$size=50;
$max_size=($size * 1024 * 1024);*/
if(isset($_REQUEST['save']))
{ 
    
	
	$ph_cap=addslashes($_REQUEST['ph_cap']);
	
	
		
		
	    //Loop through each file
        for($i=0; $i<count($_FILES['al_file']['name']); $i++) {
          //Get the temp file path
            $tmpFilePath = $_FILES['al_file']['tmp_name'][$i];

            //Make sure we have a filepath
            if($tmpFilePath != ""){
            
                //save the filename
              $shortname1 = $_FILES['al_file']['name'][$i];
			
				$ext = pathinfo($shortname1, PATHINFO_EXTENSION);
				$array_sname=explode(".",$shortname1);
				if(count($_FILES['al_file']['name'])==1 && $ph_cap!='')
				{
				$report_title=$ph_cap;
				}
				else
				{
				$report_title= trim($array_sname[0]);
				}
				$report_title_1=$array_sname[0];
				
		
		
				$file_name=genRandom(5)."-".$album_id.".".$ext;
               
			 	$target_file=$file_path.$file_name;
			
              

                
                if(move_uploaded_file($tmpFilePath, $target_file)) {
				
	
		///create thumbnail
	$thumb=TRUE;
	$thumb_width='150';
		if($thumb == TRUE)
        {
		
          	$thumbnail = $file_path."thumb/".$file_name;
            list($width,$height) = getimagesize($target_file);
			$thumb_height = ($thumb_width/$width) * $height;
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($target_file);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($target_file);
                    break;

                case 'png':
                    $source = imagecreatefrompng($target_file);
                    break;
			
                case 'gif':
                    $source = imagecreatefromgif($target_file);
                    break;
                default:
                    $source = imagecreatefromjpeg($target_file);
            }

            imagecopyresampled($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail);
            }

	}
	//// End thumbnails
	
	$sql_query="INSERT INTO t027project_photos(pid, album_id, al_file, original_file_name,ph_cap) Values(".$pid.",".$album_id.", '".$file_name."', '".$shortname1."', '".$report_title."' )";
	$sql_pro=mysqli_query($con,$sql_query);
	$insert_id=mysqli_insert_id($con);
	//$insert_id=$con->LastInsertId();
	if ($sql_pro == TRUE) {
    $message=  "New record added successfully";
	$activity=$album_id."-".$insert_id." - New photo record added successfully";
	} else {
    $message= "Error in adding photo Record";
	 $activity= "Error in adding photo Record";
	}
	
	
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
	}
				
              }
			
        }
	
	
	print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "</script>";
	
}

if(isset($_REQUEST['update']))
{
$ph_cap=addslashes($_REQUEST['ph_cap']);
$pdSQL = "SELECT a.phid, a.pid, a.album_id, a.al_file FROM t027project_photos a WHERE pid = ".$pid." and album_id=".$album_id." and phid=".$phid." order by phid";
$pdSQLResult = mysqli_query($con,$pdSQL);
$sql_num=mysqli_num_rows($pdSQLResult);
$pdData = mysqli_fetch_assoc($pdSQLResult);
$phid=$_REQUEST['phid'];
$old_al_file= $pdData["al_file"];
		if($old_al_file){
			if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
			{			
				@unlink($file_path . $old_al_file);
				@unlink($file_thumb_path . $old_al_file);
			}
					
				}
	if(isset($_FILES["al_file"]["name"])&&$_FILES["al_file"]["name"]!="")
	{
            
                //save the filename
				$tmpFilePath = $_FILES['al_file']['tmp_name'];
                $shortname1 = $_FILES['al_file']['name'];
				$ext = pathinfo($shortname1, PATHINFO_EXTENSION);
				$array_sname=explode(".",$shortname1);
				if(count($_FILES['al_file']['name'])==1 && $ph_cap!='')
				{
				$report_title=$ph_cap;
				}
				else
				{
				$report_title= trim($array_sname[0]);
				}
				$report_title_1=preg_replace("/[^a-zA-Z0-9.]/", "", $array_sname[0]);
				$shortname=$shortname1.$ext;
				
				
		
		
				$file_name=genRandom(5)."-".$album_id.".".$ext;
                //save the url and the file
				$target_file=$file_path.$file_name;
              //  $filePath = $report_path."/".$filename;

                
                if(move_uploaded_file($tmpFilePath, $target_file)) {
	
		///create thumbnail
	$thumb=TRUE;
	$thumb_width='150';
		if($thumb == TRUE)
        {
		
          	$thumbnail = $file_path."thumb/".$file_name;
            list($width,$height) = getimagesize($target_file);
			$thumb_height = ($thumb_width/$width) * $height;
            $thumb_create = imagecreatetruecolor($thumb_width,$thumb_height);
            switch($ext){
                case 'jpg':
                    $source = imagecreatefromjpeg($target_file);
                    break;
                case 'jpeg':
                    $source = imagecreatefromjpeg($target_file);
                    break;

                case 'png':
                    $source = imagecreatefrompng($target_file);
                    break;
                case 'gif':
                    $source = imagecreatefromgif($target_file);
                    break;
                default:
                    $source = imagecreatefromjpeg($target_file);
            }

            imagecopyresampled($thumb_create,$source,0,0,0,0,$thumb_width,$thumb_height,$width,$height);
            switch($ext){
                case 'jpg' || 'jpeg':
                    imagejpeg($thumb_create,$thumbnail);
                    break;
                case 'png':
                    imagepng($thumb_create,$thumbnail);
                    break;

                case 'gif':
                    imagegif($thumb_create,$thumbnail);
                    break;
                default:
                    imagejpeg($thumb_create,$thumbnail);
            }

	}
	//// End thumbnails
	 $sql_pro="UPDATE t027project_photos SET ph_cap='$report_title', al_file='$file_name' where phid=$phid and album_id=$album_id";
	
	$sql_proresult=mysqli_query($con,$sql_pro);
	
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
		$activity=  $album_id."-".$phid." - Photo Record updated successfully";
	} else {
		$message= "Error in updating photo record";
		$activity= "Error in updating photo record";
	}
	
	
	}
	
  
	
	}
	else
	{
	 $sql_pro="UPDATE t027project_photos SET ph_cap='$ph_cap' where phid=$phid and album_id=$album_id";
	
	$sql_proresult=mysqli_query($con,$sql_pro);
	
	
		if ($sql_proresult == TRUE) {
		$message=  "Record updated successfully";
		$activity=  $album_id."-".$phid." - Photo Record updated successfully";
	} else {
		$message= "Error in updating photo record";
		$activity= "Error in updating photo record";
	}
	}
	$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "</script>";
header("Location: sp_photo_album_input.php?album_id=$album_id");
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
<script type="text/javascript">

function cancelButton()
{
 window.opener.location.reload();
 self.close();
}
function required(){
	
		
	var x = document.forms["form2"]["ph_cap"].value;
		var uploadPhoto = document.forms["form2"]["al_file"].value;
		var uploadPhoto_old = document.forms["form2"]["old_al_file"].value;
	
  if (x == "") {
    alert("Caption must be filled out");
    return false;
  }
   if (uploadPhoto == "" && uploadPhoto_old=="") {
    alert("Photo must be uploaded first");
    return false;
  }
	
	
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
                <h3 class="card-title">Manage Photos</h3>
                </div>
              
                  <form class="forms-sample" action="sp_photo_album_input.php?album_id=<?php echo $album_id; ?>" method="post" id="add_details" enctype="multipart/form-data"  onSubmit="return required()">
                   <input class="form-control"  type="hidden" style="width:300px;" id="palid" name="palid" value="<?php echo $album_id;?>">
                <div class="card-body">
                
               
                <div class="form-group">
                <label for="exampleInputPassword1">Photo Caption</label>
                  <input   type="text"  class="form-control" id="exampleInputPassword1"  name="ph_cap" value="<?php echo $ph_cap;?>"  placeholder="Enter The Photo Caption Here" maxlength="250" Required>

                </div>
                 <div class="form-group">
                <?php if(isset($_GET['phid']))
		{
		?>
        <input  type="file" name="al_file" id="al_file"  class="form-control" />
        <input type="hidden" name="old_al_file" value="<?php echo $pdData1['al_file'];?>" />
	
		<?php
		}
		else
		{?>
         <input  type="file" name="al_file[]" id="al_file" multiple="multiple"  class="form-control" /><div id="selectedFiles"></div>
     
		 <input type="hidden" name="old_al_file" value="" />
		<?php }	?>
         <strong>Note:</strong>  max_file_uploads=20 <br />upload_max_filesize=1028M
                </div>
                 
                 
              
                </div>
                <div class="card-footer">
                
                
                
                
                <?php if(isset($_REQUEST['phid']))
	 {
		 
	 ?>
     <input type="hidden" name="phid" id="phid" value="<?php echo $_REQUEST['phid']; ?>" />
     <input  type="submit" name="update" id="update" value="Update"  class="btn btn-primary"/>
	 <?php
	 }
	 else
	 {
	 ?>
	 <input  type="submit" name="save" id="save" value="Save"  class="btn btn-primary"/>
	 <?php
	 }
	 ?> 
     <input  type="button" name="cancel" id="cancel" value="Cancel"   onclick="cancelButton();" class="btn btn-primary"/>
                
               
              
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
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Photo Caption</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Thumb</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Action</th>
                     
                    </tr>
                  </thead>                  <tbody>
                      <tbody>
                  <?php
						 $pdSQL = "SELECT phid, pid,album_id, al_file, ph_cap FROM t027project_photos WHERE pid = ".$pid." and album_id=".$album_id." order by phid";
						 $pdSQLResult = mysqli_query($con,$pdSQL);
						
							  if(mysqli_num_rows($pdSQLResult)>=1)
							  {
								  $i=1;
							  while($pdData=mysqli_fetch_assoc($pdSQLResult))
							  {
							  
							 
							  ?>
                   
                     <tr>
                      
                        <td style="vertical-align: middle; text-align:center;"><?php echo $i;?></td>
                        <td style="vertical-align: middle; text-align:left;"><?php echo $pdData['ph_cap'];?></td>
                        <td style="vertical-align: middle; text-align:center;"><img src="<?php echo $file_path."thumb/".$pdData["al_file"];?>"  width="50" height="50"/></td>
                      
                        
                       
                       
                       
                       
                        <td style="vertical-align: middle; text-align:center;">
                        
                                         <span style="float:left"><form action="sp_photo_album_input.php?phid=<?php echo $pdData['phid']; ?>&album_id=<?php echo $pdData['album_id']; ?>" method="post"><input type="submit" name="edit" id="edit" value="Edit" /></form></span>
                 <span style="float:right"><form action="sp_photo_album_input.php?phid=<?php echo $pdData['phid'] ?>&album_id=<?php echo $pdData['album_id']; ?>" method="post"><input type="submit" name="delete" id="delete" value="Del" onClick="return confirm('Are you sure, you want to delete this Photo?')" /></form></span>

                        
                        </td> 
                        
                      </tr>
                  <?php
				 $i++;		
			}
		
						
						
						
						
						}
							 else
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
