<?php session_start();
 $uid=$_SESSION["uid"];
echo $sql = "select * from saca_dashboard.direct_users where uid = 3";
	$stmt = mysqli_query($con,$sql);
	 $num_rows  = mysqli_num_rows($stmt)+0;
	$data = mysqli_fetch_assoc($stmt);
	$user_type=$data['user_type'];
	$kpi=$data['kpi'];
	$ppr=$data['ppr'];
	$pmis=$data['pmis'];
	
	$cvbank=$data['cvbank'];
	$hr=$data['hr'];
	$software_portal=$data['software_portal'];
	
	$team_finder=$data['team_finder'];
	$bd_dashboard=$data['bd_dashboard'];
	$div_dms=$data['div_dms'];
	
	$aibot=$data['aibot'];
	$eshs=$data['eshs'];

	$photo_video=$data['photo_video'];
	$apps=$data['apps'];
	
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
  [class*=sidebar-dark-] {
    background-color: #062659;
}</style>

<aside class="main-sidebar sidebar-dark-primary elevation-4">

    <!-- Brand Logo -->
    <a href="home.php" class="brand-link ">
      <img  src="../../sacadb/theme/dist/img/smec-white.png" alt="SJ-SMEC Logo" class="" width="150" height="80" style="opacity: .8;margin-left: 40px;">
      <span class="brand-text font-weight-light"></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-2 pb-1 mb-3 d-flex">
        <div class="image">
         <!--  <img src="../../sacadb/theme/dist/img/sj1.png" class=" elevation-3" alt="User Image"> -->
        </div>
        <div class="info">
          <h5><a href="home.php" class="d-block" style="margin-left: 20px;"> SACA DASHBOARD</a></h5>
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
         ($_SERVER['REQUEST_URI'] == '/sacadb/fee_graph.php')||
         ($_SERVER['REQUEST_URI'] == '/sacadb/ee_graph.php')||
         ($_SERVER['REQUEST_URI'] == '/sacadb/bili_wip_deb_graph.php')||
         ($_SERVER['REQUEST_URI'] == '/sacadb/eva.php')||
         ($_SERVER['REQUEST_URI'] == '/sacadb/overhead.php')){
                  echo "menu-open";
                  }else echo""?>">
            <a href="" class="nav-link active">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                PPR Dashboard
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
                <a href="fee_graph.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/fee_graph.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Fee Analysis</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="ee_graph.php" class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/ee_graph.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>EAC ETC Analysis</p>
                </a>
              </li>
            
               <li class="nav-item">
                <a href="bili_wip_deb_graph.php" class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/bili_wip_deb_graph.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Billing, WIP & Debtors</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="eva.php" class="nav-link
                  <?php if($_SERVER['REQUEST_URI'] == '/sacadb/eva.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Earnd Value Analysis</p>
                </a>
              </li>
              
               <li class="nav-item">
                <a href="overhead.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/overhead.php'){
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
                PPR Dashboard
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
                <a href="#" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php'){
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
                <a href="#" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>ISC</p>
                </a>
              </li>
               <li class="nav-item">
                <a href="#" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/pprDashboard.php'){
                  echo "active";
                  }else echo" "?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pakisthan</p>
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
            <?php if($apps==1 || $user_type==1)
		   {?>
            <li class="nav-item">
            <a href="eshs.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/eshs.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-spa"></i>
              <p>
                ESHS
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
                ESHS       
              </p>
            </a>
			</li>
			   <?php
		   }
		   ?>
            <?php if($photo_video==1 || $user_type==1)
		   {?> 
            <li class="nav-item">
            <a href="photo_vdo.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/photo_vdo.php'){
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