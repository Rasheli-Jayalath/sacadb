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
if($_REQUEST['t']==1)
{

 $multiple="multi_selection:true,";
}
else if($_REQUEST['t']==2)
{
	
	$multiple="multi_selection:false,";
}
else
{
	
	$multiple="multi_selection:false,";
}


$album_id=$_REQUEST['album_id'];
 $pdSQL_get_right1 = "SELECT parent_group FROM  t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$album_id;
			                $pdSQLResult_get_right1 = mysqli_query($con,$pdSQL_get_right1);
							$result_get_right1 = mysqli_fetch_assoc($pdSQLResult_get_right1);
			               // $result_get_right1 = $objDb->dbFetchArray(); 
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
if(isset($_REQUEST['vid']) && $_REQUEST['vid']!="")
{
$vid=$_REQUEST['vid'];
$pdSQL1="SELECT vid, pid,album_id,v_cap, v_al_file  FROM t32project_videos  WHERE pid= ".$pid." and album_id= ".$album_id." and  vid = ".$vid;
$pdSQLResult1 =mysqli_query($con,$pdSQL1);
$pdData1 = mysqli_fetch_assoc($pdSQLResult1);
//$pdData1 = $objDb->dbFetchArray();
$v_al_file=$pdData1['v_al_file'];
$v_cap=$pdData1['v_cap'];
}
if(isset($_REQUEST['delete'])&&isset($_REQUEST['vid'])&&isset($_REQUEST['album_id'])&&$_REQUEST['vid']!="")
{
@unlink($file_path.$v_al_file);
mysqli_query($con,"Delete from t32project_videos where vid=".$_REQUEST['vid']." and album_id=".$_REQUEST['album_id']);
  $activity="Album id(".$_REQUEST['album_id'].") video id(".$_REQUEST['vid'].") - Video Deleted Successfully";
$iSQL = ("INSERT INTO pages_visit_log (log_id,request_url) VALUES ('$log_id','$activity')");
//$objDb1->dbQuery($iSQL);
 header("Location: sp_video_input.php?album_id=$album_id");
}

