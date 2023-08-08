<?php
include("db.php");
session_start();
$url = $_REQUEST['currentURLlogin'];
$name = $_REQUEST['usernamelogin'];
$email = $_REQUEST['emailylogin'];
/*$url = "https://surbanajurong.sharepoint.com/sites/region-same/tools/SitePages/Home.aspx";
$name = "Tahira Nasreen";
$email = "Tahira.Nasreen@smec.com";*/


if ($url == "https://surbanajurong.sharepoint.com/sites/region-same/SitePages/Home.aspx") {
	 $sql = "select * from saca_dashboard.direct_users where email = '$email'";
	$stmt = mysqli_query($con,$sql);
	 $num_rows  = mysqli_num_rows($stmt)+0;
	$data = mysqli_fetch_assoc($stmt);
	if ($num_rows > 0) {
		if($data['active']==0)
		{
			
			$userexist=2;
			$inactive="Your request is submitted to administrator, please contact administrator for activation of your account.";
		}
		else
		{
		$_SESSION["uid"]=$data['uid'];
		$_SESSION["user_name"]=$data['user_name']."tahira";
		header("Location:index.php");
		}
	} 
	else
	{
		$userexist=0;
	}
}

 if (isset($_POST['form_submitted']))
 {
$url = $_POST['url'];
$name = $_POST['username'];
$arrname=explode(" ",$name);
$login_name=strtolower($arrname[0]).".".strtolower($arrname[1]);
$email = $_POST['email'];


if ($url == "https://surbanajurong.sharepoint.com/sites/region-same/SitePages/Home.aspx") {
	$sql = "select * from saca_dashboard.direct_users where email = '$email'";
	$stmt = mysqli_query($con,$sql);
	$num_rows  = mysqli_num_rows($stmt)+0;
	$data = mysqli_fetch_assoc($stmt);
	if ($num_rows <1) {
		
		
	$sql2 = "insert into saca_dashboard.direct_users (req_url, user_name,login_name,password, email,  active) values ('$url', '$name','$login_name','@123456!abc', '$email', 0)";
	$stmt2 = mysqli_query($con,$sql2);
	 $userexist=3;
	 $msg="Your registraion request is submitted to administrator, please contact administrator for activation of your account.";?>
	 <script>
	setTimeout(function () {    
    window.location.href = '<?php echo $url?>'; 
},3000); // 5 seconds
</script>
<?php
	}	

 }
 }

if($url=='' && $name=='' && $email=='')
{
$userexist=1;	
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page" >

<div class="login-box" style="width:500px">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
  
    <div class="card-header text-center" style="border-bottom:3px solid #007bff; padding-left:3px; padding-right:3px; text-align:left">
    <a href="../../index2.html" class="h1"><b>SACA </b>Dashboard</b></a>
    </div>
    <div class="card-body">
    <?php if($userexist==0)
{
	?>
      <p class="login-box-msg">Do you want to register using company login?</p>

       <form action="" method="post">
        <div class="input-group mb-3">
         <input type="hidden" name="email" id="email" value="<?php echo $email;?>" >
          <input type="hidden" name="username"  id="username" value="<?php echo $name;?>" >
          <input type="hidden" name="url" id="url" value="<?php echo $url;?>" >
          <input type="hidden" name="form_submitted" value="1" />
          
        </div>
        
        <div class="row">
          
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" class="btn btn-primary btn-block" name="submit" >  Register using company login</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      
  <?php
}
else if($userexist==2)
{
?>
	 <p class="login-box-msg" style="padding:2px" ><?php echo $inactive;?></p>
<?php
}
else if($userexist==1)
{
?>
	 <p class="login-box-msg" style="font-weight:bold; color:red;padding:2px" ><?php echo "You are not authorized user, please come through SACA Page.";?></p>
<?php
}
else
{
	?>
	<p class="login-box-msg" style="padding:2px" ><?php echo $msg;?></p>
<?php
}

?>
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
</body>
</html>
