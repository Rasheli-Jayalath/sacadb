<?php session_start();

$url_var="";

 $search      = trim($_REQUEST['search']);
 $did      = trim($_REQUEST['did']);
$rid      = trim($_REQUEST['rid']);
$cid    = trim($_REQUEST['cid']);
$project     = trim($_REQUEST['project']);
$sid     = trim($_REQUEST['sid']);
$Project_Type     =$_REQUEST['Project_Type'];
$Status     = $_REQUEST['Status'];
$fmonth      = trim($_REQUEST['fmonth']);
$year        = trim($_REQUEST['year']);
?>
<?php if(isset($did) && $did!=0 && $did!="" && $did!=NULL){
	$url_var.="did=".$did;
	 }?>
 <?php if(isset($rid) && $rid!=0 && $rid!="" && $rid!=NULL){
	$url_var.="&rid=".$rid;
	 }?>
      <?php if(isset($cid) && $cid!=0 && $cid!="" && $cid!=NULL){
	$url_var.="&cid=".$cid;
	 }?>
     <?php if(isset($sid) && $sid!=0 && $sid!="" && $sid!=NULL){
	$url_var.="&sid=".$sid;
	 }?>
     <?php if(isset($project) && $project!=0 && $project!="" && $project!=NULL){
	$url_var.="&project=".$project;
	 }
	?>
     
     <?php if($Project_Type !==0 && $Project_Type !=="" && $Project_Type !==NULL){
		
	$url_var.="&Project_Type=".$Project_Type;
	 }?>
     <?php if($Status!==0 && $Status!=="" && $Status!==NULL){
	$url_var.="&Status=".$Status;
	 }?>
     <?php if(isset($fmonth) && $fmonth!=0 && $fmonth!="" && $fmonth!=NULL){
	$url_var.="&fmonth=".$fmonth;
	 }?>
      <?php if(isset($year) && $year!=0 && $year!="" && $year!=NULL){
	$url_var.="&year=".$year;
	 }?>
      <?php  if(isset($search) && $search!=0 && $search!="" && $search!=NULL){
	$url_var.="&search=".$search;
	 }?>
     
     <?php 
	/*$url_var.="did=".$did;
	
	$url_var.="&rid=".$rid;
	 
	$url_var.="&cid=".$cid;
	 
	$url_var.="&sid=".$sid;
	
	$url_var.="&project=".$project;
	 
		
	$url_var.="&Project_Type=".$Project_Type;
	
	$url_var.="&Status=".$Status;
	
	$url_var.="&fmonth=".$fmonth;
	
	$url_var.="&year=".$year;
	 
	$url_var.="&search=".$search;*/
	 ?>

