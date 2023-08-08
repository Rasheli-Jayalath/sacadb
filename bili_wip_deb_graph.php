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
 


      $eshsListQuery = " select smt.*, sp.*,

          SUM(case when month=1 then WIP end) as wip_jan,
          SUM(case when month=2 then WIP end) as wip_feb,
          SUM(case when month=3 then WIP end) as wip_mar,
          SUM(case when month=4 then WIP end) as wip_apr,
          SUM(case when month=5 then WIP end) as wip_may,
          SUM(case when month=6 then WIP end) as wip_june,
          SUM(case when month=7 then WIP end) as wip_july,
          SUM(case when month=8 then WIP end) as wip_aug,
          SUM(case when month=9 then WIP end) as wip_sep,
          SUM(case when month=10 then WIP end) as wip_oct,
          SUM(case when month=11 then WIP end) as wip_nov,
          SUM(case when month=12 then WIP end) as wip_dec,

          SUM(case when month=1 then Debtors end) as debtors_jan,
          SUM(case when month=2 then Debtors end) as debtors_feb,
          SUM(case when month=3 then Debtors end) as debtors_mar,
          SUM(case when month=4 then Debtors end) as debtors_apr,
          SUM(case when month=5 then Debtors end) as debtors_may,
          SUM(case when month=6 then Debtors end) as debtors_june,
          SUM(case when month=7 then Debtors end) as debtors_july,
          SUM(case when month=8 then Debtors end) as debtors_aug,
          SUM(case when month=9 then Debtors end) as debtors_sep,
          SUM(case when month=10 then Debtors end) as debtors_oct,
          SUM(case when month=11 then Debtors end) as debtors_nov,
          SUM(case when month=12 then Debtors end) as debtors_dec,


          SUM(case when month=1 then Billings end) as billings_jan,
          SUM(case when month=2 then Billings end) as billings_feb,
          SUM(case when month=3 then Billings end) as billings_mar,
          SUM(case when month=4 then Billings end) as billings_apr,
          SUM(case when month=5 then Billings end) as billings_may,
          SUM(case when month=6 then Billings end) as billings_june,
          SUM(case when month=7 then Billings end) as billings_july,
          SUM(case when month=8 then Billings end) as billings_aug,
          SUM(case when month=9 then Billings end) as billings_sep,
          SUM(case when month=10 then Billings end) as billings_oct,
          SUM(case when month=11 then Billings end) as billings_nov,
          SUM(case when month=12 then Billings end) as billings_dec,

          SUM(sp.Billings)  AS Billings,
           SUM(sp.WIP) AS WIP,
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

          ifnull(sum(case when replace(debtor_Days, '>','') <= 30 then debtors end),0) as debtors_30,
          ifnull(sum(case when replace(debtor_Days, '>','') > 30 and replace(debtor_Days, '>','') <= 90 then debtors end),0) as debtors_90, 
          ifnull(sum(case when replace(debtor_Days, '>','') > 90 and replace(debtor_Days, '>','') <= 365 then debtors end),0) as debtors_365, 
          ifnull(sum(case when replace(debtor_Days, '>','') > 365 then debtors end),0) as debtors_1000,

           ifnull(sum(case when replace(WIP_Days, '>','') <= 30 then wip end),0) as wip_30,
                  ifnull(sum(case when replace(WIP_Days, '>','') > 30 and replace(WIP_Days, '>','') <= 90 then wip end),0) as wip_90, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 90 and replace(WIP_Days, '>','') <= 365 then wip end),0) as wip_365, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 365 then wip end),0) as wip_1000,

             ifnull(sum(case when replace(Lockup_Days, '>','') <= 30 then lockup end),0) as lockup_30,
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 30 and replace(Lockup_Days, '>','') <= 90 then lockup end),0) as lockup_90, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 90 and replace(Lockup_Days, '>','') <= 365 then lockup end),0) as lockup_365, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 365 then lockup end),0) as lockup_1000 ,
				  sp.Status,
						   sp.Project_Type,
						   sp.month,
						   sp.year ,
						   sp.entity    

          FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.master_code = sp.project Where 1 ";
		  
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
				   /*if(isset($fmonth) && $fmonth!=0 && $fmonth!="" && $fmonth!=NULL){
                       
                          $eshsListQuery .= " AND sp.month = '".$_REQUEST['fmonth']."' ";
                  }*/
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
        $counterListLoop   = 0;
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
        $totalProjectdata['Billings'] = $totalProjectRes['Billings'];
        $totalProjectdata['WIP'] = $totalProjectRes['WIP'];
        $totalProjectdata['Debtors'] = $totalProjectRes['Debtors'];
       

        $totalProjectdata['wip_jan'] = $totalProjectRes['wip_jan'];
        $totalProjectdata['wip_feb'] = $totalProjectRes['wip_feb'];
        $totalProjectdata['wip_mar'] = $totalProjectRes['wip_mar'];
        $totalProjectdata['wip_apr'] = $totalProjectRes['wip_apr'];
        $totalProjectdata['wip_may'] = $totalProjectRes['wip_may'];
        $totalProjectdata['wip_june'] =  $totalProjectRes['wip_june'];
        $totalProjectdata['wip_july'] =  $totalProjectRes['wip_july'];
        $totalProjectdata['wip_aug'] =  $totalProjectRes['wip_aug'];
        $totalProjectdata['wip_sep'] = $totalProjectRes['wip_sep'];
        $totalProjectdata['wip_oct'] = $totalProjectRes['wip_oct'];
        $totalProjectdata['wip_nov'] = $totalProjectRes['wip_nov'];
        $totalProjectdata['wip_dec'] = $totalProjectRes['wip_dec'];

          $totalProjectdata['debtors_jan'] = $totalProjectRes['debtors_jan'];
        $totalProjectdata['debtors_feb'] = $totalProjectRes['debtors_feb'];
        $totalProjectdata['debtors_mar'] = $totalProjectRes['debtors_mar'];
        $totalProjectdata['debtors_apr'] = $totalProjectRes['debtors_apr'];
        $totalProjectdata['debtors_may'] = $totalProjectRes['debtors_may'];
        $totalProjectdata['debtors_june'] =  $totalProjectRes['debtors_june'];
        $totalProjectdata['debtors_july'] =  $totalProjectRes['debtors_july'];
        $totalProjectdata['debtors_aug'] =  $totalProjectRes['debtors_aug'];
        $totalProjectdata['debtors_sep'] = $totalProjectRes['debtors_sep'];
        $totalProjectdata['debtors_oct'] = $totalProjectRes['debtors_oct'];
        $totalProjectdata['debtors_nov'] = $totalProjectRes['debtors_nov'];
        $totalProjectdata['debtors_dec'] = $totalProjectRes['debtors_dec'];

          $totalProjectdata['billings_jan'] = $totalProjectRes['billings_jan'];
        $totalProjectdata['billings_feb'] = $totalProjectRes['billings_feb'];
        $totalProjectdata['billings_mar'] = $totalProjectRes['billings_mar'];
        $totalProjectdata['billings_apr'] = $totalProjectRes['billings_apr'];
        $totalProjectdata['billings_may'] = $totalProjectRes['billings_may'];
        $totalProjectdata['billings_june'] =  $totalProjectRes['billings_june'];
        $totalProjectdata['billings_july'] =  $totalProjectRes['billings_july'];
        $totalProjectdata['billings_aug'] =  $totalProjectRes['billings_aug'];
        $totalProjectdata['billings_sep'] = $totalProjectRes['billings_sep'];
        $totalProjectdata['billings_oct'] = $totalProjectRes['billings_oct'];
        $totalProjectdata['billings_nov'] = $totalProjectRes['billings_nov'];
        $totalProjectdata['billings_dec'] = $totalProjectRes['billings_dec'];

         $totalProjectdata['debtors_30'] = $totalProjectRes['debtors_30'];
        $totalProjectdata['debtors_90'] = $totalProjectRes['debtors_90'];
        $totalProjectdata['debtors_365'] = $totalProjectRes['debtors_365'];
        $totalProjectdata['debtors_1000'] = $totalProjectRes['debtors_1000'];

          $totalProjectdata['wip_30'] = $totalProjectRes['wip_30'];
        $totalProjectdata['wip_90'] = $totalProjectRes['wip_90'];
        $totalProjectdata['wip_365'] = $totalProjectRes['wip_365'];
        $totalProjectdata['wip_1000'] = $totalProjectRes['wip_1000'];

         $totalProjectdata['lockup_30'] = $totalProjectRes['lockup_30'];
        $totalProjectdata['lockup_90'] = $totalProjectRes['lockup_90'];
        $totalProjectdata['lockup_365'] = $totalProjectRes['lockup_365'];
        $totalProjectdata['lockup_1000'] = $totalProjectRes['lockup_1000'];
     

        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
       
         $counterListLoop++;
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
  <title>Billings, WIP & Lockup Analysis</title>
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
            <h1><?php if(isset($totalProjectdata)){ echo "SACA DIVISION &raquo Billings, WIP & Lockup (AUD)";}if(isset($singleProjectdata)){ echo 'Fee Analysis &raquo '.$singleProjectdata['project']." - ".$singleProjectdata['Project_Description'];}?>
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
             <button type="submit" name="search" id="search" onclick="document.getElementById('form-id').submit();" class="btn btn-success" value="1"> SEARCH </button>
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
                <h3 class="card-title">Billings, WIP & Debtors</h3>

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
                  <canvas id="Fee-MTD" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
            <!-- /.card -->
           
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
          
             <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">Billings, WIP & Debtors Trends</h3>

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
                <canvas id="Trands" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- BAR CHART -->
           
          </div>
          <!-- /.col (RIGHT) -->

                <!-- /.col (LEFT) -->



          <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Debtors </h3>

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
                  <canvas id="debtors_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>

           <div class="col-md-4">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">WIP </h3>

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
                  <canvas id="wip_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>

           <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Lockup </h3>

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
                  <canvas id="lockup_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>




        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Billings, WIP & Debtors";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoBillings, WIP & Debtors';}?></bold></h3>

               
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Billings</th>
                      <th>WIP</th>
                      <th>Debtors</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['Billings'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['WIP'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['Debtors'],0); ?></td>
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
                      <th>Billings</th>
                      <th>WIP</th>
                      <th>Debtors</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['Billings']; ?></td>
                        <td><?php echo $singleProjectdata['WIP']; ?></td>
                        <td><?php echo $singleProjectdata['Debtors']; ?></td>
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoWip Trends";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoWip Trends';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['wip_jan'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_feb'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_mar'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_apr'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['wip_may'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['wip_june'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_july'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_aug'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['wip_sep'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['wip_oct'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['wip_nov'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['wip_dec'],0); ?></td>   
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
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['wip_jan']; ?></td>
                        <td><?php echo $singleProjectdata['wip_feb']; ?></td>
                        <td><?php echo $singleProjectdata['wip_mar']; ?></td>
                        <td><?php echo $singleProjectdata['wip_apr'];?></td>
                        <td><?php echo $singleProjectdata['wip_may']?></td>
                        <td><?php echo $singleProjectdata['wip_june']; ?></td>
                        <td><?php echo $singleProjectdata['wip_july']; ?></td>
                        <td><?php echo $singleProjectdata['wip_aug']; ?></td>
                         <td><?php echo $singleProjectdata['wip_sep']; ?></td>
                         <td><?php echo $singleProjectdata['wip_oct']; ?></td>
                         <td><?php echo $singleProjectdata['wip_nov']; ?></td>
                         <td><?php echo $singleProjectdata['wip_dec']; ?></td>   
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoBillings Trends";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoBillings Trends';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['billings_jan'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['billings_feb'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['billings_mar'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['billings_apr'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['billings_may'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['billings_june'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['billings_july'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['billings_aug'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['billings_sep'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['billings_oct'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['billings_nov'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['billings_dec'],0); ?></td>   
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
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['billings_jan']; ?></td>
                        <td><?php echo $singleProjectdata['billings_feb']; ?></td>
                        <td><?php echo $singleProjectdata['billings_mar']; ?></td>
                        <td><?php echo $singleProjectdata['billings_apr'];?></td>
                        <td><?php echo $singleProjectdata['billings_may']?></td>
                        <td><?php echo $singleProjectdata['billings_june']; ?></td>
                        <td><?php echo $singleProjectdata['billings_july']; ?></td>
                        <td><?php echo $singleProjectdata['billings_aug']; ?></td>
                         <td><?php echo $singleProjectdata['billings_sep']; ?></td>
                         <td><?php echo $singleProjectdata['billings_oct']; ?></td>
                         <td><?php echo $singleProjectdata['billings_nov']; ?></td>
                         <td><?php echo $singleProjectdata['billings_dec']; ?></td>   
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoDebtors Trends";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoDebtors Trends';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['debtors_jan'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_feb'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_mar'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_apr'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_may'],0);?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_june'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_july'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_aug'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['debtors_sep'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['debtors_oct'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['debtors_nov'],0); ?></td>
                         <td><?php echo number_format($totalProjectdata['debtors_dec'],0); ?></td>   
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
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['debtors_jan']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_feb']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_mar']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_apr'];?></td>
                        <td><?php echo $singleProjectdata['debtors_may']?></td>
                        <td><?php echo $singleProjectdata['debtors_june']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_july']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_aug']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_sep']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_oct']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_nov']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_dec']; ?></td>   
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Debtors";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoDebtors';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Debtors &lt;30</th>
                      <th>Debtors 30-90</th>
                      <th>Debtors 90-365</th>
                      <th>Debtors >365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['debtors_30'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_90'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_365'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['debtors_1000'],0);?></td>
                       
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
                      <th>Debtors &lt;30</th>
                      <th>Debtors 30-90</th>
                      <th>Debtors 90-365</th>
                      <th>Debtors >365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['debtors_30']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_90']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_365']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_1000'];?></td>
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo WIP";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoWIP';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>WIP &lt;30 </th>
                      <th>WIP 30-90</th>
                      <th>WIP 90-365</th>
                      <th>WIP >365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['wip_30'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_90'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_365'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['wip_1000'],0);?></td>
                       
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
                      <th>WIP &lt;30 </th>
                      <th>WIP 30-90</th>
                      <th>WIP 90-365</th>
                      <th>WIP >365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['wip_30']; ?></td>
                        <td><?php echo $singleProjectdata['wip_90']; ?></td>
                        <td><?php echo $singleProjectdata['wip_365']; ?></td>
                        <td><?php echo $singleProjectdata['wip_1000'];?></td>
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
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Lockup";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoLockup';}?></bold></h3>

                
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Lockup &lt;30</th>
                      <th>Lockup 30-90</th>
                      <th>Lockup 90-365</th>
                      <th>Lockup &gt;365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo number_format($totalProjectdata['lockup_30'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['lockup_90'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['lockup_365'],0); ?></td>
                        <td><?php echo number_format($totalProjectdata['lockup_1000'],0);?></td>
                       
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
                      <th>Lockup &lt;30</th>
                      <th>Lockup 30-90</th>
                      <th>Lockup 90-365</th>
                      <th>Lockup &gt;365</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['lockup_30']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_90']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_365']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_1000'];?></td>
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
  var $salesChart = $('#Fee-MTD')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Billings', 'WIP', 'Debtors','','',''],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['Billings']; ?>,
                 <?php echo $totalProjectdata['WIP']; ?>, 
                 
                 <?php echo $totalProjectdata['Debtors']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Billings'] ; ?>,
                 <?php  echo $singleProjectdata['WIP']; ?>,
               
                  <?php  echo $singleProjectdata['Debtors']; 
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
  var $salesChart = $('#debtors_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Debtors <30', 'Debtors 30-90', 'Debtors 90-365','Debtors >365'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['debtors_30']; ?>,
                 <?php echo $totalProjectdata['debtors_90']; ?>, 
                  <?php echo $totalProjectdata['debtors_365']; ?>,
                 
                 <?php echo $totalProjectdata['debtors_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['debtors_30'] ; ?>,
                 <?php  echo $singleProjectdata['debtors_90']; ?>,
                 <?php  echo $singleProjectdata['debtors_365']; ?>,
               
                  <?php  echo $singleProjectdata['debtors_1000']; 
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
        display: true
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
 var $salesChart = $('#wip_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['WIP <30', 'WIP 30-90', 'WIP 90-365','WIP >365'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_30']; ?>,
                 <?php echo $totalProjectdata['wip_90']; ?>, 
                  <?php echo $totalProjectdata['wip_365']; ?>,
                 
                 <?php echo $totalProjectdata['wip_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['wip_30'] ; ?>,
                 <?php  echo $singleProjectdata['wip_90']; ?>,
                 <?php  echo $singleProjectdata['wip_365']; ?>,
               
                  <?php  echo $singleProjectdata['wip_1000']; 
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
////////////////////////////////////////////////////////
  var $salesChart = $('#lockup_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Lockup <30', 'Lockup 30-90', 'Lockup 90-365','Lockup >365'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['lockup_30']; ?>,
                 <?php echo $totalProjectdata['lockup_90']; ?>, 
                  <?php echo $totalProjectdata['lockup_365']; ?>,
                 
                 <?php echo $totalProjectdata['lockup_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['lockup_30'] ; ?>,
                 <?php  echo $singleProjectdata['lockup_90']; ?>,
                 <?php  echo $singleProjectdata['lockup_365']; ?>,
               
                  <?php  echo $singleProjectdata['lockup_1000']; 
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
////////////////////////////////////////////////////////

  var $visitorsChart = $('#Trands')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Janury', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [{
        type: 'line',
		label: 'Billing',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['billings_jan']; ?>,
                 <?php echo $totalProjectdata['billings_feb']; ?>, 
                 <?php echo $totalProjectdata['billings_mar']; ?>,
                 <?php echo $totalProjectdata['billings_apr']; ?> ,
                 <?php echo $totalProjectdata['billings_may']; ?> ,
                 <?php echo $totalProjectdata['billings_june']; ?> ,
                 <?php echo $totalProjectdata['billings_july']; ?> ,
                 <?php echo $totalProjectdata['billings_aug']; ?> ,
                 <?php echo $totalProjectdata['billings_sep']; ?> ,
                 <?php echo $totalProjectdata['billings_oct']; ?> ,
                 <?php echo $totalProjectdata['billings_nov']; ?> ,
                
                 <?php echo $totalProjectdata['billings_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['billings_jan']; ?>,
                 <?php echo $singleProjectdata['billings_feb']; ?>, 
                 <?php echo $singleProjectdata['billings_mar']; ?>,
                 <?php echo $singleProjectdata['billings_apr']; ?> ,
                 <?php echo $singleProjectdata['billings_may']; ?> ,
                 <?php echo $singleProjectdata['billings_june']; ?> ,
                 <?php echo $singleProjectdata['billings_july']; ?> ,
                 <?php echo $singleProjectdata['billings_aug']; ?> ,
                 <?php echo $singleProjectdata['billings_sep']; ?> ,
                 <?php echo $singleProjectdata['billings_oct']; ?> ,
                 <?php echo $singleProjectdata['billings_nov']; ?> ,
                  <?php  echo $singleProjectdata['billings_dec']; 
                  } ?>
        ],
       
        backgroundColor: 'transparent',
        borderColor: '#ff0000',
        pointBorderColor: '#ff0000',
        pointBackgroundColor: '##ff0000',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
		label: 'WIP',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                  <?php  echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
        backgroundColor: 'transparent',
        borderColor: '#33cc33',
        pointBorderColor: '#33cc33',
        pointBackgroundColor: '#33cc33',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      },
        {
        type: 'line',
		label: 'DEBTORS',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['debtors_jan']; ?>,
                 <?php echo $totalProjectdata['debtors_feb']; ?>, 
                 <?php echo $totalProjectdata['debtors_mar']; ?>,
                 <?php echo $totalProjectdata['debtors_apr']; ?> ,
                 <?php echo $totalProjectdata['debtors_may']; ?> ,
                 <?php echo $totalProjectdata['debtors_june']; ?> ,
                 <?php echo $totalProjectdata['debtors_july']; ?> ,
                 <?php echo $totalProjectdata['debtors_aug']; ?> ,
                 <?php echo $totalProjectdata['debtors_sep']; ?> ,
                 <?php echo $totalProjectdata['debtors_oct']; ?> ,
                 <?php echo $totalProjectdata['debtors_nov']; ?> ,
                
                 <?php echo $totalProjectdata['debtors_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['debtors_jan']; ?>,
                 <?php echo $singleProjectdata['debtors_feb']; ?>, 
                 <?php echo $singleProjectdata['debtors_mar']; ?>,
                 <?php echo $singleProjectdata['debtors_apr']; ?> ,
                 <?php echo $singleProjectdata['debtors_may']; ?> ,
                 <?php echo $singleProjectdata['debtors_june']; ?> ,
                 <?php echo $singleProjectdata['debtors_july']; ?> ,
                 <?php echo $singleProjectdata['debtors_aug']; ?> ,
                 <?php echo $singleProjectdata['debtors_sep']; ?> ,
                 <?php echo $singleProjectdata['debtors_oct']; ?> ,
                 <?php echo $singleProjectdata['debtors_nov']; ?> ,
                  <?php  echo $singleProjectdata['debtors_dec']; 
                  } ?>
        ],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
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
        display: true
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

///////////////////////////////////////////////////////////




  
  var $visitorsChart = $('#trangdfgdgdfds')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Janury', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [{
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                  <?php  echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
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
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                 <?php echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
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
