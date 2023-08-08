<?php
include_once("db.php");
$url = $_REQUEST['currentURLlogin'];
$name = $_REQUEST['usernamelogin'];
$email = $_REQUEST['emailylogin'];
$ip = $_REQUEST['ip_address'];
mysqli_query($con, "insert into users_logs (user_name, email, req_url, ip_address) values ('$name','$email','$url','$ip')");
mysqli_close($con);
?>