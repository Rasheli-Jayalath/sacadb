<?php 
ob_start();
session_start();
require 'db.php'; 
include("check_rights.php");
if(!isset($_SESSION['uid']))
{
header("Location:index.php");	
}
if($pmis==0)
{
header("Location:index.php");	
}
if(isset($_GET['m']))
{
	$month=$_GET['m'];
}
else
{
	$month=1;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>SACA DASHBOARD - PMIS</title>
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
				detailpmis('all','pt',smonth);
			}
			
	}
	function detailpmis(country,status,smonth) {

	$("#pmisdiv").html("");
		
			var strURL="sel_month_detail.php?c="+country+"&s="+status+"&smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("pmisdiv").innerHTML=req.responseText;
						dattable1();
							
												
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
				detaildms('all','dt',smonth);
			}
	}
	
	function detaildms(country,status,smonth) {

	$("#pmisdiv").html("");
		
			var strURL="sel_monthd_detail.php?c="+country+"&s="+status+"&smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("pmisdiv").innerHTML=req.responseText;
						dattable1();
							
												
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
				detailgis('all','gt',smonth);
			}
	}
	
	function detailgis(country,status,smonth) {

	$("#pmisdiv").html("");
		
			var strURL="sel_monthg_detail.php?c="+country+"&s="+status+"&smonth="+smonth;
			var req= getXMLHTTP();
			
			if (req) {
				//alert("if");
				
				req.onreadystatechange = function() {
					if (req.readyState == 4) {
						// only if "OK"
						if (req.status == 200) {
														
							document.getElementById("pmisdiv").innerHTML=req.responseText;
						dattable1();
							
												
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
  #main-body {
  font-family: Arial;
  width: inherit;
}
label{
  font-size:1em;
}
option{
  font-size:2vh;
}
#th{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#79a9ce;
color:white;}
#th-abcd{
  vertical-align:top;
  font-size:1em;
  text-align:center;
  background-color:#1d3a67;
color:white;}
td{
  font-size:2vh;
  text-align: center;
  max-width:15vh;
}
#card_update{
  margin: .75em 1.25em;
 
 }
#card_body{
  overflow-x:scroll; 
  overflow-y: scroll; 
}
 .badge{
	 padding:.75em 1.2em;
   width:6vh;
 }

 #report_section{
  padding: 0.75em 1.2em;
 }
 #card_header{
  font-weight:500;
  background-color:#79a9ce;
  font-size:1em;
  color:white;
 }
 #card_header-abcd{
  font-weight:500;
  background-color:#1d3a67;
  font-size:1em;
  color:white;
 }
 #title_div{
  margin-top:5vh;
  
 }
 #abc{
  overflow-y:auto;
  font-size:1em;

 }
 #abcd{
  overflow-y:auto;
  font-size:1em;
 }
 #abcg{
  overflow-y:auto;
  font-size:1em;
 }
 #report_section_single{}
.card-body{
  overflow-y:auto;
  font-size:2vh;
}
#td-title{
 text-align:left;
 font-size:1em;
}
#td-title-total{
 font-weight:bold;
 text-align:left;
 font-size:1em;
}
#td-data{
 font-size:1em;
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
  <div class="content-wrapper" id="main-body">
  
  
  
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
          <div class="col-sm-12" id="title_div">
          <h1 style="text-align:center;font-size:1.5em;" >SOUTH ASIA CENTRAL ASIA</h1>
            <h4 style="text-align:center; margin-top: 10px;font-size:1.2em;">ALL PMIS REPORTS </h4>
          </div>
      </div><!-- /.container-fluid -->
    </section>
