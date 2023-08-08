<?php
session_start();
include "db.php";
if($_POST){
  if (isset($_POST['user_name']) && isset($_POST['password'])) {

      function validate($data){

         $data = trim($data);

         $data = stripslashes($data);

         $data = htmlspecialchars($data);

         return $data;

      }

      $user_name = validate($_POST['user_name']);

      $pass = validate($_POST['password']);

      if (empty($user_name)) {

          header("Location: index.php?error=User Name is required");

          exit();

      }else if(empty($pass)){

          header("Location: index.php?error=Password is required");

          exit();

      }else{

          $sql = "SELECT * FROM direct_users WHERE user_name='$user_name' AND password='$pass'";

          $result = mysqli_query($con, $sql);

          if (mysqli_num_rows($result) === 1) {

              $row = mysqli_fetch_assoc($result);

              if ($row['user_name'] === $user_name && $row['password'] === $pass) {

                  echo "Logged in!";

                  $_SESSION['user_name'] = $row['user_name'];

                   $_SESSION['status'] = $row['active'];

                  $_SESSION['id'] = $row['id'];

                  header("Location: home.php");

                  exit();

              }else{
                  header("Location: index.php?error=Incorect User name or password");

                  exit();

              }

          }else{

              header("Location: index.php?error=Incorect User name or password");

              exit();

          }

      }

  }else{
  echo "dfsd";
     // header("Location: index.php");
      exit();
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <!-- /.login-logo -->
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <a href="../../home.php" class="h1"><b>SACA </b>DASHBOARD</a>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Sign in</p>

      <form action="index.php" method="post" action="">
        <div class="input-group mb-3">
          <input type="user" name="user_name" class="form-control" placeholder="User Name">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

     <!--  <div class="social-auth-links text-center mt-2 mb-3">
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div>
    

      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.html" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.card-body -->
  </div>
  <!-- /.card -->
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="../../sacadb/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../sacadb/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../sacadb/theme/dist/js/adminlte.min.js"></script>
</body>
</html>
