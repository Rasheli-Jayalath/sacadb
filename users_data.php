<?php
include_once("db.php");
$sql = "select * from saca_dashboard.users_logs";
$result = mysqli_query($con, $sql);
while ($data = mysqli_fetch_array($result)){
	echo "<br />=================================";
	echo "<br />Serial: ".$data['uid'];
	echo "<br />Name: ".$data['user_name'];
	echo "<br />Email: ".$data['email'];
	echo "<br />IP Address: ".$data['ip_address'];
	echo "<br />User Time: ".$data['user_time_stamp'];	
}
mysqli_close($con);
?>