<div class="row" id="report_section">
   <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header" id="card_header">
                <h3 class="card-title" id="card_header">PMIS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonth(this.value)"  style="display:inline; width:100px;">
                         <option value="1" <?php if($month=="1") echo "selected"?>>1</option>
                          <option value="2" <?php if($month=="2") echo "selected"?>>2</option>
                          <option value="3" <?php if($month=="3") echo "selected"?>>3</option>
                          <option value="4" <?php if($month=="4") echo "selected"?>>4</option>
                          <option value="5" <?php if($month=="5") echo "selected"?>>5</option>
                          <option value="6" <?php if($month=="6") echo "selected"?>>6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                      <table class="table table-bordered" id="abc">
                  <thead id="th">
                    <tr>
                      
                      <th id="th">Country</th>
                      <th id="th">Total PMIS</th>
                      <th id="th">Updated</br> <small>(1 Months)</small></th>
                      <th id="th">Not Updated</br> <small>(1 Months)</small></th>
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
					   
					   $pmissum = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where country_name='$country'  group by project_id";
                        $pmissumres = mysqli_query($con,$pmissum);
                  		 $pmissumCount  = mysqli_num_rows($pmissumres);
					   if($u<=$countryCount)
					   {
						   $pmis_total=$pmissumCount+$pmis_total;
					   }
					   
					   
					   $pmissum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval 1 month and country_name='$country'  group by project_id";
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
                     
                      <td id="td-title"><?php echo ucfirst(strtolower($country));?></td>
                      <td id="td-data">
                      <a onclick="detailpmis('<?php echo $country;?>','pt','1')"> <?php echo $pmissumCount;?></a>
                        <!--<a href="pmis.php?c=<?php echo $country;?>&s=pt"><?php echo $pmissumCount;?></a>-->
                      
                      </td>
                      <td id="td-data"><span > <a onclick="detailpmis('<?php echo $country;?>','pu','1')"><?php  echo $pmissumCount1;?></a></span></td>
                       <td id="td-data"><span > <a onclick="detailpmis('<?php echo $country;?>','pnu','1')"><?php echo $notupdated;?></a></span></td>
                    </tr>
                    <?php
					$u++;
				   }
				   ?>
                   <tr>
                     
                      <td id="td-title-total"><?php echo "Total";?></td>
                      <td id="td-data">
                       
                        <a onclick="detailpmis('all','pt','1')"><?php echo $pmis_total;?></a>
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detailpmis('all','pu','1')"><?php  echo $pmis_total_updated;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detailpmis('all','pnu','1')"><?php echo $pmis_total_nupdated;?></a></span></td>
                    </tr>
                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
          <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header"id="card_header-abcd">
                <h3 class="card-title"id="card_header-abcd">DMS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonthd(this.value)"  style="display:inline; width:100px;">
                         <option value="1" <?php if($month=="1") echo "selected"?>>1</option>
                          <option value="2" <?php if($month=="2") echo "selected"?>>2</option>
                          <option value="3" <?php if($month=="3") echo "selected"?>>3</option>
                          <option value="4" <?php if($month=="4") echo "selected"?>>4</option>
                          <option value="5" <?php if($month=="5") echo "selected"?>>5</option>
                          <option value="6" <?php if($month=="6") echo "selected"?>>6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                <table class="table table-bordered" id="abcd">
                  <thead id="th">
                    <tr>
                      
                      <th id="th-abcd" >Country</th>
                      <th id="th-abcd" >Total DMS</th>
                      <th id="th-abcd" >Updated</br> <small>(1 Months)</small></th>
                      <th id="th-abcd" >Not Updated</br> <small>(1 Months)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  
				  $dmscon = "select distinct country_name as country_name from dms_update_data order by country_name asc";
				   $dmsconres = mysqli_query($con,$dmscon);
				   $countryCountd  = mysqli_num_rows($dmsconres);
				   $v=1;
				   $dms_total=0;
				   $dms_total_updated=0;
				   $dms_total_nupdated=0;
				   while($dmsres=mysqli_fetch_assoc($dmsconres))
				   {
					   
					   $country=$dmsres['country_name'];
					   
					  $dmssum = "select project_id,country_name from dms_update_data where country_name='$country' and item_name='DMS' group by project_id";
                        $dmssumres = mysqli_query($con,$dmssum);
                  		 $dmssumCount  = mysqli_num_rows($dmssumres);
					   if($v<=$countryCountd)
					   {
						   $dms_total=$dmssumCount+$dms_total;
					   }
					   
					   
					  $dmssum1 = "select project_id,country_name,max(item_value1) as max_date from dms_update_data where item_value1>= now()-interval 1 month and country_name='$country' and item_name='DMS' group by project_id";
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
                     
                      <td id="td-title"><?php if($country=='CAR') 
					  {
						   echo $country; 
						   }
						    else
							 {
								 echo  ucfirst(strtolower($country)); 
								  }?></td>
                      <td id="td-data">
                       
                        <a onclick="detaildms('<?php echo $country;?>','dt','1')"><?php echo $dmssumCount;?></a>
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detaildms('<?php echo $country;?>','du','1')"><?php  echo $dmssumCount1;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detaildms('<?php echo $country;?>','dnu','1')"><?php echo $notupdated;?></a></span></td>
                    </tr>
                    <?php
					$v++;
				   }
				   ?>
                   <tr>
                     
                      <td id="td-title-total"> <?php echo "Total";?></td>
                      <td id="td-data">
                       
                       <a onclick="detaildms('all','dt','1')"><?php echo $dms_total;?></a>
                      
                      </td >
                      <td id="td-data"><span ><a onclick="detaildms('all','du','1')"><?php  echo $dms_total_updated;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detaildms('all','dnu','1')"><?php echo $dms_total_nupdated;?></a></span></td>
                    </tr>

                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
          <div class="col-md-4" id="report_section_single">
            <div class="card">
              <div class="card-header"id="card_header">
                <h3 class="card-title"id="card_header">GIS Report</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="form-group" >
                        <label>Updated from Last</label>
                     <select   name="smonth" id="smonth" class="form-control" onchange="selectMonthg(this.value)"  style="display:inline; width:100px;">
                          <option value="1" <?php if($month=="1") echo "selected"?>>1</option>
                          <option value="2" <?php if($month=="2") echo "selected"?>>2</option>
                          <option value="3" <?php if($month=="3") echo "selected"?>>3</option>
                          <option value="4" <?php if($month=="4") echo "selected"?>>4</option>
                          <option value="5" <?php if($month=="5") echo "selected"?>>5</option>
                          <option value="6" <?php if($month=="6") echo "selected"?>>6</option>
                        </select>
                        <label>Month(s)</label>
                      </div>
                <table class="table table-bordered" id="abcg">
                  <thead id="th">
                    <tr>
                      
                      <th id="th" >Country</th>
                      <th id="th" >Total GIS</th>
                      <th id="th"= >Updated</br> <small>(1 Months)</small></th=>
                      <th id="th" >Not Updated </br><small>(1 Months)</small></th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php 
				  
				  $giscon = "select distinct country_name as country_name from gis_update_data order by country_name asc";
				   $gisconres = mysqli_query($con,$giscon);
				   $countryCountd  = mysqli_num_rows($gisconres);
				   $w=1;
				   $gis_total=0;
				   $gis_total_updated=0;
				   $gis_total_nupdated=0;
				   while($gisres=mysqli_fetch_assoc($gisconres))
				   {
					   
					   $country=$gisres['country_name'];
					   
					 $gissum = "select project_id,country_name from gis_update_data where country_name='$country' and item_name='GIS' group by project_id";
                        $gissumres = mysqli_query($con,$gissum);
                  		 $gissumCount  = mysqli_num_rows($gissumres);
					   if($w<=$countryCountd)
					   {
						   $gis_total=$gissumCount+$gis_total;
					   }
					   
					   
					   $gissum1 = "select project_id,country_name,max(item_value1) as max_date from gis_update_data where item_value1>= now()-interval 1 month and country_name='$country' and item_name='GIS' group by project_id";
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
                     
                      <td id="td-title"><?php echo ucfirst(strtolower($country));?></td>
                      <td id="td-data">
                       
                        <a onclick="detailgis('<?php echo $country;?>','gt','1')"><?php echo $gissumCount;?></a>
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detailgis('<?php echo $country;?>','gu','1')"><?php  echo $gissumCount1;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detailgis('<?php echo $country;?>','gnu','1')"><?php echo $notupdated;?></a></span></td>
                    </tr>
                    <?php
					$w++;
				   }
				   ?>
                   <tr>
                     
                      <td id="td-title-total"><?php echo "Total";?></td>
                      <td id="td-data">
                       
                         <a onclick="detailgis('all','gt','1')"><?php echo $gis_total;?></a>
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detailgis('all','gu','1')"><?php  echo $gis_total_updated;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detailgis('all','gnu','1')"><?php echo $gis_total_nupdated;?></a></span></td>
                    </tr>

                    
                      
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
           
          </div>
        </div>
        
       <?php
			$updates="All PMIS";
			$system='PMIS';
			$table="pmis_update_data";
			$condition="1=1";
			?>
        <div id="pmisdiv">
        <div class="card" id="card_update">
              <div class="card-header" id="card_header-abcd">
                <h3 class="card-title"><?php echo $updates?></h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body" id="card_body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead id="th-abcd">
                 
                  
                  <tr>
                  	 <th id="th-abcd">Project Code</th>
                    <th id="th-abcd">Project Name</th>
                     <th id="th-abcd">Country</th>
                    <th id="th-abcd"><?php echo $system;?> Link</th>
                    <th id="th-abcd"><?php echo $system;?> Last updated</th>
                    <th id="th-abcd">PWS Link</th>
                    <th id="th-abcd">PBS LInk</th>
                    
                  </tr>
                  </thead>
                  <tbody>
                  
                    <?php  /*echo $pmisUpdataDataQuery  = "select project_id,project_name, country_name, links,JSON_ARRAYAGG(JSON_OBJECT('item',item_name,'value',item_value1) ) as project_details
from pmis_update_data where item_name!='DMS' and item_name!='GIS' group by project_id";*/
		$pmisUpdataDataQuery  = "select project_id,project_name,links,country_name,max(item_value1) as max_date from $table where $condition  group by project_id";
                      $pmisUpdataDataResult = mysqli_query($con,$pmisUpdataDataQuery);
                      $pmisUpdataDataCount  = mysqli_num_rows($pmisUpdataDataResult);
                    while( $pmisUpdataDataRes = mysqli_fetch_assoc($pmisUpdataDataResult))
					{
					
							$pid= $pmisUpdataDataRes['project_id'];
							$project_name= $pmisUpdataDataRes['project_name'];
							$country_name= $pmisUpdataDataRes['country_name'];
							$links= $pmisUpdataDataRes['links'];
							$max_date= $pmisUpdataDataRes['max_date'];
							
					  ?>
                      <tr>
                      <td><a href="summary.php?id=<?php  echo $pid;?>">
                     <?php  echo $pid;?></a>
                      </td>
                      <td style="text-align:left; width:25%">
                     <?php  echo $project_name;?>
                      </td>
                      <td>
                     <?php  echo $country_name;?>
                      </td>
                      <td>
                     <a href="<?php  echo $links;?>" target="_blank">Yes</a>
                      </td>
                       <td>
                     <?php  echo $max_date;?>
                      </td>
                       <td>
                   NA
                      </td>
                      <td>
                NA
                      </td>
                      <?php
							
							?>
                            </tr>
                            <?php
					}
					?>
                                            
  
                 </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            </div>
            </div>
            
            
            <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
   <?php include("partials/footer.php")?>
  <!-- /.control-sidebar -->
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
    dattable1();
  });
  function dattable1(){
	  $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	
   /* $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
	   "scrollX": true,
    });*/
  }
</script>
</body>
</html>
<?php ob_end_flush();?>
