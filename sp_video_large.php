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
 
if(isset($_REQUEST["vid"]))
{
$vid=$_REQUEST['vid'];
}


						 $pid=1;
$data_url="photos/";

 $album_id=$_REQUEST['album_id'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - Photos Videos Gallery</title>
  </head>
  <body>
<div id="content">
<!--<h1> Pictorial Analysis Control Panel</h1>-->
<table style="width:100%; height:100%">
  <tr style="height:10%">
    <td align="center" style="font-family:Verdana, Geneva, sans-serif; font-size:24px; font-weight:bold;"><span><?php  
			
			
			
			$pdSQL = "SELECT vid, pid, v_cap,v_al_file FROM t32project_videos WHERE vid = ".$vid." order by vid";
			 $pdSQLResult = mysqli_query($con,$pdSQL);
			$result = mysqli_fetch_assoc($pdSQLResult);
			echo $result["v_cap"];?></span></td></tr>
  <tr style="height:45%"><td align="center"><table width="650" class="table table-bordered">
                              <thead>
                              </thead>
                              <tbody>
				
                        <tr>
                          <td>
                          <video id="my-video" class="video-js" controls preload="auto" width="640" height="350"
  poster="photos/thumbs/vidoe.jpg" data-setup="{}">
   
    <source src="<?php echo $data_url.$result["v_al_file"];?>" type='video/mp4'>
  
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a web browser that
      <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
    </p>
  </video></td>
                        </tr>
                              </tbody>
      </table></td></tr>
  
  </table>
</div>
</body>
</html>






