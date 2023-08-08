<?php  
$_SESSION["uid"]=1; 
$_SESSION["user_name"]="Abdul Waqar";
$_SESSION["user_type"]=1;

$uid=$_SESSION["uid"]; 
 $sql = "select * from saca_dashboard.direct_users where uid = $uid";
	$stmt = mysqli_query($con,$sql);
	 $num_rows  = mysqli_num_rows($stmt)+0;
	$data = mysqli_fetch_assoc($stmt);
	$user_type=$data['user_type'];
	 $kpi=$data['kpi'];
	$ppr=$data['ppr'];
	$pmis=$data['pmis'];
	
	$cvbank=$data['cvbank'];
	$hr=$data['hr'];
	$software_portal=$data['software_portal'];
	
	$team_finder=$data['team_finder'];
	$bd_dashboard=$data['bd_dashboard'];
	$div_dms=$data['div_dms'];
	
	$aibot=$data['aibot'];
	$eshs=$data['eshs'];

	$photo_video=$data['photo_video'];
	$apps=$data['apps'];
	$samepage_log=$data['samepage_log'];
  ?>
	


