<?php 
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($ppr==0)
{
header("Location:index.php");	
}
include("saveurl.php");
 $cash_id = $_REQUEST['cid'] ;
 
 
 
 if(isset($_REQUEST['update']))
{
					$cash_id=$_REQUEST['cash_id'];
					$country=$_POST['country'];
					$total_target_collection=$_POST['total_target_collection'];
					$t_collection_forcast=$_POST['t_collection_forcast'];
					
					$collection_aus=$_POST['collection_aus'];
					$collection_country=$_POST['collection_country'];
					$collection_todate=$_POST['collection_todate'];
					$forcast_actual=$_POST['forcast_actual'];
					$target_actual=$_POST['target_actual'];
					$deficit_into_aus=$_POST['deficit_into_aus'];
					
					$avg_outflow_from_aus=$_POST['avg_outflow_from_aus'];
					$collection_todate_aus=$_POST['collection_todate_aus'];
					$current_deficit_in_aus=$_POST['current_deficit_in_aus'];


 $sql_pro="UPDATE cash_collection SET total_target_collection=$total_target_collection,t_collection_forcast=$t_collection_forcast, collection_aus=$collection_aus, collection_country=$collection_country, collection_todate=$collection_todate, forcast_actual=$forcast_actual, deficit_into_aus=$deficit_into_aus, avg_outflow_from_aus=$avg_outflow_from_aus, collection_todate_aus=$collection_todate_aus, current_deficit_in_aus=$current_deficit_in_aus where cash_id=$cash_id";
	
	$sql_proresult=mysqli_query($con,$sql_pro);
	
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
  <title>SACA DASHBOARD</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
  <script>
function cancelButton()
{
 window.opener.location.reload();
 self.close();
}
</script>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper"> 

  <div class="content-wrapper">
    <section class="content-header">
    </section>
    <section class="content">
      <div class="container-fluid">
      
        <div class="row">
       
          <div class="col-md-12">
                       <!--edit form tbl1id-->
           
              <div class="card card-primary">
                <div class="card-header">
                <h3 class="card-title">Cash Collection May 23
                </h3>
                </div>
              <?php
			     $incQuery  = "SELECT * FROM cash_collection where cash_id=$cash_id";
                           
                    $incResult = mysqli_query($con,$incQuery);
                    $incCount  = mysqli_num_rows($incResult);
					$cashListRes = mysqli_fetch_assoc($incResult);
					$country=$cashListRes['country'];
					$total_target_collection=$cashListRes['total_target_collection'];
					$t_collection_forcast=$cashListRes['t_collection_forcast'];
					
					$collection_aus=$cashListRes['collection_aus'];
					$collection_country=$cashListRes['collection_country'];
					$collection_todate=$cashListRes['collection_todate'];
					$forcast_actual=$cashListRes['forcast_actual'];
					$target_actual=$cashListRes['target_actual'];
					$deficit_into_aus=$cashListRes['deficit_into_aus'];
					
					$avg_outflow_from_aus=$cashListRes['avg_outflow_from_aus'];
					$collection_todate_aus=$cashListRes['collection_todate_aus'];
					$current_deficit_in_aus=$cashListRes['current_deficit_in_aus'];
					
					
			  ?>
                <form class="forms-sample"  action="cash_update_form.php?cash_id=<?php echo $cash_id;?>" target="_self" method="post"  enctype="multipart/form-data"  id="add_details" >
                <div class="card-body">
                
                <div class="form-group">
                  <input type="hidden"  name="cash_id" value="<?php echo $cash_id;?>">
                <label for="exampleInputEmail1">Country</label>
                  <input type="text" name="country" value="<?php echo $country;?>" class="form-control" id="exampleInputPassword1" >
                  
                </div>
                <div class="form-group">
                <label for="exampleInputPassword1">Total Target Collection</label>
                <input type="text" name="total_target_collection" value="<?php echo 	$total_target_collection;?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Total Collection Forcast</label>
                <input type="text" class="form-control" name="t_collection_forcast" value="<?php echo 	$t_collection_forcast;?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Collection Into Australia</label>
                <input type="text" class="form-control" name="collection_aus" value="<?php echo 	$collection_aus;?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Collection in country</label>
                <input type="text" name="collection_country" value="<?php echo 	$collection_country;?>" class="form-control" id="exampleInputPassword1" >
                </div>
                
                
                <div class="form-group">
                <label for="exampleInputPassword1">Collection to date</label>
                <input type="text" name="collection_todate" value="<?php echo 	$collection_todate;?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Forecast Vs Actual</label>
                <input type="text" class="form-control" name="forcast_actual" value="<?php echo 	$forcast_actual;?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Target Vs Actual</label>
                <input type="text" class="form-control" name="target_actual" value="<?php echo 	$target_actual;?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Deficit in to Australia (Last Month)</label>
                <input type="text" name="deficit_into_aus" value="<?php echo 	$deficit_into_aus;?>" class="form-control" id="exampleInputPassword1" >
                </div>
                
                
                    <div class="form-group">
                <label for="exampleInputPassword1">Average Outflow from Aus</label>
                <input type="text" name="avg_outflow_from_aus" value="<?php echo 	$avg_outflow_from_aus;?>" class="form-control" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Coll to date in Aus</label>
                <input type="text" class="form-control" name="collection_todate_aus" value="<?php echo 	$collection_todate_aus;?>" id="exampleInputPassword1" >
                </div>
                 <div class="form-group">
                <label for="exampleInputPassword1">Current Deficit in Aus</label>
                <input type="text" class="form-control" name="current_deficit_in_aus" value="<?php echo 	$current_deficit_in_aus;?>" id="exampleInputPassword1" >
                </div>
                </div>
                
                <div class="card-footer">
                 <button type="submit" class="btn btn-primary" name="update" id="update" style="width:20%"> Update</button>
                   <button type="submit" class="btn btn-primary" name="cancel" id="cancel" style="width:20%" onclick="cancelButton();">Cancel</button>
                </div>
                </form>
              </div>
           </div>  
          </div>
      </div>
    </section>
    <!-- Main content -->
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
 <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
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
