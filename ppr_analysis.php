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
if(isset($_GET["search"])){ 
$project     = trim($_REQUEST['project']);
$month      = trim($_REQUEST['fmonth']);
$year        = trim($_REQUEST['year']);
$projListQuery_srch  = "select *
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 ";
if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $projListQuery_srch .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $projListQuery_srch .= " AND sp.year = '".$year."' ";
                  }    

                       
                         
					  $projListQuery_srch .= " AND smt.master_code = '".$_REQUEST['project']."' ";
                  
				  // $projListQuery_srch;
			   
				   $totalProjectResult_srch = mysqli_query($con,$projListQuery_srch);
                   $totalProjectCount_srch  = mysqli_num_rows($totalProjectResult_srch);
   
   
				  
}
$projListQuery  = "select DISTINCT(sp.project) as master_code, sp.Project_Description
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 ";
$year=0;
$current_date=NULL;
                    


  
                    
					
    ####get sum of whole project inside saca###
 ?>
 <?php //print_r($totalProjectdata['sum_Cont_Margin_LTD']);?>

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
   <link href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css" rel="stylesheet" />
    <link href="theme/jquery.multiselect.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="theme/jquery.multiselect.js"></script>
   <style type="text/css">
    .card-success:not(.card-outline)>.card-header {
    background-color: #79a9ce; 
    }
    .card-danger:not(.card-outline)>.card-header {
    background-color: #1d3a67;

    }
    #filter-sec{
      margin-left:1em;
      margin-right:1em;
    }
    #result-sec{
      margin-left:1em;
      margin-right:1em;
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
            <h1>PPR Analytics
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
<?php 
if(isset($_GET["search"])){ 
$fmonth      = trim($_REQUEST['fmonth']);
$year        = trim($_REQUEST['year']);
       if(isset($fmonth) && $fmonth!=0 && $fmonth!="" && $fmonth!=NULL&&isset($year) && $year!=0 && $year!="" && $year!=NULL)
       {
		   $month=$fmonth ;
		   $year=$year;
	    $current_date=$year."-".$month."-"."01";
		}
		
}
else
{
$Project_Type     = "External";
$Status     = "E";			
$incListQuery_yr  = "SELECT max(year) as year FROM saca_profitability ";   
                             
                    $incListResult_yr = mysqli_query($con,$incListQuery_yr);
                    $incListCount_yr  = mysqli_num_rows($incListResult_yr);
                    if($incListCount_yr>0)
					{
						$incListRes_yr = mysqli_fetch_array($incListResult_yr);
                        $year = $incListRes_yr["year"];
						if($year!=""&&$year!=0)
						{
							 $incListQuery_mon  = "SELECT max(month) as month FROM saca_profitability where year='$year'";   
                             
                    $incListResult_mon = mysqli_query($con,$incListQuery_mon);
                    $incListCount_mon  = mysqli_num_rows($incListResult_mon);
                    if($incListCount_mon>0)
					{
						$incListRes_mon = mysqli_fetch_array($incListResult_mon);
						$month=$incListRes_mon['month'];
					}
							
						}
					}
					
					 $current_date=$year."-".(int)$month."-"."01";
}
		if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}?>
     
     
     <div class="card card-danger"id="filter-sec">
      <!-- <div class="card-header">
        <h3 class="card-title">Different Width</h3>
      </div> -->
      <div class="card-body" >
        <form method="get" id="form-id" action="">
          <div class="row">
          <div class="col-1"> 
                 <select class="custom-select" name="did" id="did">
                   <option value="">Division</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM ds001division 
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['did']; ?>" <?php if(isset($did) && $did!=0 && $did!="" && $did!=NULL &&$did==$incListRes['did']){?> selected <?php }?>><?php echo $incListRes['dname']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
              <div class="col-1"> 
                 <select class="custom-select" name="rid" id="rid">
                   <option value="">Region</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM ds002region 
                                        WHERE 1=1 ";  
					if(isset($did) && $did!=0 && $did!="" && $did!=NULL)
						{
							$incListQuery  .=" AND did=".$did ;
						} 
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['rid']; ?>" <?php if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL &&$rid==$incListRes['rid']){?> selected <?php }?>><?php echo $incListRes['rname']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
              <div class="col-1">
                <select class="custom-select" name="cid" id="cid">
                    <option value="">Country</option>
                    <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM ds003country where 1=1  
                                        ";   
						if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL)
						{
							$incListQuery  .=" AND rid=".$rid ;
						}
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['cid']; ?>" <?php if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL &&$cid==$incListRes['cid']){?> selected <?php }?>><?php echo $incListRes['cname']; ?></option>
                         <?php
                     }}?>
                </select>
              </div>
              <div class="col-1"> 
                 <select class="custom-select" name="sid" id="sid">
                   <option value="">Sector</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM ds004sectors 
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['sid']; ?>" <?php if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL &&$sid==$incListRes['sid']){?> selected <?php }?>><?php echo $incListRes['sectors']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
              <div class="col-1" >
                <select class="custom-select" name="Project_Type" id="Project_Type">
                  <option value="" selected>Type</option>
                  <option value="External" <?php if($Project_Type=="External") {?> selected <?php }?>>External</option>
                  <option value="InterCompany" <?php if($Project_Type=="InterCompany") {?> selected <?php }?>>InterCompany</option>
                 </select>
              </div>
              <div class="col-1" >
                <select class="custom-select" name="Status" id="Status">
                  <option value="" selected>Status</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT *
                                  FROM ds005status  ";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['status_code']; ?>" 
                            <?php if(isset($Status)&&$Status==$incListRes['status_code']){ echo "selected";} ?>
                            ><?php echo $incListRes['status_code']."-".$incListRes['status']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
              <div class="col-1" >
                <select class="custom-select" name="entity" id="entity">
                  <option value="" selected>Entity</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT DISTINCT company as entity
                                  FROM saca_project_master  WHERE 1=1 ";
						
						if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL)
						{
							$incListQuery  .=" AND region=".$rid ;
						}
						if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL)
						{
							$incListQuery  .=" AND country=".$cid ;
						}
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['entity']; ?>" 
                            <?php if(isset($entity)&&$entity==$incListRes['entity']){ echo "selected";} ?>
                            ><?php echo $incListRes['entity']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
              <div class="col-1">
              <?php //echo $projListQuery;?>
                <select class="custom-select" name="project" id="project">
                  <option value="">Project</option>
                  <?php if($con){
                       /*echo $incListQuery  = "SELECT master_code
                      FROM saca_project_master WHERE master_code = '".$project."' order by  pid ";*/
					  
					  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL)
						{
							$projListQuery  .=" AND smt.region=".$rid ;
						}
						if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL)
						{
							$projListQuery  .=" AND smt.country=".$cid ;
						}
						if(isset($entity)  && $entity!=NULL)
						{
							$projListQuery  .=" AND smt.company='".$entity."'" ;
						}
						$projListQuery  .=" ORDER BY sp.project ASC" ;
					 $incListQuery=$projListQuery;
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['master_code']; ?>" <?php if(isset($project) && $project!=0 && $project!="" && $project!=NULL &&$project==$incListRes['master_code']){?> selected <?php }?>><?php echo $incListRes['master_code']." - ".$incListRes['Project_Description']; ?></option>
                         <?php
                     }}?>
                </select>
              </div>
              
              <script>
                $(document).ready(function(){
                    $('#did').on('change', function(){
                        var did = $(this).val();
                        //alert(RegionID);
                       
                      
                        if(did){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'did='+did,
                                success:function(html){
                                    $('#rid').html(html);
                                    $('#cid').html('<option value="">Select Country </option>'); 
                                }
                            }); 
                        }else{
                            $('#rid').html('<option value="">Select Region First </option>');
                            $('#cid').html('<option value="">Select Country First </option>'); 
							$("#sid").val($("#sid option:first").val());
							
							
							$("#project").html('<option value="">Project </option>');
							$("#entity").val($("#entity option:first").val()); 
							
							
                        }
                    });
                    
                    $('#rid').on('change', function(){
                        var rid = $(this).val();
                        if(rid){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'rid='+rid,
                                success:function(html){
                                    $('#cid').html(html);
									$("#sid").val($("#sid option:first").val());
							
						/*	$("#entity").val($("#entity option:first").val()); */
							
							/*$("#project").html('<option value="">Project </option>');*/
							
                                }
                            }); 
                        }else{
                            $('#cid').html('<option value="">Select Region first</option>'); 
							/*$("#sid").val($("#sid option:first").val());*/
							
							
							/*$("#project").html('<option value="">Project </option>'); 
							$("#entity").val($("#entity option:first").val()); */
							
							
                        }
                    });
					
					$('#cid').on('change', function(){
                        var cid = $(this).val();
                        if(cid){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#project').html(html);
									$("#sid").val($("#sid option:first").val());
							
							
							
							
                                }
                            }); 
                        }else{
							$("#sid").val($("#sid option:first").val());
							
							
                            /*$('#project').html('<option value="">Project</option>'); */
							
							
                        }
						
						 if(cid){
                            $.ajax({
                                type:'POST',
                                url:'ajaxdata_entity.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#entity').html(html);
									
							
							
                                }
                            }); 
                        }
                    });
					
					$('#sid').on('change', function(){
                        var sid = $(this).val();
						  var cid = $('#cid').val();
						 
                        if(sid){
							//alert('cid='+cid+'sid='+sid)
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid,
                                success:function(html){
                                    $('#project').html(html);
									
							
							
							
                                }
                            }); 
                        }else{
                            
							
							
							
							 if(cid){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else
							 {
							$('#project').html('<option value="">Project</option>'); 
							}
                        }
                    });
					
					
					$('#Project_Type').on('change', function(){
                        var Project_Type = $(this).val();
						var sid = $('#sid').val();
						  var cid = $('#cid').val();
						  
						 
                        if(typeof Project_Type != "undefined" && Project_Type){
							//alert('cid='+cid+'sid='+sid)
							//alert(Project_Type);
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid+'&Project_Type='+Project_Type,
								
                                success:function(html){
                                    $('#project').html(html);
									
									/*$("#entity").val($("#entity option:first").val()); */
									
									
                                }
                            }); 
                        }else{
                            
							$("#entity").val($("#entity option:first").val()); 
							
							
							 if(typeof sid != "undefined" && sid && typeof cid != "undefined" && cid)
							 {
								  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid,
                                success:function(html){
                                    $('#project').html(html);
									$("#entity").val($("#entity option:first").val()); 
									
									
                                }
                            }); 
							}
							else if(typeof cid != "undefined" && cid){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else
							 {
								 /* $('#project').html('<option value="">Project</option>'); */
								  
								  
									
							 }
							  
                        }
                    });
					
					$('#Status').on('change', function(){
                        var Status = $(this).val();
						var sid = $('#sid').val();
						var Project_Type = $('#Project_Type').val();
						  var cid = $('#cid').val();
						  
						 
                        if(typeof Status != "undefined" && Status){
							//alert('cid='+cid+'sid='+sid)
							//alert(Project_Type);
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid+'&Project_Type='+Project_Type+'&Status='+Status,
								
                                success:function(html){
                                    $('#project').html(html);
									$("#entity").val($("#entity option:first").val()); 
									
									
                                }
                            }); 
                        }else{
                            
							
							 if(typeof sid != "undefined" && sid && typeof cid != "undefined" && cid && typeof Project_Type != "undefined" && Project_Type)
							 {
								  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                               data:'cid='+cid+'&sid='+sid+'&Project_Type='+Project_Type,
                                success:function(html){
                                    $('#project').html(html);
									$("#entity").val($("#entity option:first").val()); 
									
									
									
                                }
                            }); 
							}
							else if(typeof cid != "undefined" && cid && typeof sid != "undefined" && sid ){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else if(typeof cid != "undefined" && cid ){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else
							 {
								  $('#project').html('<option value="">Project</option>'); 
								  $("#entity").val($("#entity option:first").val()); 
								  
									
							 }
							  
                        }
                    });
					
					$('#entity').on('change', function(){
                        var entity = $(this).val();
						var sid = $('#sid').val();
						var Project_Type = $('#Project_Type').val();
						 var Status = $('#Status').val();
						  var cid = $('#cid').val();
						  
						
                        if(typeof entity != "undefined" && entity){
							
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid+'&Project_Type='+Project_Type+'&Status='+Status+'&entity='+entity,
								
                                success:function(html){
                                    $('#project').html(html);
									
									
                                }
                            }); 
                        }else{
                            
							
							 if(typeof sid != "undefined" && sid && typeof cid != "undefined" && cid && typeof Project_Type != "undefined" && Project_Type)
							 {
								  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                               data:'cid='+cid+'&sid='+sid+'&Project_Type='+Project_Type,
                                success:function(html){
                                    $('#project').html(html);
									
									
									
                                }
                            }); 
							}
							else if(typeof cid != "undefined" && cid && typeof sid != "undefined" && sid ){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid+'&sid='+sid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else if(typeof cid != "undefined" && cid ){
							  $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'cid='+cid,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
							 }
							 else
							 {
								  $('#project').html('<option value="">Project</option>'); 
								  
									
							 }
							  
                        }
                    });
                });
                </script>
               
               
              <div class="col-1.5" style="margin-right:1em">
                <select class="custom-select" name="fmonth" id="fmonth">
                  <option value="">Month</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT month,year
                                  FROM saca_profitability  GROUP BY month order by month ASC ";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['month']; ?>" 
                            <?php if(isset($month) && $month==$incListRes['month']){ echo "selected";} ?> ><?php echo date('F',strtotime("01-".$incListRes['month']."-".$incListRes['year'])); ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
              <div class="col-1.5">
                   <select class="custom-select" name="year" id="year">
                  <option value="">Year</option>
                  <?php 
                   if($con){
                        $incListQuery  = "SELECT year
                           FROM saca_profitability  GROUP BY year order by year ASC ";
                                           
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option  value="<?php echo $incListRes['year']; ?>" 
                             <?php if(isset($year) && $year!=0 && $year===$incListRes['year']){ echo "selected";} ?>
                            ><?php echo $incListRes['year']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
               <div class="col-1">
             <button type="submit" name="search" id="search" onclick="document.getElementById('form-id').submit();" class="btn btn-success" value="1">SEARCH </button>
              </div>
               
             
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>

     <div class="card card-danger" id="result-sec">
      
        <?php if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == '1'){ ?>
      <div class="card-body" style="color: red; text-align: center;">
        
     
          <div class="row">
              <div class="col-12"> 
                 <span  style="color: red; text-align: right;font-size:1.25em"><?php echo "Record Not Found"; ?></span>
              </div>
           </div>   
      </div>
        <?php } ?>
      
    </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <?php  $sub_project=0;
	  if($totalProjectCount_srch > 1){ 
       while($totalProjectRes_srch = mysqli_fetch_array($totalProjectResult_srch)){
		   $sub_project=$totalProjectRes_srch["project_code"];?>
        <div class="row">
          <div class="col-12">
            <div class="card" >
              <div class="card-header"  style="background-color: #1d3a67; color: white; ">
                <h3 class="card-title" align="center" style="text-align:center"><bold><?php echo  $sub_project. " - ". $totalProjectRes_srch["Project_Type"]." - (".$totalProjectRes_srch["company"].")"."&nbsp;-&nbsp;".$totalProjectRes_srch["project_desc"];
				?></bold></h3>
              </div>
              <!-- /.card-header -->
           
              <div class="card-body table-responsive p-0">
                <table class="table table-striped text-nowrap">
                  <thead>
                    <tr style="background-color: #79a9ce">
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">MTD Fees</th>
                      <th align="center" style="background-color: #79a9ce">MTD Reimb </th>
                      <th align="center" style="background-color: #79a9ce">MTD Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">MTD Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Contrib</th>
                      <th align="center" style="background-color: #79a9ce">MTD Contrib Margin</th>
                      <th align="center" style="background-color: #79a9ce">LTD Billing</th>
                      <th align="center" style="background-color: #79a9ce">WIP</th>
                      <th align="center" style="background-color: #79a9ce">Debtor</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
			
					
					
					
					for($j=0;$j<12;$j++)
{
   $newdate=date("Y-m-d", strtotime ('-'.$j.' month' , strtotime ($current_date)))."<br/>" ;
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $eshsListQuery  = "SELECT 
                              smt.*, 
                           SUM(sp.Fees)  AS MTD_Fees,
                           SUM(sp.Reimb) AS MTD_Reimb,
                           SUM(sp.Total_Rev) AS MTD_Total_Rev,
                           SUM(sp.Salary) AS MTD_Salary,
                           SUM(sp.Reim_Cost) AS MTD_Reim_Cost,
                           SUM(sp.Total_Cost) AS MTD_Total_Cost,
                           SUM(sp.Contrib) AS MTD_Contrib,
                           SUM(sp.Cont_Margin) AS MTD_Cont_Margin,
						   SUM(sp.Billings) AS LTD_Billing,
						    SUM(sp.WIP) AS wip,
							 SUM(sp.Debtors) AS Debtors,

                            SUM(sp.Fees1)  AS YTD_Fees1,
                           SUM(sp.Reimb1) AS YTD_Reimb1,
                           SUM(sp.Total_Rev1) AS YTD_Total_Rev1,
                           SUM(sp.Salary1) AS YTD_Salary1,
                           SUM(sp.Reim_Cost1) AS YTD_Reim_Cost1,
                           SUM(sp.Total_Cost1) AS YTD_Total_Cost1,
                           SUM(sp.Contrib1) AS YTD_Contrib1,
                           SUM(sp.Cont_Margin1) AS YTD_Cont_Margin1,


                            SUM(sp.Fees2)  AS LTD_Fees2,
                           SUM(sp.Reimb2) AS LTD_Reimb2,
                           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                           SUM(sp.Salary2) AS LTD_Salary2,
                           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                           SUM(sp.Contrib2) AS LTD_Contrib2,
                           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity,
						   sp.project

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.project_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $eshsListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $eshsListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $eshsListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($sub_project) && $sub_project!="" && $sub_project!=0 && $sub_project!=NULL){
                       
                          $eshsListQuery .= " AND sp.project = '".$sub_project."' ";
						  
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $eshsListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $eshsListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $eshsListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $eshsListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $eshsListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	 $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$eshsListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
        $totalProjectdata['sum_Fees_MTD'] = $totalProjectRes['MTD_Fees'];
        $totalProjectdata['sum_Reimb_MTD'] = $totalProjectRes['MTD_Reimb'];
        $totalProjectdata['sum_Total_Rev_MTD'] = $totalProjectRes['MTD_Total_Rev'];
        $totalProjectdata['sum_Salary_MTD'] = $totalProjectRes['MTD_Salary'];
        $totalProjectdata['sum_Reim_Cost_MTD'] = $totalProjectRes['MTD_Reim_Cost'];
        $totalProjectdata['sum_Total_Cost_MTD'] =  $totalProjectRes['MTD_Total_Cost'];
        $totalProjectdata['sum_Contrib_MTD'] =  $totalProjectRes['MTD_Contrib'];
        $totalProjectdata['sum_Cont_Margin_MTD'] =  $totalProjectRes['MTD_Cont_Margin'];
		 $totalProjectdata['sum_LTD_Billing'] =  $totalProjectRes['LTD_Billing'];
		  $totalProjectdata['sum_wip'] =  $totalProjectRes['wip'];
		   $totalProjectdata['sum_Debtors'] =  $totalProjectRes['Debtors'];

        $totalProjectdata['sum_Fees_YTD'] = $totalProjectRes['YTD_Fees1'];
        $totalProjectdata['sum_Reimb_YTD'] = $totalProjectRes['YTD_Reimb1'];
        $totalProjectdata['sum_Total_Rev_YTD'] = $totalProjectRes['YTD_Total_Rev1'];
        $totalProjectdata['sum_Salary_YTD'] = $totalProjectRes['YTD_Salary1'];
        $totalProjectdata['sum_Reim_Cost_YTD'] = $totalProjectRes['YTD_Reim_Cost1'];
        $totalProjectdata['sum_Total_Cost_YTD'] =  $totalProjectRes['YTD_Total_Cost1'];
        $totalProjectdata['sum_Contrib_YTD'] =  $totalProjectRes['YTD_Contrib1'];
        $totalProjectdata['sum_Cont_Margin_YTD'] =  $totalProjectRes['YTD_Cont_Margin1'];

        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td align="right"><?php echo number_format($totalProjectdata['sum_Fees_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Salary_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_MTD'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_MTD']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_MTD']/$totalProjectdata['sum_Fees_MTD']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td align="right"><?php echo number_format($totalProjectdata['sum_LTD_Billing'],0);?></td>
                        <td align="right"><?php echo number_format($totalProjectdata['sum_wip'],0);?></td>
                        <td align="right"><?php echo number_format($totalProjectdata['sum_Debtors'],0);?></td>
                       
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					  } // end 12 months data loop?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
              
               <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="background-color: #79a9ce">
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">LTD Fees</th>
                      <th align="center" style="background-color: #79a9ce">LTD Reimb </th>
                      <th align="center" style="background-color: #79a9ce">LTD Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">LTD Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Contrib</th>
                      <th align="center" style="background-color: #79a9ce">LTD Contrib Margin</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);

$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
				
   $newdate=date("Y-m-d",strtotime ($current_date));
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $LtdListQuery  = "SELECT 
                              smt.*, 
                         

                            SUM(sp.Fees2)  AS LTD_Fees2,
                           SUM(sp.Reimb2) AS LTD_Reimb2,
                           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                           SUM(sp.Salary2) AS LTD_Salary2,
                           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                           SUM(sp.Contrib2) AS LTD_Contrib2,
                           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity,
						   sp.project

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.project_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $LtdListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $LtdListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $LtdListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($sub_project) && $sub_project!="" && $sub_project!=0 && $sub_project!=NULL){
                       
                          $LtdListQuery .= " AND sp.project = '".$sub_project."' ";
						  
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $LtdListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $LtdListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $LtdListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $LtdListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $LtdListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  //echo $LtdListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$LtdListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
        

       
        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_LTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_LTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_LTD'],0); ?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Salary_LTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_LTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_LTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_LTD'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_LTD']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_LTD']/$totalProjectdata['sum_Fees_LTD']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					 ?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
               
               <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="background-color: #79a9ce">
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">ETC Fees</th>
                      <th align="center" style="background-color: #79a9ce">ETC Reimb </th>
                      <th align="center" style="background-color: #79a9ce">ETC Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">ETC Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">ETC Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">ETC Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">ETC Contrib</th>
                      <th align="center" style="background-color: #79a9ce">ETC Contrib Margin</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);

