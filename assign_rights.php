<?php 
 session_start();
 require 'db.php'; 
 include("check_rights.php");
 if(!isset($_SESSION['uid']) || $_SESSION['user_type']!=1)
{
header("Location:index.php");	
}
include("saveurl.php");
 $uidd=$_REQUEST['id'];
  $level=$_REQUEST['lid'];
 //$user_type=3;
 
 
 if($_SERVER['REQUEST_METHOD'] == "POST"){
 $uidd=$_POST['uidd'];
$user_type=3;


	 $division=$_POST['division'];
	 
	  if(empty($division))
	 {
	$div_con=0;
	 }
	 else
	 {
	 $div_con=count($division);
	 }
	 $count_arraya 		= $_POST['count_arraya'];
	
	 if(empty($count_arraya))
	 {
	$count_con=0;
	 }
	 else
	 {
	echo $count_con=count($count_arraya);
	 }
	$country_arr 		= $_POST['country_arr'];
	
	 if(empty($country_arr))
	 {
	$country_con=0;
	 }
	 else
	 {
	$country_con=count($country_arr);
	 }
	 
	
$project_arr 		= $_POST['project_arr'];
 if(empty($project_arr))
	 {
		 $project_con=0;
	 }else
	 {
		$project_con=count($project_arr);
	 }
		
		if($div_con==0)
		{
			$sdelete1= "Delete from rs_tbl_user_rights where user_cd=$uidd";
	   mysqli_query($con,$sdelete1);
	   
		}
		if($div_con!=0 && $count_con==0 && $country_con==0 && $project_con==0)
		{
		
		$sdelete1= "Delete from rs_tbl_user_rights where user_cd=$uidd";
	   mysqli_query($con,$sdelete1);
	   
	
			for($i=0;$i<$div_con;$i++)
			{
			$div_cd=$division[$i];
	$sql_pstt="insert into rs_tbl_user_rights(user_cd,div_cd,region_cd,count_cd,project_cd,user_type)
	VALUES ($uidd,$div_cd,NULL,NULL,NULL,$user_type)";
	
	mysqli_query($con,$sql_pstt);	
			}
		}
		
		if(($div_con!=0 && $count_con!=0) && $country_con==0 && $project_con==0)
		{
		
		$sdelete1= "Delete from rs_tbl_user_rights where user_cd=$uidd";
	   mysqli_query($con,$sdelete1);

		for($i=0;$i<$count_con;$i++)
		{
		$arr1= $count_arraya[$i];
		$arr2=explode("_",$arr1);
		$div=$arr2[0];		
		$reg=$arr2[1];
		$sql_pstt="insert into rs_tbl_user_rights(user_cd,div_cd,region_cd,count_cd,project_cd,user_type)
VALUES ($uidd,$div,$reg,NULL,NULL,$user_type)";
$res_pstt=mysqli_query($con,$sql_pstt);	
		}
		}
		
		if($div_con!=0 && $count_con!=0 && $country_con!=0 && $project_con==0)
		{
		
		 $sdelete1= "Delete from rs_tbl_user_rights where user_cd=$uidd";
	   mysqli_query($con,$sdelete1);
		for($i=0;$i<$country_con;$i++)
		{
		$arr1= $country_arr[$i];
		$arr2=explode("_",$arr1);
		
		$div=$arr2[0];		
		$reg=$arr2[1];
		$cont=$arr2[2];
		$sql_pstt="insert into rs_tbl_user_rights(user_cd,div_cd,region_cd,count_cd,project_cd,user_type)
VALUES ($uidd,$div,$reg,$cont,NULL,$user_type)";
$res_pstt=mysqli_query($con,$sql_pstt);	
		}
		}
		if($div_con!=0 && $count_con!=0 && $country_con!=0 && $project_con!=0)
		{
		
		 $sdelete1= "Delete from rs_tbl_user_rights where user_cd=$uidd";
	   mysqli_query($con,$sdelete1);
		for($i=0;$i<$project_con;$i++)
		{
		$arr1p= $project_arr[$i];
		$arr2p=explode("_",$arr1p);
		
		$div=$arr2p[0];		
		$reg=$arr2p[1];
		$cont=$arr2p[2];
		$proj=$arr2p[3];
		$sql_psttp="insert into rs_tbl_user_rights(user_cd,div_cd,region_cd,count_cd,project_cd,user_type)
VALUES ($uidd,$div,$reg,$cont,$proj,$user_type)";
$res_psttp=mysqli_query($con,$sql_psttp);	
		}
		}
		
 
 }
 ?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Saca_Dashboard<?php echo $_SERVER['DOCUMENT_ROOT'];
 ?></title>  
  
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="theme/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="theme/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="theme/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="theme/dist/css/adminlte.min.css">
  
  <script>

		 function getDivision()
		 {
			 
	
		 var valuee=document.getElementById('level').value;
		
		 var chk4=document.getElementById('level').checked;
		
	
		 if(chk4==true)
		 {
		 document.getElementById('assign_comp_coun2').style.display='block';
		 document.getElementById('assign_comp_coun4').style.display='none';
	
		 }
		 else
		 {
		 document.getElementById('assign_comp_coun2').style.display='none';
		 }
		 }
		 function getRegion()
		 {
			
		 var chk3=document.getElementById('level').checked;
	
		 if(chk3==true)
		 {
		 document.getElementById('assign_comp_coun4').style.display='block';
		  document.getElementById('assign_comp_coun2').style.display='none';
	
		 }
		 else
		 {
			
		 document.getElementById('assign_comp_coun4').style.display='none';
		 }
		 } 
		 
		 
		 function getCountry()
		 {
			
		 var chk3=document.getElementById('level').checked;
	
		 if(chk3==true)
		 {
		 document.getElementById('assign_comp_coun3').style.display='block';
		  document.getElementById('assign_comp_coun4').style.display='none';
	
		 }
		 else
		 {
			 
		 document.getElementById('assign_comp_coun3').style.display='none';
		 }
		 } 
		 
		 function getProject()
		 {
			
		 var chk5=document.getElementById('level').checked;
	
		 if(chk5==true)
		 {
		 document.getElementById('assign_comp_coun5').style.display='block';
		  document.getElementById('assign_comp_coun4').style.display='none';
	
		 }
		 else
		 {
			 alert("else");
		 document.getElementById('assign_comp_coun5').style.display='none';
		 }
		 } 
		 
		
		 
	</script>	 
    
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
	