if($_SERVER['REQUEST_METHOD'] == "POST" &&  isset($_REQUEST['save']))
{ 

 $filename=$_REQUEST['report_file'];
 $dkey=$_REQUEST['dkey'];
			
    $v_cap=$_REQUEST['v_cap'];
	
	$report_id = trim($_REQUEST['vid']);
	
	
		$files_arr=explode("@@@",$filename);		
		//$original_filename_arr=explode("@@@",$original_filename);
		$total_files=count($files_arr);		
        for($i=0; $i<$total_files-1; $i++) {
			$filenamepart=$files_arr[$i];
          		$files_arr_sep=explode("###",$filenamepart);
				$original_name=addslashes($files_arr_sep[0]);
				$filename=$files_arr_sep[1];
					$ext = pathinfo($filename, PATHINFO_EXTENSION);
           
				if($total_files==2)
				{
				$report_title=$cat_title;
				}
				else
				{
				$justname=str_replace(".".$ext,"",$original_name);
				$report_title	= $cat_title."-".str_replace("'","",$justname);
				}
				
				
				$sql_pro_ins="INSERT INTO t32project_videos(pid,album_id,v_cap) Values(".$pid.",".$album_id.", '".$v_cap."' )";
				
				$query_res=mysqli_query($con,$sql_pro_ins);
				$report_idd=mysqli_insert_id($con);
				//$report_idd=$con->LastInsertId();	
					
					
		
		
				
				?>
				
				 
    
	<?php			
				
			
                $filePath = $report_path."/".$filename;	
                $sql_upd="update t32project_videos set v_al_file='".$filename."' ,o_v_al_file	='".$original_name."' where vid=".$report_idd;
				mysqli_query($con,$sql_upd);
				$sql_del_rec="delete from rs_tbl_videos_stored where document_name='".$filename."' and distinct_key='".$dkey."'";
				mysqli_query($con,$sql_del_rec);
				
				
	print "<script type='text/javascript'>";
    print "window.opener.location.reload();";
    print "self.close();";
    print "</script>";
			
        }
	

	
}
if(isset($_REQUEST['update']))
{
$v_cap=addslashes($_REQUEST['v_cap']);
 $filename=$_REQUEST['report_file'];
 $dkey=$_REQUEST['dkey'];
	
			$r_idd=$_REQUEST['vid'];
			
			
					$sql_pro_ins = "update t32project_videos set v_cap='$v_cap' where vid=".$r_idd." and album_id=".$album_id;
					 $query_res=mysqli_query($con,$sql_pro_ins);
					 
					if($filename!="")
					{
						$cquery_fi = "select v_al_file from  t32project_videos WHERE vid = ".$r_idd;
						$cresult_fi=mysqli_query($con,$cquery_fi);
						$cdata_fi = mysqli_fetch_assoc($cresult_fi);
						//$cdata_fi = $objDb3->dbFetchArray();
						$r_file=$cdata_fi['v_al_file'];
						@unlink(REPORT_PATH . $r_file);
						$files_arr=explode("@@@",$filename);	
						
						 for($i=0; $i<1; $i++) {
				$filenamepart=$files_arr[$i];
          		$files_arr_sep=explode("###",$filenamepart);
				$original_name=addslashes($files_arr_sep[0]);
				$filename=$files_arr_sep[1];	
				
				
				
				$filePath = $report_path."/".$filename;
			
                $sql_upd="update t32project_videos set v_al_file='".$filename."' ,o_v_al_file='".$original_name."' where vid=".$r_idd;
				mysqli_query($con,$sql_upd);
				$sql_del_rec="delete from rs_tbl_videos_stored where document_name='".$filename."' and distinct_key='".$dkey."'";
				mysqli_query($con,$sql_del_rec);
				
					}
					 }
			
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
	
	var x = document.forms["form2"]["v_cap"].value;
	var uploadPhoto = document.forms["form2"]["report_file"].value;
	var uploadPhoto_old = document.forms["form2"]["old_report_file"].value;

  if (x == "") {
    alert("Caption must be filled out");
    return false;
  }
   /*if (uploadPhoto == "" && uploadPhoto_old=="") {
    alert("Video must be uploaded first");
    return false;
  }*/
  if (uploadPhoto == "" && uploadPhoto_old=="" ) {
    alert("Video must be uploaded first");
    return false;
  }
	
	//  return true;
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
                <h3 class="card-title">Manage Videos</h3>
                </div>
              
  <form  name="form2" action="" target="" method="post"  enctype="multipart/form-data" onsubmit="return required();">
                    
                <div class="card-body">
                
               
                <div class="form-group">
                <label for="exampleInputPassword1">Photo Caption</label>
                  <input   type="text"  class="form-control" id="exampleInputPassword1"  name="v_cap" value="<?php echo $v_cap;?>"    placeholder="Enter The Video Caption Here">

                </div>
                 <div class="form-group">
         <?php if(isset($_REQUEST['vid']) && $_REQUEST['vid']!="")
	 {
		 $vid=$_REQUEST['vid'];
$pdSQL2="SELECT  v_al_file  FROM t32project_videos  WHERE pid= ".$pid." and album_id= ".$album_id." and  vid = ".$vid;
$pdSQLResult2 =mysqli_query($con,$pdSQL2);
$pdData2 = mysqli_fetch_assoc($pdSQLResult2);
//$pdData2 = $objDb->dbFetchArray();
$v_al_file=$pdData2['v_al_file']; 
	 ?>
      <input type="hidden" name="report_file" id="report_file" value="" >
       <input type="hidden" name="old_report_file" id="old_report_file" value="<?php echo $v_al_file; ?>" >
             <input type="hidden" name="vid" id="vid" value="<?php echo $_GET['vid'];?>" >
              <input type="hidden" id="success_uploaded" value="">
                <div id="list"></div>
                <input type="hidden" id="dkey" name="dkey" value="<?php echo uniqid();?>">
      <input type="button" id="fileInput" value="Upload">
	 <?php
	 }
	 else
	 {
		 ?>
   <input type="hidden" name="report_file" id="report_file" value="" >
   <input type="hidden" name="old_report_file" id="old_report_file" value="" >
                   <input type="hidden" name="vid" id="vid" value="" >
              
                <!-- File Progress Bar -->
               <div id="list"></div>
                <input type="hidden" id="dkey" name="dkey" value="<?php echo uniqid();?>">
      <input type="button" id="fileInput" value="Upload">
                <input type="hidden" id="success_uploaded" value="">
  
  <?php
	 }
	 ?>
  
       
                </div>
                 
                 
              
                </div>
                <div class="card-footer">
                
               <?php if(isset($_REQUEST['vid']) && $_REQUEST['vid']!="")
	 {
		 
	 ?>
     
    
     <input type="submit" id="add_report"  name="update" class="btn btn-primary" value="<?php echo "Update"?>"  />
	 <?php
	 }
	 else
	 {
	 ?>
     <input type="submit" id="add_report"  name="save" cclass="btn btn-primary" value="<?php echo "Save";?>"  />

	 <?php
	 }
	 ?> <input  type="button" name="cancel" id="cancel" value="Cancel" onclick="cancelButton();" cclass="btn btn-primary"/> 
                
     
                </div>
                </form>
                <script src="plupload/js/plupload.full.min.js"></script>


    <script>
    // (C) INITIALIZE UPLOADER
    window.onload = () => {
      // (C1) GET HTML FILE LIST
	  var upfiles="";
	  var total_files=0;
	  var count_upload=0;
	  var distinctkey=document.getElementById("dkey").value;
	  var list = document.getElementById("list");

      // (C2) INIT PLUPLOAD
      var uploader = new plupload.Uploader({
        runtimes: "html5",
        browse_button: "fileInput",
        url: "upload.php?dkey="+distinctkey,
        chunk_size: "10mb",
		 <?php echo $multiple;?>
        init: {
          PostInit: () => list.innerHTML = "<div>Ready</div>",
          FilesAdded: (up, files) => {
			  total_files=files.length;
			  document.getElementById('fileInput').disabled = true;
			  document.getElementById('add_report').disabled = true;
            plupload.each(files, file => {
              let row = document.createElement("div");
              row.id = file.id;
              row.innerHTML = `${file.name} (${plupload.formatSize(file.size)}) <b></b>`;
              list.appendChild(row);
			 
            });
            uploader.start();
          },
          UploadProgress: (up, file) => {
            document.querySelector(`#${file.id} b`).innerHTML = '<span style="font-weight:bold; font-size:14px">' +`${file.percent}%`+ "</span>";
          },
		    FileUploaded: (up, file, result)  => {
				
                 //  var responseData = result.response.replace('"{', '{').replace('}"', '}');
				  var responseData = result.response;
				 
                  var objResponse = JSON.parse(responseData);
				  
				  count_upload=count_upload+1;
				  upfiles+=file.name+"###"+objResponse.info+"@@@";					
                document.getElementById('report_file').value = upfiles;				
					if(count_upload==total_files)
					{
						alert("equal");
					document.getElementById('success_uploaded').value = '100';				
					document.getElementById('add_report').disabled = false;
					}
                },
				
          Error: (up, err) => console.error(err)
        }
      });
      uploader.init();
    };
    </script>
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
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Video Caption</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Thumb</th>
                      <th style="vertical-align: middle; text-align:center;background-color: #336992; " id="th">Action</th>
                     
                    </tr>
                  </thead>                  <tbody>
                      <tbody>
                  <?php
						$pdSQL = "SELECT vid, pid,album_id,v_cap, v_al_file  FROM t32project_videos WHERE pid = ".$pid." and album_id=".$album_id." order by vid";
						 $pdSQLResult = mysqli_query($con,$pdSQL);
						
							  if(mysqli_num_rows($pdSQLResult)>=1)
							  {
								  $i=1;
							  while($pdData = mysqli_fetch_assoc($pdSQLResult))
							  { 
							 
							  ?>
                   
                     <tr>
                      
                        <td style="vertical-align: middle; text-align:center;"><?php echo $i;?></td>
                        <td style="vertical-align: middle; text-align:left;"><?php echo $pdData['v_cap'];?></td>
                        <td style="vertical-align: middle; text-align:center;"><a  href="javascript:void(null);" onclick="window.open('sp_video_large.php?video=<?php echo $pdData['v_al_file'];?>&vid=<?php echo $pdData['vid'];?>&album_id=<?php echo $album_id;?>', 'View Video ','width=700px,height=550px,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0');"  
     style="margin-top:20px;text-decoration:none"  alt="<?php echo $pdData['v_cap'];?>">
                 <img src="images/video_file_icon.jpg" width="50" height="50" border="0"  title="<?php echo $result['v_al_file'];?>"/></a></td>
                      
                        
                       
                       
                       
                       
                        <td style="vertical-align: middle; text-align:center;">
                  <span style="float:left"><form action="sp_video_input.php?vid=<?php echo $pdData['vid'] ?>&album_id=<?php echo $pdData['album_id']; ?>" method="post"><input type="submit" name="edit" id="edit" value="Edit" /></form></span>
                   <span style="float:right"><form action="sp_video_input.php?vid=<?php echo $pdData['vid'] ?>&album_id=<?php echo $pdData['album_id']; ?>" method="post"><input type="submit" name="delete" id="delete" value="Del" onclick="return confirm('Are you sure?')" /></form></span>

                        
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