$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
				
   $newdate=date("Y-m-d", strtotime ($current_date)) ;
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $ETCListQuery  = "SELECT 
                              smt.*, 
                          
                           SUM(sp.Fees4)  AS ETC_Fees4,
                           SUM(sp.Reimb4) AS ETC_Reimb4,
                           SUM(sp.Total_Rev4) AS ETC_Total_Rev4,
                           SUM(sp.Salary4) AS ETC_Salary4,
                           SUM(sp.Reim_Cost4) AS ETC_Reim_Cost4,
                           SUM(sp.Total_Cost4) AS ETC_Total_Cost4,
                           SUM(sp.Contrib4) AS ETC_Contrib4,
                           SUM(sp.Cont_Margin4) AS ETC_Cont_Margin4,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity,
						   sp.project

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.project_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $ETCListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $ETCListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $ETCListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                    if(isset($sub_project) && $sub_project!="" && $sub_project!=0 && $sub_project!=NULL){
                       
                          $ETCListQuery .= " AND sp.project = '".$sub_project."' ";
						  
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $ETCListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $ETCListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $ETCListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $ETCListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $ETCListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  //echo $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$ETCListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
      
	       $totalProjectdata['sum_Fees_ETC'] = $totalProjectRes['ETC_Fees4'];
        $totalProjectdata['sum_Reimb_ETC'] = $totalProjectRes['ETC_Reimb4'];
        $totalProjectdata['sum_Total_Rev_ETC'] = $totalProjectRes['ETC_Total_Rev4'];
        $totalProjectdata['sum_Salary_ETC'] = $totalProjectRes['ETC_Salary4'];
        $totalProjectdata['sum_Reim_Cost_ETC'] = $totalProjectRes['ETC_Reim_Cost4'];
        $totalProjectdata['sum_Total_Cost_ETC'] =  $totalProjectRes['ETC_Total_Cost4'];
        $totalProjectdata['sum_Contrib_ETC'] =  $totalProjectRes['ETC_Contrib4'];
        $totalProjectdata['sum_Cont_Margin_ETC'] =  $totalProjectRes['ETC_Cont_Margin4'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_ETC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_ETC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_ETC'],0); ?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Salary_ETC'],0);?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Reim_Cost_ETC'],0);?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Total_Cost_ETC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_ETC'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_ETC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_ETC']/$totalProjectdata['sum_Fees_ETC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					?>
                  </tbody>
                </table>
              </div>
               </div>
               </div>
                <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">EAC Fees</th>
                      <th align="center" style="background-color: #79a9ce">EAC Reimb </th>
                      <th align="center" style="background-color: #79a9ce">EAC Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">EAC Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Contrib</th>
                      <th align="center" style="background-color: #79a9ce">EAC Contrib Margin</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
					
   $newdate=date("Y-m-d", strtotime ($current_date));
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $EACListQuery  = "SELECT 
                              smt.*, 
                          SUM(sp.Fees3)  AS EAC_Fees3,
                           SUM(sp.Reimb3) AS EAC_Reimb3,
                           SUM(sp.Total_Rev3) AS EAC_Total_Rev3,
                           SUM(sp.Salary3) AS EAC_Salary3,
                           SUM(sp.Reim_Cost3) AS EAC_Reim_Cost3,
                           SUM(sp.Total_Cost3) AS EAC_Total_Cost3,
                           SUM(sp.Contrib3) AS EAC_Contrib3,
                           SUM(sp.Cont_Margin3) AS EAC_Cont_Margin3,
                           sp.project,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.project_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $EACListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $EACListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $EACListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                     if(isset($sub_project) && $sub_project!="" && $sub_project!=0 && $sub_project!=NULL){
                       
                          $EACListQuery .= " AND sp.project = '".$sub_project."' ";
						  
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $EACListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $EACListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $EACListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $EACListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $EACListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  //echo $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$EACListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
       
        $totalProjectdata['sum_Fees_EAC'] = $totalProjectRes['EAC_Fees3'];
        $totalProjectdata['sum_Reimb_EAC'] = $totalProjectRes['EAC_Reimb3'];
        $totalProjectdata['sum_Total_Rev_EAC'] = $totalProjectRes['EAC_Total_Rev3'];
        $totalProjectdata['sum_Salary_EAC'] = $totalProjectRes['EAC_Salary3'];
        $totalProjectdata['sum_Reim_Cost_EAC'] = $totalProjectRes['EAC_Reim_Cost3'];
        $totalProjectdata['sum_Total_Cost_EAC'] =  $totalProjectRes['EAC_Total_Cost3'];
        $totalProjectdata['sum_Contrib_EAC'] =  $totalProjectRes['EAC_Contrib3'];
        $totalProjectdata['sum_Cont_Margin_EAC'] =  $totalProjectRes['EAC_Cont_Margin3'];
		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_EAC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_EAC'],0); ?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Total_Rev_EAC'],0); ?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Salary_EAC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_EAC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_EAC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_EAC'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_EAC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_EAC']/$totalProjectdata['sum_Fees_EAC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					?>
                  </tbody>
                </table>
              </div>
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
<br/><br/>
        <?php }}
		else
		{
			$Project_Type=NULL;
			$Status =NULL;
            $entity =NULL;?>
        <div class="row">
          <div class="col-12">
            <div class="card" >
              <div class="card-header"  style="background-color: #1d3a67; color: white; ">
                <h3 class="card-title"><bold><?php /*if(isset($did) && empty($did)){*/ echo "SACA DIVISION &raquo Fee MTD (AUD)";//}
				if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquo Fee MTD';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
           
              <div class="card-body table-responsive p-0">
                <table class="table table-striped text-nowrap">
                  <thead>
                    <tr style="background-color: #79a9ce">
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">MTD Fees</th>
                      <th align="center" style="background-color: #79a9ce">MTD Reimb </th>
                      <th align="center" style="background-color: #79a9ce">MTD Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">MTD Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">MTD Contrib</th>
                      <th align="center" style="background-color: #79a9ce">MTD Contrib Margin</th>
                      <th align="center" style="background-color: #79a9ce">LTD Billing</th>
                      <th align="center" style="background-color: #79a9ce">WIP</th>
                      <th align="center" style="background-color: #79a9ce">Debtor</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
					for($j=0;$j<12;$j++)
{
   $newdate=date("Y-m-d", strtotime ('-'.$j.' month' , strtotime ($current_date)))."<br/>" ;
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $eshsListQuery  = "SELECT 
                              smt.*, 
                           SUM(sp.Fees)  AS MTD_Fees,
                           SUM(sp.Reimb) AS MTD_Reimb,
                           SUM(sp.Total_Rev) AS MTD_Total_Rev,
                           SUM(sp.Salary) AS MTD_Salary,
                           SUM(sp.Reim_Cost) AS MTD_Reim_Cost,
                           SUM(sp.Total_Cost) AS MTD_Total_Cost,
                           SUM(sp.Contrib) AS MTD_Contrib,
                           SUM(sp.Cont_Margin) AS MTD_Cont_Margin,
						   SUM(sp.Billings) AS LTD_Billing,
						    SUM(sp.WIP) AS wip,
							 SUM(sp.Debtors) AS Debtors,

                            SUM(sp.Fees1)  AS YTD_Fees1,
                           SUM(sp.Reimb1) AS YTD_Reimb1,
                           SUM(sp.Total_Rev1) AS YTD_Total_Rev1,
                           SUM(sp.Salary1) AS YTD_Salary1,
                           SUM(sp.Reim_Cost1) AS YTD_Reim_Cost1,
                           SUM(sp.Total_Cost1) AS YTD_Total_Cost1,
                           SUM(sp.Contrib1) AS YTD_Contrib1,
                           SUM(sp.Cont_Margin1) AS YTD_Cont_Margin1,


                            SUM(sp.Fees2)  AS LTD_Fees2,
                           SUM(sp.Reimb2) AS LTD_Reimb2,
                           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                           SUM(sp.Salary2) AS LTD_Salary2,
                           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                           SUM(sp.Contrib2) AS LTD_Contrib2,
                           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.master_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $eshsListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $eshsListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $eshsListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($project) && $project!="" && $project!=0 && $project!=NULL){
                       
                          $eshsListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
						  $projListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $eshsListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $eshsListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $eshsListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $eshsListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $eshsListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				   $eshsListQuery .=" order by  smt.pid";        
	  //echo $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$eshsListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
        $totalProjectdata['sum_Fees_MTD'] = $totalProjectRes['MTD_Fees'];
        $totalProjectdata['sum_Reimb_MTD'] = $totalProjectRes['MTD_Reimb'];
        $totalProjectdata['sum_Total_Rev_MTD'] = $totalProjectRes['MTD_Total_Rev'];
        $totalProjectdata['sum_Salary_MTD'] = $totalProjectRes['MTD_Salary'];
        $totalProjectdata['sum_Reim_Cost_MTD'] = $totalProjectRes['MTD_Reim_Cost'];
        $totalProjectdata['sum_Total_Cost_MTD'] =  $totalProjectRes['MTD_Total_Cost'];
        $totalProjectdata['sum_Contrib_MTD'] =  $totalProjectRes['MTD_Contrib'];
        $totalProjectdata['sum_Cont_Margin_MTD'] =  $totalProjectRes['MTD_Cont_Margin'];
		 $totalProjectdata['sum_LTD_Billing'] =  $totalProjectRes['LTD_Billing'];
		  $totalProjectdata['sum_wip'] =  $totalProjectRes['wip'];
		   $totalProjectdata['sum_Debtors'] =  $totalProjectRes['Debtors'];

        $totalProjectdata['sum_Fees_YTD'] = $totalProjectRes['YTD_Fees1'];
        $totalProjectdata['sum_Reimb_YTD'] = $totalProjectRes['YTD_Reimb1'];
        $totalProjectdata['sum_Total_Rev_YTD'] = $totalProjectRes['YTD_Total_Rev1'];
        $totalProjectdata['sum_Salary_YTD'] = $totalProjectRes['YTD_Salary1'];
        $totalProjectdata['sum_Reim_Cost_YTD'] = $totalProjectRes['YTD_Reim_Cost1'];
        $totalProjectdata['sum_Total_Cost_YTD'] =  $totalProjectRes['YTD_Total_Cost1'];
        $totalProjectdata['sum_Contrib_YTD'] =  $totalProjectRes['YTD_Contrib1'];
        $totalProjectdata['sum_Cont_Margin_YTD'] =  $totalProjectRes['YTD_Cont_Margin1'];

        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_MTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Salary_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_MTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_MTD'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_MTD']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_MTD']/$totalProjectdata['sum_Fees_MTD']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td><?php echo number_format($totalProjectdata['sum_LTD_Billing'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['sum_wip'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['sum_Debtors'],0);?></td>
                       
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					  } // end 12 months data loop?>
                  </tbody>
                </table>
              </div>
               </div>
               </div>
                <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="background-color: #79a9ce">
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">LTD Fees</th>
                      <th align="center" style="background-color: #79a9ce">LTD Reimb </th>
                      <th align="center" style="background-color: #79a9ce">LTD Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">LTD Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">LTD Contrib</th>
                      <th align="center" style="background-color: #79a9ce">LTD Contrib Margin</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
				
   $newdate=date("Y-m-d",strtotime ($current_date));
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $LtdListQuery  = "SELECT 
                              smt.*, 
                         

                            SUM(sp.Fees2)  AS LTD_Fees2,
                           SUM(sp.Reimb2) AS LTD_Reimb2,
                           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                           SUM(sp.Salary2) AS LTD_Salary2,
                           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                           SUM(sp.Contrib2) AS LTD_Contrib2,
                           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.master_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $LtdListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $LtdListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $LtdListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($project) && $project!="" && $project!=0 && $project!=NULL){
                       
                          $LtdListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
						  $projListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $LtdListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $LtdListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $LtdListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $LtdListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $LtdListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  $LtdListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$LtdListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
        

       
        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_LTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_LTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_LTD'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Salary_LTD'],0);?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Reim_Cost_LTD'],0);?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Total_Cost_LTD'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_LTD'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_LTD']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_LTD']/$totalProjectdata['sum_Fees_LTD']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					 ?>
                  </tbody>
                </table>
              </div>
             </div>
             </div>
              <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr style="background-color:#79a9ce">
                      <th align="center" style="background-color:#79a9ce">Month</th>
                      <th align="center" style="background-color:#79a9ce">ETC Fees</th>
                      <th align="center" style="background-color:#79a9ce">ETC Reimb </th>
                      <th align="center" style="background-color:#79a9ce">ETC Total Rev</th>
                      <th align="center" style="background-color:#79a9ce">ETC Salary Cost</th>
                      <th align="center" style="background-color:#79a9ce">ETC Other Cost</th>
                      <th align="center" style="background-color:#79a9ce">ETC Total Cost</th>
                      <th align="center" style="background-color:#79a9ce">ETC Contrib</th>
                      <th align="center" style="background-color:#79a9ce">ETC Contrib Margin</th>
                      <th style="background-color:#79a9ce">&nbsp;</th>
                      <th style="background-color:#79a9ce">&nbsp;</th>
                      <th style="background-color:#79a9ce">&nbsp;</th>
                      
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
				
   $newdate=date("Y-m-d", strtotime ($current_date)) ;
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $ETCListQuery  = "SELECT 
                              smt.*, 
                          
                           SUM(sp.Fees4)  AS ETC_Fees4,
                           SUM(sp.Reimb4) AS ETC_Reimb4,
                           SUM(sp.Total_Rev4) AS ETC_Total_Rev4,
                           SUM(sp.Salary4) AS ETC_Salary4,
                           SUM(sp.Reim_Cost4) AS ETC_Reim_Cost4,
                           SUM(sp.Total_Cost4) AS ETC_Total_Cost4,
                           SUM(sp.Contrib4) AS ETC_Contrib4,
                           SUM(sp.Cont_Margin4) AS ETC_Cont_Margin4,
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.master_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $ETCListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $ETCListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $ETCListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($project) && $project!="" && $project!=0 && $project!=NULL){
                       
                          $ETCListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
						  $projListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $ETCListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $ETCListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $ETCListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $ETCListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $ETCListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  //echo $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$ETCListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
      
	       $totalProjectdata['sum_Fees_ETC'] = $totalProjectRes['ETC_Fees4'];
        $totalProjectdata['sum_Reimb_ETC'] = $totalProjectRes['ETC_Reimb4'];
        $totalProjectdata['sum_Total_Rev_ETC'] = $totalProjectRes['ETC_Total_Rev4'];
        $totalProjectdata['sum_Salary_ETC'] = $totalProjectRes['ETC_Salary4'];
        $totalProjectdata['sum_Reim_Cost_ETC'] = $totalProjectRes['ETC_Reim_Cost4'];
        $totalProjectdata['sum_Total_Cost_ETC'] =  $totalProjectRes['ETC_Total_Cost4'];
        $totalProjectdata['sum_Contrib_ETC'] =  $totalProjectRes['ETC_Contrib4'];
        $totalProjectdata['sum_Cont_Margin_ETC'] =  $totalProjectRes['ETC_Cont_Margin4'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_ETC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reimb_ETC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_ETC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Salary_ETC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_ETC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_ETC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Contrib_ETC'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_ETC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_ETC']/$totalProjectdata['sum_Fees_ETC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					?>
                  </tbody>
                </table>
              </div>
              </div>
              </div>
               <div class="col-12">
            <div class="card" >
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th align="center" style="background-color: #79a9ce">Month</th>
                      <th align="center" style="background-color: #79a9ce">EAC Fees</th>
                      <th align="center" style="background-color: #79a9ce">EAC Reimb </th>
                      <th align="center" style="background-color: #79a9ce">EAC Total Rev</th>
                      <th align="center" style="background-color: #79a9ce">EAC Salary Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Other Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Total Cost</th>
                      <th align="center" style="background-color: #79a9ce">EAC Contrib</th>
                      <th align="center" style="background-color: #79a9ce">EAC Contrib Margin</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      <th style="background-color: #79a9ce">&nbsp;</th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php  
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$entity     = trim($_REQUEST['entity']);

				              
	     
					}
					
					
					
					
   $newdate=date("Y-m-d", strtotime ($current_date));
   $final_date=explode('-',$newdate);
 $year=$final_date[0];
  $month=(int)$final_date[1];

   $EACListQuery  = "SELECT 
                              smt.*, 
                          SUM(sp.Fees3)  AS EAC_Fees3,
                           SUM(sp.Reimb3) AS EAC_Reimb3,
                           SUM(sp.Total_Rev3) AS EAC_Total_Rev3,
                           SUM(sp.Salary3) AS EAC_Salary3,
                           SUM(sp.Reim_Cost3) AS EAC_Reim_Cost3,
                           SUM(sp.Total_Cost3) AS EAC_Total_Cost3,
                           SUM(sp.Contrib3) AS EAC_Contrib3,
                           SUM(sp.Cont_Margin3) AS EAC_Cont_Margin3,
                           
						   sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year,
						   sp.entity

                     
                          FROM saca_project_master as smt

                          Inner Join saca_profitability as sp

                          ON (smt.master_code = sp.project)
                         
                           Where 1=1 ";
      $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 "; ?>

<?php            if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
                         $EACListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						  $projListQuery .= " AND smt.division = '".$_REQUEST['did']."' ";
						 
                  }
                  if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
                         $EACListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
						 $projListQuery .= " AND smt.region = '".$_REQUEST['rid']."' ";
                  }
                  if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL ){
                         $EACListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
						 $projListQuery .= " AND smt.country = '".$_REQUEST['cid']."' ";
                  }
                   if(isset($project) && $project!="" && $project!=0 && $project!=NULL){
                       
                          $EACListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
						  $projListQuery .= " AND smt.master_code = '".$_REQUEST['project']."' ";
                  }
				   if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
                       
                          $EACListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
						  $projListQuery .= " AND smt.sector = '".$_REQUEST['sid']."' ";
                  }
				   if(isset($Project_Type) && $Project_Type!=NULL){
                       
                          $EACListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
						  $projListQuery .= " AND sp.Project_Type = '".$_REQUEST['Project_Type']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $EACListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($month) && $month!=0 && $month!="" && $month!=NULL){
                       
                          $EACListQuery .= " AND sp.month = '".$month."' ";
                  }
				  
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $EACListQuery .= " AND sp.year = '".$year."' ";
						  $projListQuery .= " AND sp.year = '".$year."' ";
                  }       
				  
				  // $eshsListQuery .=" order by  smt.pid";        
	  //echo $eshsListQuery."<br/>";
     $totalProjectResult = mysqli_query($con,$EACListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
		  if(isset($totalProjectRes['month'])&& $totalProjectRes['month']!=0&&$totalProjectRes['month']!=NULL)
		  {
       
        $totalProjectdata['sum_Fees_EAC'] = $totalProjectRes['EAC_Fees3'];
        $totalProjectdata['sum_Reimb_EAC'] = $totalProjectRes['EAC_Reimb3'];
        $totalProjectdata['sum_Total_Rev_EAC'] = $totalProjectRes['EAC_Total_Rev3'];
        $totalProjectdata['sum_Salary_EAC'] = $totalProjectRes['EAC_Salary3'];
        $totalProjectdata['sum_Reim_Cost_EAC'] = $totalProjectRes['EAC_Reim_Cost3'];
        $totalProjectdata['sum_Total_Cost_EAC'] =  $totalProjectRes['EAC_Total_Cost3'];
        $totalProjectdata['sum_Contrib_EAC'] =  $totalProjectRes['EAC_Contrib3'];
        $totalProjectdata['sum_Cont_Margin_EAC'] =  $totalProjectRes['EAC_Cont_Margin3'];

		 $totalProjectdata['Project_Type'] =  $totalProjectRes['Project_Type'];
		  $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['month'] =  $totalProjectRes['month'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
			
			$days=cal_days_in_month(CAL_GREGORIAN, $totalProjectdata['month'],$totalProjectdata['year']);
			$ppr_month=$totalProjectdata['year']."-". $totalProjectdata['month']."-".$days;
			$ppr_date=date('F-Y',strtotime($ppr_month));
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
     
	?>

                     <tr>
                         <td  ><?php echo $ppr_date; ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Fees_EAC'],0); ?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Reimb_EAC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Rev_EAC'],0); ?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Salary_EAC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Reim_Cost_EAC'],0);?></td>
                        <td  align="right"><?php echo number_format($totalProjectdata['sum_Total_Cost_EAC'],0);?></td>
                        <td align="right" ><?php echo number_format($totalProjectdata['sum_Contrib_EAC'],0);?></td>
                        <td  align="right"><?php 
						if($totalProjectdata['sum_Fees_EAC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_EAC']/$totalProjectdata['sum_Fees_EAC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?>%</td>
                         <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                      </tr>
                      <?php
		                }  // check for blank row record
					    } 
                      }  
					?>
                  </tbody>
                </table>
              </div>
            
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <?php }?>

         


        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   
  
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <?php //include("partials/footer.php")?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->

<!-- Bootstrap 4 -->
<script src="../../sacadb/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../sacadb/theme/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../sacadb/theme/dist/js/adminlte.min.js"></script>

   
</body>
</html>