<style type="text/css">
.sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active, .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
    background-color: #163f6a;
    color: #fff;
}
.nav-sidebar>.nav-item>.nav-link.active-main{
    background-color: #79a9ce;
    color: #fff;
}

  [class*=sidebar-dark-] 
  {
    background-color: #062659;
}
</style>

 <aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    
    <a href="index.php" class="brand-link">
      <img src="../../sacadb/theme/dist/img/dashboard.png" alt="SJ-SMEC Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">SACA DASHBOARD</span>
    </a>
    
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="../../sacadb/theme/dist/img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $_SESSION["user_name"];?></a>
        </div>
      </div>
    
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <?php if($kpi==1 || $user_type==1)
		   {?>
		   <li class="nav-item">
           <a href="kpi.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/kpi.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-chart-line"></i>
              <p>
                KPI
                <i class=""></i>
              </p>
            </a>
           </li>
		   <?php
		   }
		   else{
			   ?>
			   <li class="nav-item">
           <a  class="nav-link active" style="opacity:0.5; cursor:default">
              <i style="" class="nav-icon fas fa-chart-line"></i>
              <p>
                KPI
                <i class=""></i>
              </p>
            </a>
           </li>
		   <?php
		   }
		   ?>
        <?php if($ppr==1 || $user_type==1)
		   {?> 
         <li class="nav-item <?php if(($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php')||
         ($_SERVER['REQUEST_URI'] == '/sacadb/fee_graph.php?'.$url_var )||
         ($_SERVER['REQUEST_URI'] == '/sacadb/ee_graph.php?'.$url_var)||
         ($_SERVER['REQUEST_URI'] == '/sacadb/bili_wip_deb_graph.php?'.$url_var)||
         ($_SERVER['REQUEST_URI'] == '/sacadb/eva.php?'.$url_var)||
         ($_SERVER['REQUEST_URI'] == '/sacadb/overhead.php?'.$url_var)){
                  echo "menu-open";
                  }else echo""?>">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
               Financial Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="pprDashboard.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>SACA Analytics</p>
                </a>
              </li>
			  <li class="nav-item">
                <a href="ppr_analysis.php?<?php echo $url_var;?> " class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/ppr_analysis.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>PPR Analytics</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="fee_graph.php?<?php echo $url_var;?> " class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/fee_graph.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fee Analysis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ee_graph.php?<?php echo $url_var;?> " class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/ee_graph.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>EAC & ETC Analysis</p>
                </a>
              </li>
            
               <li class="nav-item">
                <a href="bili_wip_deb_graph.php?<?php echo $url_var;?> " class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/bili_wip_deb_graph.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Billing, WIP & Debtors</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="eva.php?<?php echo $url_var;?> " class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/eva.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Earnd Value Analysis</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="overhead.php?<?php echo $url_var;?> " class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/overhead.php?'.$url_var){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Overhead</p>
                </a>
              </li>
            </ul>
         </li>
		   <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                Financial Dashboard
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
          <?php if($pmis==1 || $user_type==1)
		   {?> 
           <li class="nav-item">
           <a href="PMIS.php"class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/PMIS.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i class="nav-icon fas fa-poll"></i>
              <p>
              PMIS
              </p>
            </a>
            </li>
             <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
             <i class="nav-icon fas fa-poll"></i>
              <p>
                PMIS
              
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
           
           <?php if($samepage_log==1 || $user_type==1)
		   {?> 
           <li class="nav-item">
           <a href="site_log.php"class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/site_log.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i class="nav-icon far fa-file-alt"></i>
              <p>
              SAME Page Log
              </p>
            </a>
            </li>
             <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
             <i class="nav-icon far fa-file-alt"></i>
              <p>
                SAME Page Log
              
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
           
            <?php if($cvbank==1 || $user_type==1)
		   {?> 
            <li class="nav-item">
             <a href="cvbank.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/cvbank.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-paperclip"></i>
              <p>
                CV BANK
              </p>
             </a>
             </li>
              <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
             <i style="" class="nav-icon fas fa-paperclip"></i>
              <p>
                CV BANK              
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($hr==1 || $user_type==1)
		   {?> 
             <li class="nav-item">
             <a href="hr.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/hr.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon far fa-file-alt"></i>
              <p>
                HR Update
              </p>
             </a>
             </li>
              <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
             <i style="" class="nav-icon far fa-file-alt"></i>
              <p>
                 HR Update              
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($software_portal==1 || $user_type==1)
		   {?> 
             <li class="nav-item">
             <a href="slms.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/slms.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-file-code"></i>
              <p>
                Software Portal
              </p>
            </a>
            </li>
            <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i style="" class="nav-icon fas fa-file-code"></i>
              <p>
              Software Portal              
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
           <?php if($team_finder==1 || $user_type==1)
		   {?>
            <li class="nav-item">
            <a href="team_finder.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/team_finder.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-handshake"></i>
              <p>
                Team Finder
              </p>
            </a>
          </li>
           <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i style="" class="nav-icon fas fa-handshake"></i>
              <p>
              Team Finder             
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($bd_dashboard==1 || $user_type==1)
		   {?>
           <li class="nav-item <?php if(($_SERVER['REQUEST_URI'] == '/sacadb/car.php')||
                ($_SERVER['REQUEST_URI'] == '#')||
                ($_SERVER['REQUEST_URI'] == '#')||
                ($_SERVER['REQUEST_URI'] == '#')||
                ($_SERVER['REQUEST_URI'] == '#')){
                  echo "menu-open";
                  }else echo""?>">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-chart-pie"></i>
                <p>
                  BD Dashboard
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
             <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="ban.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/ban.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bangladesh</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="car.php"  class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/car.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>CAR</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="isc.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/isc.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ISC</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="pak.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pak.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pakistan</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ROSA</p>
                </a>
              </li>
             </ul>
          </li>
           <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i class="nav-icon fas fa-chart-pie"></i>
              <p>
              BD Dashboard           
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
           <?php if($div_dms==1 || $user_type==1)
		   {?>
            <li class="nav-item">
             <a href="dms.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/dms.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-folder-open"></i>
              <p>
                Divisional DMS
                <i class=""></i>
              </p>
            </a>
            </li>
<?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
           <i style="" class="nav-icon fas fa-folder-open"></i>
              <p>
              Divisional DMS          
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
           <?php if($aibot==1 || $user_type==1)
		   {?>  
            <li class="nav-item">
             <a href="aibot.php"  class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/aibot.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-comments"></i>
              <p>
                AI ChatBot
                <i class=""></i>
              </p>
            </a>
            </li>
            <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i style="" class="nav-icon fas fa-comments"></i>
              <p>
              AI ChatBot          
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($eshs==1 || $user_type==1)
		   {?>
            <li class="nav-item">
            <a href="eshs.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/eshs.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-spa"></i>
              <p>
                HSE Dashbaord
                <i class=""></i>
              </p>
            </a>
            </li>
             <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i style="" class="nav-icon fas fa-spa"></i>
              <p>
                HSE Dashbaord      
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($photo_video==1 || $user_type==1)
		   {?> 
            <li class="nav-item">
            <a href="gallery.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/gallery.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fa fa-fw fa-film"></i>
              <p>
                Photo/Video Gallery
                <i class=""></i>
              </p>
            </a>
            </li>
             <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
            <i style="" class="nav-icon fa fa-fw fa-film"></i>
              <p>
                Photo/Video Gallery        
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($apps==1 || $user_type==1)
		   {?>
            <li class="nav-item">
             <a href="our_apps.php"class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/our_apps.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon far fa-file-code"></i>
              <p>
                Our APPS
                <i class=""></i>
              </p>
            </a>
            

          </li>
          <?php
		   }
		   else{
			   ?>
			   <li class="nav-item ">
            <a  class="nav-link active" style="opacity:0.5; cursor:default">
           <i style="" class="nav-icon far fa-file-code"></i>
              <p>
                Our APPS       
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
          <?php if($user_type==1)
		   {?>
                <li class="nav-item <?php if(($_SERVER['REQUEST_URI'] == '/sacadb/manage_user.php')||
                ($_SERVER['REQUEST_URI'] == '/sacadb/profitability_upload.php')){
                  echo "menu-open";
                  }else echo""?>">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-landmark"></i>
              <p>
                Administrator
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="manage_user.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/manage_user.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="profitability_upload.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/profitability_upload.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Upload Data</p>
                </a>
              </li>
              
               
            </ul>
          </li><?php
		   }
		   ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
      </aside>    