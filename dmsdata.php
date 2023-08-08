<?php
include_once("db.php");
$lastupdated = $_REQUEST['lastupdated'];
//echo $lastupdated = "2023-07-14";
//$name = $_REQUEST['usernamelogin'];
//$email = $_REQUEST['emailylogin'];
//$ip = $_REQUEST['ip_address'];
//echo $sql="insert into dms_update_data (item_value1) values ('$lastupdated') where project_id=5061184";
mysqli_query($con, "update dms_update_data set item_value1='$lastupdated' where project_id=5061184");
mysqli_close($con);
?>