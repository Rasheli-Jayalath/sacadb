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

$data_url="photos/";
$pid=1;

 $album_id=$_REQUEST['album_id'];
/*if($pmis==0)
{
header("Location:index.php");	
}*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - Photos Videos Gallery</title>
   <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Ekko Lightbox -->
  <link rel="stylesheet" href="theme/plugins/ekko-lightbox/ekko-lightbox.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  
  
  
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
            <h1>Gallery</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Gallery</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          
          <div class="col-12">
            <div class="card card-primary">
              <div class="card-header">
                <h4 class="card-title">PHOTO / VIDEO ALBUMS</h4>
              </div>
              
                 <?php if($_REQUEST['album_id']){
    ?>
  <div class="card-body">
               <div>
                  <div class="mb-2" style="text-align:right" >
                                      
                         <a class="btn btn-secondary" href="javascript:void(0)"  onclick="window.open('sp_video_input.php?album_id=<?php echo $album_id; ?>', 'newwindow', 'left=600,top=60,width=870,height=800');return false;" data-shuffle>Manage Videos</a>  
                         <a class="btn btn-secondary" href="javascript:void(0)"  onclick="window.open('sp_photo_album_input.php?album_id=<?php echo $album_id; ?>', 'newwindow', 'left=600,top=60,width=870,height=800');return false;" data-shuffle>Manage Photos</a>  
                         <a class="btn btn-secondary" href="javascript:void(0)"  onclick="window.open('sp_subalbum_input.php?cat_id=<?php echo $album_id; ?>', 'newwindow', 'left=600,top=60,width=870,height=800');return false;" data-shuffle>Manage Albums</a>  
                         <a class="btn btn-secondary" href="javascript:void(0)"  onclick="location.href='gallery.php'" data-shuffle><?php echo "View Album"; ?></a>  

    
  
                                      
                  </div>
                   <?php
  // } 
  
	//}
?>
                  <div class="btn-group w-100 mb-2" style="padding-bottom:10px">
                  <?php 
	
	 $sqlss="select parent_group, status from t031project_albums where albumid=$album_id";
	$sqlrwss=mysqli_query($con,$sqlss);
	$sqlrw1ss=mysqli_fetch_assoc($sqlrwss);
	//$sqlrw1ss=$objDb->dbFetchArray();
	$par_groups=$sqlrw1ss['parent_group'];
	$status=$sqlrw1ss['status'];
	$par_arr=explode("_",$par_groups);
	$lenns=count($par_arr);
	$album_name_track="";

	for($i=0;$i<$lenns;$i++)
	{
	 $sqlCN="select album_name,parent_album from t031project_albums where albumid='$par_arr[$i]' ";
		
	$sqlrCN=mysqli_query($con,$sqlCN);
	$sqlCNrw=mysqli_fetch_assoc($sqlrCN);
	//$sqlCNrw=$objDb1->dbFetchArray();
	
		$category_name_lang=$sqlCNrw["album_name"];
	
	
	$album_name_track .='<strong><a style="font-size:14px" href="gallery.php?cat_id='.$sqlCNrw["parent_album"].'&album_id='.$par_arr[$i].'">'.$category_name_lang.'</a></strong>';
	
	$album_name_track .="&nbsp;&raquo;&nbsp;";
	
	//$category_name .=$category_name;
	}
   $report_category=$album_name_track;
   ?>
                      <h4 class="card-title"><?php echo $report_category;?></h4>
                  </div>
                </div>

  
                <div class="row">
  <?php $cm=0;
		 $pdSQL = "SELECT * FROM t031project_albums  WHERE pid= ".$pid." and status=1 and parent_album=".$album_id." order by album_order asc";
			 $pdSQLResult = mysqli_query($con,$pdSQL);
		
			if(mysqli_num_rows($pdSQLResult) >= 1){
				
				while($result=mysqli_fetch_assoc($pdSQLResult)){
					
				$album_idn=$result['albumid'];
				$p_group=$result['parent_group'];
				$arr_gp=explode("_", $p_group);
				$get_album_id=$arr_gp[0];
			$pdSQL_get_right = "SELECT user_ids,user_right FROM t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$get_album_id;
			 $pdSQLResult_get_right = mysqli_query($con,$pdSQL_get_right);
			 $result_get_right=mysqli_fetch_assoc($pdSQLResult_get_right);
			// $result_get_right = $objDb1->dbFetchArray();
			 
				
			$pdSQL_r = "SELECT phid, pid, al_file, ph_cap FROM t027project_photos WHERE pid = ".$pid." and album_id=".$album_idn." limit 0,1";
			 $pdSQLResult_r =mysqli_query($con,$pdSQL_r);
			if(mysqli_num_rows($pdSQLResult_r) >= 1)
			{
			
				$result_r=mysqli_fetch_assoc($pdSQLResult_r);
				//$result_r = $objDb2->dbFetchArray();
				$al_file_r=$result_r['al_file'];
				$al_file_r="images/empty_album.png";
			}
			else
			{
			$al_file_r="images/empty_album.png";
			}
				
				
/*	if($_SESSION['user_type']==1)
			{*/
			?>	
            
             <div class="col-sm-2" style="text-align:center">
                  <a  href="gallery.php?album_id=<?php echo $result['albumid'];?>" >	
           
	<img  src="<?php echo $al_file_r; ?>" class="img-fluid mb-2" alt="white sample">
	
	</a>
	<div  style="margin-left:10px">
	<?php echo $result['album_name']; ?> </div>
	</div>
	

            <?php
			$cm++;
			//}
			
			
			}} ?>
           </div>
           </div>
           
           
            <div class="card-body">
               <div class="btn-group w-100 mb-2" style="background-color:#117a8b;       font-size: 1.2rem;    font-weight: 400;    padding: 7px;     border-radius:.25rem; color:white">
                      Photos
					  <?php  $pdSQL1 = "SELECT phid, pid, al_file, ph_cap FROM t027project_photos WHERE pid = ".$pid." and album_id=".$album_id." order by phid";
			 $pdSQLResult1 =mysqli_query($con,$pdSQL1);
			if(mysqli_num_rows($pdSQLResult1) >= 1){ 
			
			?>
            <!--<span style=" text-align:right; font-size: 1.1rem; width:90%; margin-top:3px">
            <input style=" font-size:12px;"  type="checkbox" name="chkAll" id=
          "chkAll" value="1" form="reports_cat" onclick="selectAllUnSelectAll(this,'file_download[]',reports_cat);"/> Select/Unselect All &nbsp;&nbsp;&nbsp;&nbsp;</span><span>
          <input type="submit" name="download_submit" id="download_submit" value="Download Files" form="reports_cat" class="btn btn-secondary" /></span>-->
           <?php
			}
			?>
                  </div>
           
            

                <div class="row">
          
 <?php  
			
			 $cm=0;
			$pdSQL = "SELECT phid, pid, al_file, ph_cap FROM t027project_photos WHERE pid = ".$pid." and album_id=".$album_id." order by phid";
			 $pdSQLResult = mysqli_query($con,$pdSQL);
			if(mysqli_num_rows($pdSQLResult) >= 1){
				while($result=mysqli_fetch_assoc($pdSQLResult)){
				
				
				?>
				<?php if($result['al_file']!="")
				{
				$file_array=explode(".",$result['al_file']);
				$file_type=$file_array[1];
				if(($file_type=="jpeg") || ($file_type=="jpg") || ($file_type=="gif") || ($file_type=="png") || ($file_type=="JPG")|| ($file_type=="JPEG")|| ($file_type=="PNG") || ($file_type=="GIF")|| ($file_type=="jfif"))
				{
				?>
                
                <div class="col-sm-2" style="text-align:center">
                 <a  href=" <?php echo $data_url.$result['al_file']; ?>" data-toggle="lightbox" data-title="<?php echo $result['ph_cap']; ?>" data-gallery="gallery" >
       
       
	<div style=" padding: 3px;margin-bottom: 3px;">	
	<img src="<?php //echo $data_url."thumb/".$result['al_file'];
	echo $data_url."thumb/".$result['al_file']; ?>"   title="<?php echo $result['al_file'];?>" class="img-fluid mb-2" alt="black sample"  style="width:150px; height:150px"/>
    </div>
	 	</a>
        <div align="center">
     <input type="checkbox" class="checkbox"    name="file_download[]"  value="<?php echo $result['phid'];?>" form="reports_cat" onclick="selectUnSelect_top(this,reports_cat);"/>
		<?php if(strlen($result['ph_cap'])>15)
		{
		echo substr($result['ph_cap'],0,15)."...";
		}
		else
		{
		echo $result['ph_cap'];
		} ?>				     </div>
        </div>
                
                
                
                
				
            <?php
				}
				
				}
				?>
                
                <?php
				}
			}
			else
			{
				?>
                 <div class="col-sm-2">
             <?php    
			 echo "No Record Found";?>
             </div>
			<?php
			}?>
            
            </div>
                
                </div>
                
                
                <div class="card-body">
               <div class="btn-group w-100 mb-2" style="background-color:#117a8b;       font-size: 1.2rem;    font-weight: 400;    padding: 7px;     border-radius:.25rem; color:white">
                  <?php echo "Videos"; ?>
			  <?php  $pdSQL1 = "SELECT vid, pid,album_id,v_cap,v_al_file FROM t32project_videos WHERE pid = ".$pid." and album_id=".$album_id." order by vid";
			 $pdSQLResult1 = mysqli_query($con,$pdSQL1);
			if(mysqli_num_rows($pdSQLResult1) >= 1){ 
			
			?>
              <!-- <span style=" text-align:right; font-size: 1.1rem; width:98%; margin-top:3px">
            <input type="submit" name="download_submitv" id="download_submitv" value="Download Files" form="reports_catv"  class="btn btn-secondary"  /></span>-->
           
           <?php
			}
			?>
                  </div>
           
            

                <div class="row">
                
                
                
                 <?php  
			
			 $cm=0;
			 $pdSQL = "SELECT vid, pid,album_id,v_cap,v_al_file FROM t32project_videos WHERE pid = ".$pid." and album_id=".$album_id." order by vid";
			 $pdSQLResult = mysqli_query($con,$pdSQL);
			if(mysqli_num_rows($pdSQLResult) >= 1){
				while($result=mysqli_fetch_assoc($pdSQLResult)){
				
				?>
               
	<?php if($result['v_al_file']!="")
				{
				$file_array=explode(".",$result['v_al_file']);
				$file_type=$file_array[1];
				
				?>
                <div class="col-sm-2" style="text-align:center">
				 <a  href="javascript:void(null);" onclick="window.open('sp_video_large.php?video=<?php echo $result['v_al_file'];?>&vid=<?php echo $result['vid'];?>&album_id=<?php echo $album_id;?>', 'View Video ','width=700px,height=550px,toolbar=0,menubar=0,location=0,status=0,scrollbars=0,resizable=0,left=0,top=0');"  
     style="margin-top:20px;text-decoration:none"  alt="<?php echo $result['v_cap'];?>">
                 <img src="images/video_file_icon.jpg" width="150" height="100" border="0"  title="<?php echo $result['v_al_file'];?>"/></a>
                 <div align="center" >
       <input type="checkbox" class="checkboxv"    name="file_downloadv[]"  value="<?php echo $result['vid'];?>" form="reports_catv" onclick="selectUnSelect_topv(this,reports_catv);"/>
		<?php if(strlen($result['v_cap'])>15)
		{
		echo substr($result['v_cap'],0,15)."...";
		}
		else
		{
		echo $result['v_cap'];
		} ?>				     </div>
        </div>
			               
                 <?php
				 
				}?>
            <?php 
			$cm++;
			
			}}
			else
			{
				?>
                 <div class="col-sm-2">
             <?php    
			 echo "No Record Found";?>
             </div>
			<?php
			}?>
          
 
            
            </div>
                
                </div>
                
                
                
                
                
            </td></tr>
        
         
     
  </tbody>
		</table>
        </div>
        <?php
   } 
   else
{
	?>
              <div class="card-body">
                <div class="row">
                 <?php  
			$parent_album=0;
			 $cm=0;
			 $pdSQL = "SELECT albumid,  parent_album,pid, album_name, status FROM t031project_albums  WHERE pid= ".$pid." and status=1 and parent_album=".$parent_album." order by albumid";
			$albumres=mysqli_query($con,$pdSQL);
			 if(mysqli_num_rows($albumres)>= 1)
			{
			while($result=mysqli_fetch_assoc($albumres))
				{
				$album_id=$result['albumid'];
				  $pdSQL_get_right = "SELECT user_ids,user_right FROM t031project_albums  WHERE pid= ".$pid." and status=1 and albumid=".$album_id;
			// $pdSQLResult_get_right = mysql_query($pdSQL_get_right);
		$albumrightsres=	mysqli_query($con,$pdSQL_get_right);
			$result_get_right=mysqli_fetch_assoc($albumrightsres);
			//$result_get_right =$objDb2->dbFetchArray();
				$pdSQL_r = "SELECT phid, pid, al_file, ph_cap FROM t027project_photos WHERE pid = ".$pid." and album_id=".$album_id." limit 0,1";
				
				$photosres=mysqli_query($con,$pdSQL_r);
			 if(mysqli_num_rows($photosres)>= 1)
			{
			$result_r=mysqli_fetch_assoc($photosres);	
			//$result_r =$objDb->dbFetchArray();
			
				$al_file_r=$result_r['al_file'];
			}
			else
			{
			$al_file_r="no_image.jpg";
			}
				
				?>
                
                
                
                
                
                  <div class="col-sm-2" style="text-align:center">
                  <a  href="gallery.php?album_id=<?php echo $result['albumid'];?>" >
<!--                    <a href="http://localhost/sacadb/images/no_image.png" data-toggle="lightbox" data-title="sample 1 - white" data-gallery="gallery">
-->                      <img src="images/empty_album.png" class="img-fluid mb-2" alt="white sample"/>
                    </a>
                   <div  >
	<?php echo $result['album_name']; ?>				     </div>
                  </div>
                  <?php 
			$cm++;
			
			}}?>
                </div>
              </div>
              <?php
}
?>
            </div>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Ekko Lightbox -->
<script src="theme/plugins/ekko-lightbox/ekko-lightbox.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<!-- Filterizr-->
<script src="theme/plugins/filterizr/jquery.filterizr.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme/dist/js/demo.js"></script>
<!-- Page specific script -->
<script>
  $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });
  })
</script></body>
</html>