function getcommid(divid) {

		var role_chk1=document.getElementById('cmid_'+divid).checked;
		
				if(role_chk1==true)
				{			
						var strURL="findcom_con.php?div_id="+divid;
			
						var req1 = getXMLHTTP();
						
						if (req1) {
							//alert("if");
							
							req1.onreadystatechange = function() {
								if (req1.readyState == 4) {
									// only if "OK"
									if (req1.status == 200) {	
									   document.getElementById('company_'+divid).innerHTML=req1.responseText;
															
									} else {
										alert("There was a problem while using XMLHTTP:7\n" + req1.statusText);
									}
								}				
							}			
							req1.open("GET", strURL, true);
							req1.send(null);
						}
				}
				else
				{
				var strURL1="findcom1_con.php?comm_id="+cmid;
		
			var req = getXMLHTTP();
				
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
						     document.getElementById('company_'+cmid).innerHTML='';
						    document.getElementById('projects_'+cmid).innerHTML=req.responseText;
						   						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL1, true);
				req.send(null);
			}
				}
			
			
		}
		
		
		function getcommid_p(divid) {

		var role_chk5=document.getElementById('cmid_'+divid).checked;
			
				if(role_chk5==true)
				{			
						var strURL="findcom_conp.php?div_id="+divid;
				
						var req1 = getXMLHTTP();
						
						if (req1) {
							//alert("if");
							
							req1.onreadystatechange = function() {
								if (req1.readyState == 4) {
									// only if "OK"
									if (req1.status == 200) {	
									   document.getElementById('company_'+divid).innerHTML=req1.responseText;
															
									} else {
										alert("There was a problem while using XMLHTTP:7\n" + req1.statusText);
									}
								}				
							}			
							req1.open("GET", strURL, true);
							req1.send(null);
						}
				}
				else
				{
				var strURL1="findcom1_con.php?div_id="+divid;
		
			var req = getXMLHTTP();
				
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {	
						     document.getElementById('company_'+divid).innerHTML='';
						    document.getElementById('projects_'+divid).innerHTML=req.responseText;
						   						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				req.open("GET", strURL1, true);
				req.send(null);
			}
				}
			
			
		}
		function getRegionResult(did) {

		var role_chk4=document.getElementById('cmida_'+did).checked;
		
			var strURL="findcom_cona.php?div_id="+did;
			var strURL4="findcom1_con.php";
			//var strURL1="findcom1_con_proj.php";
			var req= getXMLHTTP();
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
												
							document.getElementById('companya_'+did).innerHTML=req.responseText;
												
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}
					
				req.open("GET", strURL, true);
				req.send(null);
				
			}
			
			
		}	
		function getccpid(div_id,region_id) {
	
			
			//alert(strURL);
			var role_chk2=document.getElementById('cmid_'+div_id+'_'+region_id).checked;
			var strURL="findcom_con_proj.php?div_id="+div_id+"&region_id="+region_id;
			
			var strURL1="findcom1_con_proj.php";
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {		
						
							document.getElementById('company_'+div_id+'_country_'+region_id).innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				if(role_chk2==true)
		      {			
				req.open("GET", strURL, true);
				req.send(null);
				}
				else
				{
				
				
				req.open("GET", strURL1, true);
				req.send(null);
				}
			}
			
			 
		
	}
	
	function getccpid_p(div_id,region_id) {
	
			
		
			var role_chk2=document.getElementById('cmid_'+div_id+'_'+region_id).checked;
			var strURL="findcom_con_p.php?div_id="+div_id+"&region_id="+region_id;
			
			var strURL1="findcom1_con_proj.php";
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {		
						
							document.getElementById('company_'+div_id+'_country_'+region_id).innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				if(role_chk2==true)
		      {			
				req.open("GET", strURL, true);
				req.send(null);
				}
				else
				{
				
				
				req.open("GET", strURL1, true);
				req.send(null);
				}
			}
			
			 
		
	}
	
	
	function getproject_p(div_id,region_id,country_id) {
	
			
			
			var role_chk2=document.getElementById('cmid_'+div_id+'_'+region_id+'_'+country_id).checked;
			var strURL="findcom_con_proj_p.php?div_id="+div_id+"&region_id="+region_id+"&country_id="+country_id;
			
			var strURL1="findcom1_con_proj_p.php";
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {		
						
							document.getElementById('company_'+div_id+'_country_'+region_id+'_cc_'+country_id).innerHTML=req.responseText;						
						} else {
							alert("There was a problem while using XMLHTTP:7\n" + req.statusText);
						}
					}				
				}			
				if(role_chk2==true)
		      {			
				req.open("GET", strURL, true);
				req.send(null);
				}
				else
				{
				
				
				req.open("GET", strURL1, true);
				req.send(null);
				}
			}
			
			 
		
	}
	function getprojid(comm_id,coun_id,pid,value) {
	
			
		var role_chk=document.getElementById(comm_id+"_"+coun_id+"_"+pid).checked;
		if(role_chk==true)
		{
		
		document.getElementById('company_'+comm_id+'_country_'+coun_id+'_proj_'+pid).style.display='block';
			
		}
		else
		{
		
	document.getElementById('roles[]').selectedIndex=-1;
		
		document.getElementById('company_'+comm_id+'_country_'+coun_id+'_proj_'+pid).style.display='none';
		
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
            <h1>User Rights Management</h1>
           
                      <!-- select -->
                      
                   
          </div>
          
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Manage Users Rights</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

        <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Manage User Rights</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              
               <?php  $pmisUpdataDataQuery  = "select * from direct_users where uid=".$uidd;
                      $pmisUpdataDataResult = mysqli_query($con,$pmisUpdataDataQuery);
                      $pmisUpdataDataCount  = mysqli_num_rows($pmisUpdataDataResult);
					 $pmisres=mysqli_fetch_assoc($pmisUpdataDataResult);
					 
					 
					
					
				  	
					   ?>
              <form class="form-horizontal" method="post">
                <div class="card-body">
                <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" >Name</label>
                    <div class="col-sm-10">
                      <input type="name" class="form-control" id="name" placeholder="Name" readonly value=" <?php  echo  $pmisres['login_name'];?>">
                      <input type="hidden" class="form-control" id="uidd"  name="uidd" readonly value=" <?php  echo  $uidd;?>">
                      <input type="hidden" class="form-control" id="user_type" name="user_type" readonly value=" <?php  echo  $user_type;?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputEmail3" class="col-sm-2 col-form-label" >Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail3" placeholder="Email" readonly value=" <?php  echo  $pmisres['email'];?>">
                    </div>
                  </div>
                 
                  <?php /*?><div class="form-group row">
                   <label for="inputEmail3" class="col-sm-2 col-form-label" >Select Level</label>
                    <div class=" col-sm-10">
                    <?php if($level==1){
						
						$pmis1 = "select * from rs_tbl_user_rights where user_cd=".$uid;
                      $pmisR = mysqli_query($con,$pmis1);
                     echo  $pmisCount  = mysqli_num_rows($pmisR);
					 if($pmisCount>=1)
					 {
						 $checked='checked="checked"';
					 }
					 else
					 {
						 $checked="";
					 }
						?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"  id="level" name="level" value="1" <?php echo $checked?>  onclick="getDivision()">
                        <label class="form-check-label" for="level">Division Level</label>
                      </div>
                      
                      <?php
					}
					?>
                     <?php if($level==2){
						
						$pmis12 = "select * from rs_tbl_user_rights where user_cd=".$uid;
                      $pmisR2 = mysqli_query($con,$pmis12);
                     echo  $pmisCount2  = mysqli_num_rows($pmisR2);
					 if($pmisCount2>=1)
					 {
						 $checked='checked="checked"';
					 }
					 else
					 {
						 $checked="";
					 }
						?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"   id="level" name="level" value="2"  <?php echo $checked?> onclick="getRegion()" >
                        <label class="form-check-label" for="level">Region Level</label>
                      </div>
                      <?php
					 }
					 ?>
                     <?php if($level==3){
						
						$pmis13 = "select * from rs_tbl_user_rights where user_cd=".$uid;
                      $pmisR3 = mysqli_query($con,$pmis13);
                     echo  $pmisCount3  = mysqli_num_rows($pmisR3);
					 if($pmisCount3>=1)
					 {
						 $checked='checked="checked"';
					 }
					 else
					 {
						 $checked="";
					 }
						?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"   id="level" name="level" value="3"  <?php echo $checked?> onclick="getCountry()" >
                        <label class="form-check-label" for="level">Country Level</label>
                      </div>
                      <?php
					 }
					 ?>
                     <?php if($level==4){
						
						$pmis14 = "select * from rs_tbl_user_rights where user_cd=".$uid;
                      $pmisR4 = mysqli_query($con,$pmis14);
                     echo  $pmisCount5  = mysqli_num_rows($pmisR4);
					 if($pmisCount5>=1)
					 {
						 $checked='checked="checked"';
					 }
					 else
					 {
						 $checked="";
					 }
						?>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input"   id="level" name="level" value="4"  <?php echo $checked?> onclick="getProject()" >
                        <label class="form-check-label" for="level">Project Level</label>
                      </div>
                      <?php
					 }
					 ?>
                  <!--<div class="form-check">
                        <input type="checkbox" class="form-check-input"   id="level" name="level" value="2" onclick="getRegion()">
                        <label class="form-check-label" for="level">Region Level</label>
                      </div>-->
                      <!--<div class="form-check">
                        <input type="checkbox" class="form-check-input"  id="level" name="level" value="1"   <?php echo ($pmisCount>=1) ? 'checked="checked"' : "";?> onclick="getDivision()">
                        <label class="form-check-label" for="level">Division Level</label>
                      </div>-->
                    
                      
                     
                   <!-- <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="level">
                        <label class="form-check-label" for="level">Country Level</label>
                      </div>
                    
                      <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="level">
                        <label class="form-check-label" for="level">Project Level</label>
                      </div>-->
                      
                    </div>
                  </div><?php */?>
                  
                   
            
            
            
            
            <!-- <div class="form-group row" id="assign_comp_coun5" <?php if($pmisCount5>=1){?>style="display:block"<?php }else{?> style="display:none"<?php } ?>>-->
              <div class="form-group row">
						<?php
				
		
			$Sql = "SELECT * FROM ds001division";
			$res=mysqli_query($con,$Sql);
	
?>	
		<table width="100%" border="1px solid black" cellspacing="0px" bgcolor="#FFF">
			<tr height="30px" bgcolor="#DADADA"><td width="15%" style="font-weight:bold">Division</td><td width="10%"  style="font-weight:bold">Region</td><td width="10%"  style="font-weight:bold">Country</td><td width="65%"  style="font-weight:bold">Project</td></tr>   <!--//// END tbl header-->
<?PHP
			while($result=mysqli_fetch_assoc($res))
			{
			$divid=$result["did"];
			
			?>
			<tr>
			
			<td >
			<?php 
			$Sqlcc1= "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd='$divid' group by div_cd";
			$rescc1=mysqli_query($con,$Sqlcc1);
						if(mysqli_num_rows($rescc1)>0)
						{
						$checked9="1";
						}
						else
						{
						$checked9="0";
						} 
		
			
			?>
<!--			<input type="checkbox" name="cmid_<?php echo $divid?>" id="cmid_<?php echo $divid?>" value="<?php echo $divid; ?>"  onclick="getcommid_p(<?php echo $divid; ?>)" <?php if($checked9=="1"){?>checked<?php }?>/>
-->   
<input type="checkbox" name="division[]" id="cmid_<?php echo $divid?>" value="<?php echo $divid; ?>"  onclick="getcommid_p(<?php echo $divid; ?>)" <?php if($checked9=="1"){?>checked<?php }?>/>    
            
             <?=$result["dname"]; ?><?php 
			
			?></td>
			<td >
			<div id="company_<?php echo $divid; ?>">
			<!--/*for edit*/-->
			<?php
			if($user_type==3)
			{
			
	 $Sqlcc6= "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd='$divid' group by div_cd";
			$rescc6=mysqli_query($con,$Sqlcc6);
			while($res6=mysqli_fetch_assoc($rescc6))
			{
			$div_id=$res6['div_cd'];
			
			
			$sql_lis3="SELECT *
FROM
    saca_project_master
    INNER JOIN ds002region 
        ON (saca_project_master.region = ds002region.rid) where division='$div_id' group by region";
 $res_lis3=mysqli_query($con,$sql_lis3);

			
	
?>
<table width="100%">
<?php

?>


<?php
while($res2=mysqli_fetch_assoc($res_lis3))
{

		$cidd=$res2['region'];
			
			
			
		$Sqlcc = "SELECT *
FROM
    rs_tbl_user_rights
    INNER JOIN ds002region 
        ON (rs_tbl_user_rights.region_cd = ds002region.rid) where div_cd='$div_id' and user_cd='$uidd' and user_type='3' and region_cd='$cidd' group by region_cd";
		$rescc=mysqli_query($con,$Sqlcc);
			$resultcc=mysqli_fetch_assoc($rescc);
				if(mysqli_num_rows($rescc)>0)
						{

						
						 $checked1="1";
						}
						else
						{
						$checked1="0";
						} 
						
		
			?>
			<tr><td >
<!--			<input type="checkbox" name="cmid_<?php echo $div_id?>_<?php echo $cidd; ?>"  id="cmid_<?php echo $div_id?>_<?php echo $cidd; ?>" value="<?php echo  $cidd;?>" onchange="getccpid_p(<?php echo $div_id?>,<?php echo $cidd; ?>)" <?php if($checked1=="1"){?>checked<?php }?>/> <?=$res2['rname']; ?></td></tr>
-->
<input type="checkbox" name="count_arraya[]"  id="cmid_<?php echo $div_id?>_<?php echo $cidd; ?>" value="<?php echo $div_id?>_<?php echo $cidd; ?>" onchange="getccpid_p(<?php echo $div_id?>,<?php echo $cidd; ?>)" <?php if($checked1=="1"){?>checked<?php }?>/> <?=$res2['rname']; ?></td></tr>

			<?php
			}
			?>


</table>
<?php			
}			
}
?>
			
			
			</div></td>
			
			<td >
			<div  id="projects_<?php echo $divid; ?>">
			<table border="0" width="100%">
			<?php 
			$sql_lis3="select region from saca_project_master where division=$divid group by region";
                    $res_lis3=mysqli_query($con,$sql_lis3);
			
			while($resultc=mysqli_fetch_assoc($res_lis3))
			{
			$rid=$resultc['region'];
			?>
			<tr>
            <td>
			
			<div id="company_<?php echo $divid; ?>_country_<?php echo $rid; ?>">
			<?php
		if($user_type==3)
			{
			
			$sql_lis31="select distinct country,region,division from saca_project_master where division=$divid and region=$rid";
				 $res_lis31=mysqli_query($con,$sql_lis31);
			
			
			
			?>
			
			
			
			
			<table width="100%">
<?php
while($res21=mysqli_fetch_assoc($res_lis31))

			{
$div_id=$res21['division'];
			$region_id=$res21['region'];
			$countryid=$res21['country'];
				$Sqlcte = "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd=$div_id and region_cd=$region_id";
			$rescte=mysqli_query($con,$Sqlcte);
			if(mysqli_num_rows($rescte)>0)
			{
				$Sqlct = "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd=$div_id and region_cd=$region_id and count_cd=$countryid ";
			$resct=mysqli_query($con,$Sqlct);
					$resultct=mysqli_fetch_assoc($resct);
					if(mysqli_num_rows($resct)>0)
						{
						
						$checkedp1="1";
						}
						else
						{
						$checkedp1="0";
						} 
						
						
						$Sqlc = "SELECT * FROM ds003country where cid=$countryid";
			$resc=mysqli_query($con,$Sqlc);
			$resultc=mysqli_fetch_assoc($resc);
			$cid=$resultc['cid'];

?>
<tr>
<td width="70%" >


<?php /*?><input type="checkbox" id="<?php echo $comm_id; ?>_<?php echo $coun_id; ?>_<?php echo $pid; ?>"  onchange="getprojid(<?php echo $comm_id; ?>,<?php echo $coun_id; ?>,<?php echo $pid; ?>,this.value);" <?php if($checkedp1=="1"){?>checked<?php }?>/><?php */?>
<!--<input type="checkbox"  name="cmid_<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>"  id="cmid_<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>" value="<?php echo $countryid; ?>"  onchange="getproject_p(<?php echo $div_id?>,<?php echo $region_id; ?>_<?php echo $countryid; ?>)" <?php if($checkedp1=="1"){?>checked<?php }?>/> 
--><input type="checkbox"  name="country_arr[]"  id="cmid_<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>" value="<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>"  onchange="getproject_p(<?php echo $div_id?>,<?php echo $region_id; ?>,<?php echo $countryid; ?>)" <?php if($checkedp1=="1"){?>checked<?php }?>/> 


<?php			
			
			
			
			echo $resultc['cname'];
			?> 
			
			
			
			
			</td>
			</tr>
<?php
}			
}			
//}
?>
</table>




<?php			
			
			
			}

?>
			
			
			</div>
			
			</td>
            
			
			</tr>
			
			<?php
			
			}
			?>
			</table>
			</div>
			
			</td>
            
            
            
            
            <td >
            <table border="0" width="100%">
			<?php 
			
			$sql_lis3="select region from saca_project_master where division=$divid group by region";
                    $res_lis3=mysqli_query($con,$sql_lis3);
			
			while($resultc=mysqli_fetch_assoc($res_lis3))
			{
			$rid=$resultc['region'];
			 $sql_lis35="select country from saca_project_master where division=$divid and region=$rid group by country";
                    $res_lis35=mysqli_query($con,$sql_lis35);
			
			while($resultc5=mysqli_fetch_assoc($res_lis35))
			{
			$conid=$resultc5['country'];
			?>
			<tr>
            <td>
			
			<div id="company_<?php echo $divid; ?>_country_<?php echo $rid; ?>_cc_<?php echo $conid; ?>">
			<?php
		
			if($user_type==3)
			{
			$sql_lis31="select master_code,region,division, country, project_desc from saca_project_master where division=$divid and region=$rid and country=$conid";
				 $res_lis31=mysqli_query($con,$sql_lis31);
			
			
			
			?>
			
			
			
			
			<table width="100%">
<?php
while($res21=mysqli_fetch_assoc($res_lis31))

			{
$div_id=$res21['division'];
			$region_id=$res21['region'];
			$countryid=$res21['country'];
			$master_code=$res21['master_code'];
				$Sqlcte = "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd=$div_id and region_cd=$region_id and count_cd=$countryid";
			$rescte=mysqli_query($con,$Sqlcte);
			if(mysqli_num_rows($rescte)>0)
			{
			$Sqlct = "SELECT * FROM rs_tbl_user_rights where user_cd='$uidd' and user_type='$user_type' and div_cd=$div_id and region_cd=$region_id and count_cd=$countryid and project_cd=$master_code";
			$resct=mysqli_query($con,$Sqlct);
					$resultct=mysqli_fetch_assoc($resct);
					if(mysqli_num_rows($resct)>0)
						{
						
						$checkedp1="1";
						}
						else
						{
						$checkedp1="0";
						} 
						
						
						

?>
<tr>
<td width="70%" >


<input type="checkbox"  name="project_arr[]"  id="project_arr[]" value="<?php echo $div_id; ?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>_<?php echo $master_code;?>"  <?php if($checkedp1=="1"){?>checked<?php }?>/> <?php			
			
			
			
			echo $res21['project_desc'];
			?> 
			
			
			
			
			</td>
			</tr>
<?php
}			
}			

?>
</table>
<?php
			}
			?>

			
			
			</div>
			
			</td>
            </tr>
		
			<?php
			}
			}
			?>
			</table>
            </td>
            </tr>
            </table>
			</div>     
                  
   <?php
   }
   ?>               
                  
                  
                  
                  
                  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                
                  <input type="submit" class="btn btn-info" name="save" value="Save"/>
                  
               
                  
                    <input type="button" class="btn btn-default float-right" value="Cancel" onClick="document.location='manage_user.php';" />
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
            </div>
            
            <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <?php include("partials/footer.php")?>
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
