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

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD -- Cash Collection</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
  <style>
  #th{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#79a9ce;
  color:white;}
  </style>
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
           
    </section>
    <section class="content">
      <div class="container-fluid">
        <div class="card-tools">

          
          </div>
           <!--- tbl1-->
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header" style="background-color: #336992; color: white; ">
                 
                  <h3 class="card-title"><bold>Cash Collection May 2023 </bold></h3>
                </div>
                <!-- /.card-header -->
               
                <div class="card-body table-responsive p-0">
                  <table class="table table-head-fixed " style="border-collapse:separate">
                    <thead id="th">
                      <tr>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Country</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Total Target Collection</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" colspan="3">Total Forecast by Country</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Collection to date</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" colspan="2">Balance to Collect</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Deficit in to Australia <br/> (Last Month)</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Average Outflow from Aus</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2">Coll to date in Aus</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="2"> Current Deficit in Aus</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" rowspan="3"> Action</th>
                         
                      </tr>
                      <tr>
                        <th style="vertical-align: middle; text-align:center;" id="th" >Total Collection Fcst</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" >Collection Into Australia</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" >Collection in country</th>
                        
                        <th style="vertical-align: middle; text-align:center;" id="th" >Forecast Vs Act</th>
                        <th style="vertical-align: middle; text-align:center;" id="th" >Target Vs Act</th>
                         
                      </tr>
                      <tr>
                        <th style="vertical-align: middle; text-align:center;"  ></th>
                        <th style="vertical-align: middle; text-align:center;"  >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;">AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;"  >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;"  >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;"  >AUD'000</th>
                        <th style="vertical-align: middle; text-align:center;" >AUD'000</th>
                        
                         
                      </tr>
                    </thead>
                    <tbody>
                     <?php
			     $incQuery  = "SELECT * FROM cash_collection order by cash_id asc";
                           
                    $incResult = mysqli_query($con,$incQuery);
                    $incCount  = mysqli_num_rows($incResult);
					 $v=1;
				  
				    $s_total_target_collection=0;
				    $s_t_collection_forcast=0;
					$s_collection_aus=0;
				    $s_collection_country=0;
					$s_collection_todate=0;					
					 $s_forcast_actual=0;
				    $s_target_actual=0;
					$s_deficit_into_aus=0;
				    $s_avg_outflow_from_aus=0;
					$s_collection_todate_aus=0;					
					$s_current_deficit_in_aus=0;
				   
					while($cashListRes = mysqli_fetch_assoc($incResult))
					{
					$cash_id=$cashListRes['cash_id'];
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
					 if($v<=$incCount)
					   {
						   $s_total_target_collection=$s_total_target_collection+$total_target_collection;
						   $s_t_collection_forcast=$s_t_collection_forcast+$t_collection_forcast;
						   $s_collection_aus=$s_collection_aus+$collection_aus;
						   $s_collection_country=$s_collection_country+$collection_country;
						   $s_collection_todate=$s_collection_todate+$collection_todate;
						   
						   
						   $s_forcast_actual=$s_forcast_actual+$forcast_actual;
						   $s_target_actual=$s_target_actual+$target_actual;
						   $s_deficit_into_aus=$s_deficit_into_aus+$deficit_into_aus;
						   $s_avg_outflow_from_aus=$s_avg_outflow_from_aus+$avg_outflow_from_aus;
						   $s_collection_todate_aus=$s_collection_todate_aus+$collection_todate_aus;
						   $s_current_deficit_in_aus=$s_current_deficit_in_aus+$current_deficit_in_aus;
					   }
					
					
					
					
			  ?>
                         <tr>
                          
                          <td style="vertical-align: middle; text-align:left;"><?php echo $country;?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($total_target_collection,0);?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($t_collection_forcast,0);?> </td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($collection_aus,0);?></td>
                          
                          <td style="vertical-align: middle; text-align:center;"> <?php echo number_format($collection_country,0);?></td>
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($collection_todate,0);?></td> 
                           
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($forcast_actual,0);?></td>
                          
                          <td style="vertical-align: middle; text-align:center;"> <?php echo number_format($target_actual,0);;?></td>
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($deficit_into_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($avg_outflow_from_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($collection_todate_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($current_deficit_in_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"> <a class="btn btn-secondary" href="javascript:void(0)"  onclick="window.open('cash_update_form.php?cid=<?php echo $cash_id;?>', 'cashwindow', 'left=600,top=60,width=870,height=800');return false;" data-shuffle>Update</a>  
</td> 
                          
                        </tr>
                        <?php
						$v++;
					}
					?>
                        
                        
                       <tr>
                          
                          <td style="vertical-align: middle; text-align:right; font-weight:bold">Total</td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_total_target_collection,0);?></td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_t_collection_forcast,0);?> </td>
                          <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_collection_aus,0);?></td>
                          
                          <td style="vertical-align: middle; text-align:center;"> <?php echo number_format($s_collection_country,0);?></td>
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_collection_todate,0);?></td> 
                           
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_forcast_actual,0);?></td>
                          
                          <td style="vertical-align: middle; text-align:center;"> <?php echo number_format($s_target_actual,0);;?></td>
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_deficit_into_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_avg_outflow_from_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_collection_todate_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"><?php echo number_format($s_current_deficit_in_aus,0);?></td> 
                           <td style="vertical-align: middle; text-align:center;"> </td> 
                          
                        </tr>
                     
                       
                    </tbody>
                        
                   
                  </table>
                </div>
               
                <!--YTD-->

                <!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
          </div>
           <!--- tbl1-->
        
          
          
              </div>
              </section>
             
            </div>
       
         
         
   
  
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
 
  <?php include("partials/footer.php")?>
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
