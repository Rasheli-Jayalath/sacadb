<?php 
require 'db.php';  ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>User DATA</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../ppr/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="../../ppr/theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="../../ppr/theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="../../ppr/theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../ppr/theme/dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 
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
            <h1>User Data</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
            <!--   <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTables</li> -->
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
           
            <!-- /.card -->

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Assign Role To User</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status(s)</th>
                    <th>Assign Role</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php if($con){
                        $incListQuery  = "SELECT *
                                         FROM direct_users 
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                          </tr>
                           <td><?php echo $incListRes['login_name']; ?></td>
                           <td><?php echo $incListRes['email']; ?></td>
                            <td><?php echo $incListRes['active']; ?></td>
                             <th><button onclick="window.open('assignRole.php')" type="button" class="btn btn-block btn-primary">Assign Role</button></th>
                             </tr>
                    </option>
                         <?php
                     }}?>
                 
                  </tbody>
                  <tfoot>
                  <tr>
                     <th>Name</th>
                    <th>Email</th>
                    <th>Status(s)</th>
                    <th>Assign Role</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../ppr/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../ppr/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="../../ppr/theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="../../ppr/theme/plugins/jszip/jszip.min.js"></script>
<script src="../../ppr/theme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="../../ppr/theme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="../../ppr/theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="../../ppr/theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="../../ppr/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->

<!-- Page specific script -->
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
</body>
</html>
