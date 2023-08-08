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


//print_r($singleProjectdata['Cont_Margin_LTD']);exit;
####get sum of whole project in saca###

     $eshsListQuery  = "SELECT 
                              smt.*,
                           SUM(sp.Fees3)  AS EAC_Fees3,
                           SUM(sp.Reimb3) AS EAC_Reimb3,
                           SUM(sp.Total_Rev3) AS EAC_Total_Rev3,
                           SUM(sp.Salary3) AS EAC_Salary3,
                           SUM(sp.Reim_Cost3) AS EAC_Reim_Cost3,
                           SUM(sp.Total_Cost3) AS EAC_Total_Cost3,
                           SUM(sp.Contrib3) AS EAC_Contrib3,
                           SUM(sp.Cont_Margin3) AS EAC_Cont_Margin3,


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

                          ON smt.master_code = sp.project
                         
                           Where 1=1";
                           
          
		  $projListQuery =NULL;
		   $projListQuery  = "select DISTINCT(smt.master_code)
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.master_code = sp.project Where 1=1 "; 
                    
					if(isset($_GET["search"])){ 
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     = trim($_REQUEST['Project_Type']);
$Status     = trim($_REQUEST['Status']);
$fmonth      = trim($_REQUEST['fmonth']);
$year        = trim($_REQUEST['year']);
$entity     = trim($_REQUEST['entity']);
  
				 if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
					 
					 
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
				   if(isset($Status) && $Status!=NULL){
                       
                          $eshsListQuery .= " AND sp.Status = '".$_REQUEST['Status']."' ";
						  $projListQuery .= " AND sp.Status = '".$_REQUEST['Status']."' ";
                  }
				   if(isset($entity) && $entity!=NULL){
                       
                          $eshsListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
						  $projListQuery .= " AND sp.entity = '".$_REQUEST['entity']."' ";
                  }
				   if(isset($fmonth) && $fmonth!=0 && $fmonth!="" && $fmonth!=NULL){
                       
                          $eshsListQuery .= " AND sp.month = '".$_REQUEST['fmonth']."' ";
                  }
				   if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
                       
                          $eshsListQuery .= " AND sp.year = '".$_REQUEST['year']."' ";
						  $projListQuery .= " AND sp.year = '".$_REQUEST['year']."' ";
                  }                     
	  }       
        $projListQuery .=" order by  smt.pid";              
     $totalProjectResult = mysqli_query($con,$eshsListQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
        
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
      
        $totalProjectdata['sum_Fees_EAC'] = $totalProjectRes['EAC_Fees3'];
        $totalProjectdata['sum_Reimb_EAC'] = $totalProjectRes['EAC_Reimb3'];
        $totalProjectdata['sum_Total_Rev_EAC'] = $totalProjectRes['EAC_Total_Rev3'];
        $totalProjectdata['sum_Salary_EAC'] = $totalProjectRes['EAC_Salary3'];
        $totalProjectdata['sum_Reim_Cost_EAC'] = $totalProjectRes['EAC_Reim_Cost3'];
        $totalProjectdata['sum_Total_Cost_EAC'] =  $totalProjectRes['EAC_Total_Cost3'];
        $totalProjectdata['sum_Contrib_EAC'] =  $totalProjectRes['EAC_Contrib3'];
        $totalProjectdata['sum_Cont_Margin_EAC'] =  $totalProjectRes['EAC_Cont_Margin3'];

        $totalProjectdata['sum_Fees_ETC'] = $totalProjectRes['ETC_Fees4'];
        $totalProjectdata['sum_Reimb_ETC'] = $totalProjectRes['ETC_Reimb4'];
        $totalProjectdata['sum_Total_Rev_ETC'] = $totalProjectRes['ETC_Total_Rev4'];
        $totalProjectdata['sum_Salary_ETC'] = $totalProjectRes['ETC_Salary4'];
        $totalProjectdata['sum_Reim_Cost_ETC'] = $totalProjectRes['ETC_Reim_Cost4'];
        $totalProjectdata['sum_Total_Cost_ETC'] =  $totalProjectRes['ETC_Total_Cost4'];
        $totalProjectdata['sum_Contrib_ETC'] =  $totalProjectRes['ETC_Contrib4'];
        $totalProjectdata['sum_Cont_Margin_ETC'] =  $totalProjectRes['ETC_Cont_Margin4'];
       $totalProjectdata['Status'] =  $totalProjectRes['Status'];
		   $totalProjectdata['fmonth'] =  $totalProjectRes['fmonth'];
		    $totalProjectdata['year'] =  $totalProjectRes['year'];
       
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
       } 
    }
    ####get sum of whole project inside saca###
 ?>
 <?php //print_r($totalProjectdata['sum_Cont_Margin_LTD']);?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>EAC & ETC Analysis</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
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
            <h1><?php if(isset($totalProjectdata)){ echo "SACA DIVISION &raquo EAC & ETC (AUD)";}if(isset($singleProjectdata)){ echo 'Fee Analysis &raquo '.$singleProjectdata['project']." - ".$singleProjectdata['Project_Description'];}?>
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

     <div class="card card-danger"id="filter-sec">
      <!-- <div class="card-header">
        <h3 class="card-title">Different Width</h3>
      </div> -->
      <div class="card-body" >
        <form method="get" id="form-id" action="">
          <div class="row">
          <div class="col-2"> 
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
                                        ";   
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
                       echo $incListQuery  = "SELECT DISTINCT entity
                                  FROM saca_overhead_master  ";
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
                <select class="custom-select" name="project" id="project">
                  <option value="">Project</option>
                  <?php if($con){
                       /*echo $incListQuery  = "SELECT master_code
                      FROM saca_project_master WHERE master_code = '".$project."' order by  pid ";*/
					 $incListQuery=$projListQuery;
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['master_code']; ?>" <?php if(isset($project) && $project!=0 && $project!="" && $project!=NULL &&$project==$incListRes['master_code']){?> selected <?php }?>><?php echo $incListRes['master_code']; ?></option>
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
							$("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
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
							$("#Status").val($("#Status option:first").val());
							$("#entity").val($("#entity option:first").val()); 
							$("#Project_Type").val($("#Project_Type option:first").val());
							$("#project").html('<option value="">Project </option>');
							
                                }
                            }); 
                        }else{
                            $('#cid').html('<option value="">Select Region first</option>'); 
							$("#sid").val($("#sid option:first").val());
							$("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
							$("#project").html('<option value="">Project </option>'); 
							$("#entity").val($("#entity option:first").val()); 
							
							
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
							$("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
							
							
                                }
                            }); 
                        }else{
							$("#sid").val($("#sid option:first").val());
							$("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
                            $('#project').html('<option value="">Project</option>'); 
							
							
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
									$("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
							
							
                                }
                            }); 
                        }else{
                            $("#Status").val($("#Status option:first").val());
							$("#Project_Type").val($("#Project_Type option:first").val());
							
							
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
									$("#Status").val($("#Status option:first").val());
									$("#entity").val($("#entity option:first").val()); 
									
									
                                }
                            }); 
                        }else{
                            $("#Status").val($("#Status option:first").val());
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
									$("#Status").val($("#Status option:first").val());
									
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
								  $('#project').html('<option value="">Project</option>'); 
								  $("#Status").val($("#Status option:first").val());
								  
									
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
									$("#Status").val($("#Status option:first").val());
									
									
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
						  
						 
                        if(typeof Status != "undefined" && Status){
							//alert('cid='+cid+'sid='+sid)
							//alert(Project_Type);
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
									$("#Status").val($("#Status option:first").val());
									
									
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
                            <?php if(isset($fmonth) && $fmonth==$incListRes['month']){ echo "selected";} ?> ><?php echo date('F',strtotime("01-".$incListRes['month']."-".$incListRes['year'])); ?></option>
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
                             <?php if(isset($year) && $year!=0 && $year!="" && $year!=NULL &&$year==$incListRes['year']){ echo "selected";} ?>
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
        <div class="row">
          <div class="col-md-6">
        
        
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Fee EAC (AUD)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="Fee-EAC" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
          
             <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Fee ETC (AUD)</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="Fee-ETC" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- BAR CHART -->
           
          </div>
          <!-- /.col (RIGHT) -->

        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #1d3a67; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Fee EAC (AUD)";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoFee EAC';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                       <th align="center">Fees EAC</th>
                       <th align="center">Reimb EAC</th>
                       <th align="center">Total Rev EAC</th>
                       <th align="center">Salary EAC</th>
                       <th align="center">Reim Cost EAC</th>
                       <th align="center">Total Cost EAC</th>
                       <th align="center">Contrib EAC</th>
                       <th align="center">Cont Margin EAC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td ><?php echo number_format($totalProjectdata['sum_Fees_EAC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Reimb_EAC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Total_Rev_EAC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Salary_EAC'],0);?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Reim_Cost_EAC'],0);?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Total_Cost_EAC'],0);?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Contrib_EAC'],0);?></td>
                        <td ><?php 
						if($totalProjectdata['sum_Fees_EAC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_EAC']/$totalProjectdata['sum_Fees_EAC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?> %</td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                       <th align="center">Fees EAC</th>
                       <th align="center">Reimb EAC</th>
                       <th align="center">Total Rev EAC</th>
                       <th align="center">Salary EAC</th>
                       <th align="center">Reim Cost EAC</th>
                       <th align="center">Total Cost EAC</th>
                       <th align="center">Contrib EAC</th>
                       <th align="center">Cont Margin EAC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td ><?php echo $singleProjectdata['Fees_EAC']; ?></td>
                        <td ><?php echo $singleProjectdata['Reimb_EAC']; ?></td>
                        <td ><?php echo $singleProjectdata['Total_Rev_EAC']; ?></td>
                        <td ><?php echo $singleProjectdata['Salary_EAC'];?></td>
                        <td ><?php echo $singleProjectdata['Reim_Cost_EAC']?></td>
                        <td ><?php echo $singleProjectdata['Total_Cost_EAC']; ?></td>
                        <td ><?php echo $singleProjectdata['Contrib_EAC']; ?></td>
                        <td ><?php echo $singleProjectdata['Cont_Margin_EAC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <!--YTD-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Fee ETC (AUD)";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoFee ETC';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                       <th align="center">Fees ETC</th>
                       <th align="center">Reimb ETC</th>
                       <th align="center">Total Rev ETC</th>
                       <th align="center">Salary ETC</th>
                       <th align="center">Reim Cost ETC</th>
                       <th align="center">Total Cost ETC</th>
                       <th align="center">Contrib ETC</th>
                       <th align="center">Cont Margin ETC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td ><?php echo number_format($totalProjectdata['sum_Fees_ETC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Reimb_ETC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Total_Rev_ETC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Salary_ETC'],0);?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Reim_Cost_ETC'],0);?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Total_Cost_ETC'],0); ?></td>
                        <td ><?php echo number_format($totalProjectdata['sum_Contrib_ETC'],0); ?></td>
                        <td ><?php 
						if($totalProjectdata['sum_Fees_ETC']!=0)
						{ 
						echo number_format($totalProjectdata['sum_Contrib_ETC']/$totalProjectdata['sum_Fees_ETC']*100,2);
						} 
						else
						{
						echo "0.00";
						}?> %</td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                       <th align="center">Fees ETC</th>
                       <th align="center">Reimb ETC</th>
                       <th align="center">Total Rev ETC</th>
                       <th align="center">Salary ETC</th>
                       <th align="center">Reim Cost ETC</th>
                       <th align="center">Total Cost ETC</th>
                       <th align="center">Contrib ETC</th>
                       <th align="center">Cont Margin ETC</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td ><?php echo $singleProjectdata['Fees_ETC']; ?></td>
                        <td ><?php echo $singleProjectdata['Reimb_ETC']; ?></td>
                        <td ><?php echo $singleProjectdata['Total_Rev_ETC']; ?></td>
                        <td ><?php echo $singleProjectdata['Salary_ETC'];?></td>
                        <td ><?php echo $singleProjectdata['Reim_Cost_ETC']?></td>
                        <td ><?php echo $singleProjectdata['Total_Cost_ETC']; ?></td>
                        <td ><?php echo $singleProjectdata['Contrib_ETC']; ?></td>
                        <td ><?php echo $singleProjectdata['Cont_Margin_ETC']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        

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
    <!-- Control sidebar content goes here -->
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

<script type="text/javascript">
  

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true
////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-EAC')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Fee', 'Reimb', 'Total Rev', 'Salary', 'Reim Cost', 'Total Cost', 'Contrib','Cont Margin'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['sum_Fees_EAC']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_EAC']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_EAC']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_EAC']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_EAC']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_EAC'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_EAC']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_EAC']; ?>,
                 <?php  echo $singleProjectdata['Salary_EAC']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_EAC'];?>, 
                  <?php  echo $singleProjectdata['Salary_EAC'];?>, 
                  <?php  echo $singleProjectdata['Salary_EAC']; ?>,
                  <?php  echo $singleProjectdata['Salary_EAC']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-ETC')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Fee', 'Reimb', 'Total Rev', 'Salary', 'Reim Cost', 'Total Cost', 'Contrib','Cont Margin'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['sum_Fees_ETC']; ?>,
                 <?php echo $totalProjectdata['sum_Reimb_ETC']; ?>, 
                 <?php echo $totalProjectdata['sum_Total_Rev_ETC']; ?>,
                 <?php echo $totalProjectdata['sum_Salary_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Reim_Cost_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Total_Cost_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Contrib_ETC']; ?> ,
                 <?php echo $totalProjectdata['sum_Cont_Margin_ETC']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Fees_ETC'] ; ?>,
                 <?php  echo $singleProjectdata['Reimb_ETC']; ?>,
                 <?php  echo $singleProjectdata['Total_Rev_ETC']; ?>,
                 <?php  echo $singleProjectdata['Salary_ETC']; ?>,
                 <?php  echo $singleProjectdata['Reim_Cost_ETC'];?>, 
                  <?php  echo $singleProjectdata['Salary_ETC'];?>, 
                  <?php  echo $singleProjectdata['Salary_ETC']; ?>,
                  <?php  echo $singleProjectdata['Salary_ETC']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////


  var $visitorsChart = $('#visitors-chart')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['18th', '20th', '22nd', '24th', '26th', '28th', '30th'],
      datasets: [{
        type: 'line',
        data: [100, 120, 170, 167, 180, 177, 160],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [60, 80, 70, 67, 80, 77, 100],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})

</script>
</script>
</body>
</html>
