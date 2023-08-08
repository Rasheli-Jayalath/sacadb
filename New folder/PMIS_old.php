<?php 

 require 'db.php'; ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD</title>


  
  
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  
  <script language="javascript" type="text/javascript">

function getXMLHTTP() { //fuction to return the xml http object
		var xmlhttp;
	if (window.XMLHttpRequest)
	  {// code for IE7+, Firefox, Chrome, Opera, Safari
	  xmlhttp=new XMLHttpRequest();
	  }
	else
	  {// code for IE6, IE5
	  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	  }
		return xmlhttp;
    }
	

	
function selectMonth(smonth) {

									
			var strURL="sel_month.php?smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("abc").innerHTML=req.responseText;
							
												
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
	}
	
	function selectMonthd(smonth) {
		
			var strURL="sel_monthd.php?smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("abcd").innerHTML=req.responseText;
							
												
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
	}
	
	function selectMonthg(smonth) {

									
			var strURL="sel_monthg.php?smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("abcg").innerHTML=req.responseText;
							
												
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL, true);
				req.send(null);
			}
	}
</script>
 <style>
 .badge{
	 padding:.75em 1.2em;
 }
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
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>ALL PMIS REPORTS</h1>
           
                      <!-- select -->
                      
                   
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<div class="row">
   <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">PMIS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonth(this.value)"  style="display:inline; width:100px;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                <table class="table table-bordered" id="abc">
                  <thead>
                    <tr>
                      
                      <th>Country</th>
                      <th>Total PMIS</th>
                      <th style="width: 40px">Updated <small>( 1 Months)</small></th>
                      <th style="width: 40px">Not Updated <small>( 1 Months)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  
				  $pmiscon = "select distinct country_name as country_name from pmis_update_data order by country_name asc";
				   $pmisconres = mysqli_query($con,$pmiscon);
				   $countryCount  = mysqli_num_rows($pmisconres);
				   $u=1;
				   $pmis_total=0;
				   $pmis_total_updated=0;
				   $pmis_total_nupdated=0;
				   while($pmisres=mysqli_fetch_assoc($pmisconres))
				   {
					   
					   $country=$pmisres['country_name'];
					   
					   $pmissum = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where country_name='$country' and item_name!='DMS' and item_name!='GIS' group by project_id";
                        $pmissumres = mysqli_query($con,$pmissum);
                  		 $pmissumCount  = mysqli_num_rows($pmissumres);
					   if($u<=$countryCount)
					   {
						   $pmis_total=$pmissumCount+$pmis_total;
					   }
					   
					   
					   $pmissum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval 1 month and country_name='$country' and item_name!='DMS' and item_name!='GIS' group by project_id";
                        $pmissumres1 = mysqli_query($con,$pmissum1);
                   $pmissumCount1  = mysqli_num_rows($pmissumres1);
				   
				   if($u<=$countryCount)
					   {
						   $pmis_total_updated=$pmissumCount1+$pmis_total_updated;
					   }
				  $notupdated=$pmissumCount-$pmissumCount1;
				   if($u<=$countryCount)
					   {
						   $pmis_total_nupdated=$notupdated+$pmis_total_nupdated;
					   }
				  
				  
					  ?>
                  
                    <tr>
                     
                      <td><?php echo $country;?></td>
                      <td>
                       
                        <?php echo $pmissumCount;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $pmissumCount1;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $notupdated;?></span></td>
                    </tr>
                    <?php
					$u++;
				   }
				   ?>
                   <tr>
                     
                      <td style="text-align:right; font-weight:bold"><?php echo "Total";?></td>
                      <td>
                       
                        <?php echo $pmis_total;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $pmis_total_updated;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $pmis_total_nupdated;?></span></td>
                    </tr>
                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">DMS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonthd(this.value)"  style="display:inline; width:100px;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                <table class="table table-bordered" id="abcd">
                  <thead>
                    <tr>
                      
                      <th>Country</th>
                      <th>Total DMS</th>
                      <th style="width: 40px">Updated <small>( 1 Months)</small></th>
                      <th style="width: 40px">Not Updated <small>( 1 Months)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  
				  $dmscon = "select distinct country_name as country_name from pmis_update_data order by country_name asc";
				   $dmsconres = mysqli_query($con,$dmscon);
				   $countryCountd  = mysqli_num_rows($dmsconres);
				   $v=1;
				   $dms_total=0;
				   $dms_total_updated=0;
				   $dms_total_nupdated=0;
				   while($dmsres=mysqli_fetch_assoc($dmsconres))
				   {
					   
					   $country=$dmsres['country_name'];
					   
					 $dmssum = "select project_id,country_name from pmis_update_data where country_name='$country' and item_name='DMS' group by project_id";
                        $dmssumres = mysqli_query($con,$dmssum);
                  		 $dmssumCount  = mysqli_num_rows($dmssumres);
					   if($v<=$countryCountd)
					   {
						   $dms_total=$dmssumCount+$dms_total;
					   }
					   
					   
					   $dmssum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval 1 month and country_name='$country' and item_name='DMS' group by project_id";
                        $dmssumres1 = mysqli_query($con,$dmssum1);
                   $dmssumCount1  = mysqli_num_rows($dmssumres1);
				   
				   if($v<=$countryCountd)
					   {
						   $dms_total_updated=$dmssumCount1+$dms_total_updated;
					   }
				  $notupdated=$dmssumCount-$dmssumCount1;
				   if($v<=$countryCountd)
					   {
						   $dms_total_nupdated=$notupdated+$dms_total_nupdated;
					   }
				  
				  
					  ?>
                  
                    <tr>
                     
                      <td><?php echo $country;?></td>
                      <td>
                       
                        <?php echo $dmssumCount;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $dmssumCount1;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $notupdated;?></span></td>
                    </tr>
                    <?php
					$v++;
				   }
				   ?>
                   <tr>
                     
                      <td style="text-align:right; font-weight:bold"><?php echo "Total";?></td>
                      <td>
                       
                        <?php echo $dms_total;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $dms_total_updated;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $dms_total_nupdated;?></span></td>
                    </tr>

                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
          <div class="col-md-4">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">GIS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonthg(this.value)"  style="display:inline; width:100px;">
                          <option value="1">1</option>
                          <option value="2">2</option>
                          <option value="3">3</option>
                          <option value="4">4</option>
                          <option value="5">5</option>
                          <option value="6">6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                <table class="table table-bordered" id="abcg">
                  <thead>
                    <tr>
                      
                      <th>Country</th>
                      <th>Total gis</th>
                      <th style="width: 40px">Updated <small>( 1 Months)</small></th>
                      <th style="width: 40px">Not Updated <small>( 1 Months)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  
				  $giscon = "select distinct country_name as country_name from pmis_update_data order by country_name asc";
				   $gisconres = mysqli_query($con,$giscon);
				   $countryCountd  = mysqli_num_rows($gisconres);
				   $w=1;
				   $gis_total=0;
				   $gis_total_updated=0;
				   $gis_total_nupdated=0;
				   while($gisres=mysqli_fetch_assoc($gisconres))
				   {
					   
					   $country=$gisres['country_name'];
					   
					 $gissum = "select project_id,country_name from pmis_update_data where country_name='$country' and item_name='GIS' group by project_id";
                        $gissumres = mysqli_query($con,$gissum);
                  		 $gissumCount  = mysqli_num_rows($gissumres);
					   if($w<=$countryCountd)
					   {
						   $gis_total=$gissumCount+$gis_total;
					   }
					   
					   
					   $gissum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval 1 month and country_name='$country' and item_name='GIS' group by project_id";
                        $gissumres1 = mysqli_query($con,$gissum1);
                   $gissumCount1  = mysqli_num_rows($gissumres1);
				   
				   if($w<=$countryCountd)
					   {
						   $gis_total_updated=$gissumCount1+$gis_total_updated;
					   }
				  $notupdated=$gissumCount-$gissumCount1;
				   if($w<=$countryCountd)
					   {
						   $gis_total_nupdated=$notupdated+$gis_total_nupdated;
					   }
				  
				  
					  ?>
                  
                    <tr>
                     
                      <td><?php echo $country;?></td>
                      <td>
                       
                        <?php echo $gissumCount;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $gissumCount1;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $notupdated;?></span></td>
                    </tr>
                    <?php
					$w++;
				   }
				   ?>
                   <tr>
                     
                      <td style="text-align:right; font-weight:bold"><?php echo "Total";?></td>
                      <td>
                       
                        <?php echo $gis_total;?>
                      
                      </td>
                      <td><span class="badge bg-success"><?php  echo $gis_total_updated;?></span></td>
                       <td><span class="badge bg-danger"><?php echo $gis_total_nupdated;?></span></td>
                    </tr>

                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
        </div>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">PMIS Updates</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                  	 <th>Project Code</th>
                    <th>Project Name</th>
                     <th>Country</th>
                    <th>Link</th>
                    <th>News</th>
                    <th>Pictorial</th>
                     <th>Drawing</th>
                    <th>Issue</th>
                    <th>RFI</th>
                    <th>Daily_obs</th>
                    <th>Weekly_obs</th>
                    <th>NCR</th>
                    <th>Incident</th> 
                     <th>IPC</th>
                     <th>Activity</th>
                    <th>XER</th>
                    <th>Project</th>
                    <th>Slider</th>
                    <th>Photo</th>
                    <th>Video</th>
                    <th>Non_Conformity</th>
                    <th>Pictorial_view</th>
                    <th>Land_Acquisition</th>
                   <th>Utility</th>
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php  $pmisUpdataDataQuery  = "select project_id,project_name, country_name, links,JSON_ARRAYAGG(JSON_OBJECT('item',item_name,'value',item_value1) ) as project_details
from pmis_update_data where item_name!='DMS' and item_name!='GIS' group by project_id ";
                      $pmisUpdataDataResult = mysqli_query($con,$pmisUpdataDataQuery);
                      $pmisUpdataDataCount  = mysqli_num_rows($pmisUpdataDataResult);
                      $loop = 1;
					 $pmisUpdataDataRes = mysqli_fetch_all($pmisUpdataDataResult, MYSQLI_ASSOC);
					 //echo $pmisUpdataDataRes[0]['project_details'];
					 //print_r($pmisUpdataDataRes);
						for($i=0; $i<count( $pmisUpdataDataRes); $i++)
						{
							$pid= $pmisUpdataDataRes[$i]['project_id'];
							$project_name= $pmisUpdataDataRes[$i]['project_name'];
							$country_name= $pmisUpdataDataRes[$i]['country_name'];
							$links= $pmisUpdataDataRes[$i]['links'];
							$pd= $pmisUpdataDataRes[$i]['project_details'];
						 $task_array= json_decode( $pd, true);
						
					  $total_rec=count($task_array);
					  ?>
                      <tr>
                      <td><a href="summary.php?id=<?php  echo $pid;?>">
                     <?php  echo $pid;?></a>
                      </td>
                      <td>
                     <?php  echo $project_name;?>
                      </td>
                      <td>
                     <?php  echo $country_name;?>
                      </td>
                      <td>
                     <a href="<?php  echo $links;?>" target="_blank">Visit Link</a>
                      </td>
                      <?php
							for($j=0; $j< $total_rec; $j++)
							{
								?>
                                <td>
                               
                                <?php
								if(($task_array[$j]['item'])=='Project')
								{
									
								echo  $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Slider')
								{
								
								echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='News')
								{
									
								echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Photo')
								{
									
								echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Video')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Pictorial')
								{
									echo $task_array[$j]['value'];
								}
								
								if(($task_array[$j]['item'])=='Drawing')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Issue')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Non_Conformity')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='IPC')
								{
									echo $task_array[$j]['value'];
								}
								
								if(($task_array[$j]['item'])=='Activity')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='XER')
								{
									 echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='RFI')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Daily_obs')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Weekly_obs')
								{
									echo $task_array[$j]['value'];
								}
								
								
								
								if(($task_array[$j]['item'])=='NCR')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Incident')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Pictorial_view')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Land_Acquisition')
								{
									echo $task_array[$j]['value'];
								}
								if(($task_array[$j]['item'])=='Utility')
								{
									echo $task_array[$j]['value'];
								}
								?>
                                
                                 </td>
                                 
                                
                                <?php
								
							}
							?>
                            </tr>
                            <?php
							$news="";
							$project='';
							$slider="";
						}
					 
                              
                     ?>
                  
  
                 </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            </div>
            
        
          <!-- jQuery -->
<script src="theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="theme/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="theme/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="theme/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="theme/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="theme/plugins/jszip/jszip.min.js"></script>
<script src="theme/plugins/pdfmake/pdfmake.min.js"></script>
<script src="theme/plugins/pdfmake/vfs_fonts.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="theme/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="theme/dist/js/demo.js"></script>
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
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scrollX": true,
    });
  });
</script>
        
        
        
       


</body>
</html>
