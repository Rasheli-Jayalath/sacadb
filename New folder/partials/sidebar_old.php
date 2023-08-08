<?php session_start();
echo $uid=$_SESSION["uid"];
$sql = "select * from saca_dashboard.direct_users where uid = $uid";
	$stmt = mysqli_query($con,$sql);
	 $num_rows  = mysqli_num_rows($stmt)+0;
	$data = mysqli_fetch_assoc($stmt);
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
      <img style="margin-left: 40px;" src="../../sacadb/theme/dist/img/smec-white.png"
           alt="SJ-SMEC Logo" class="" width="150" height="80" style="opacity: .8">
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

      <!-- SidebarSearch Form -->
      <!-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> -->

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
           <?php if($kpi==1)
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
        <?php if($ppr==1)
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
             <li class="nav-item">
             <a href="slms.php" class="nav-link <?php if($_SERVER['REQUEST_URI'] == '/sacadb/slms.php'){
                  echo "active-main";
                  }else echo"active"?>">
              <i style="" class="nav-icon fas fa-file-code"></i>
              <p>
                Software Portal
              </p>
            </a>
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
          </li>
          <!-- <li class="nav-item">
            <a href="fee_graph.php" class="nav-link active">
              <i style="margin-left:0px; " class="nav-icon fas fa-chart-pie"></i>
              <p >
                PPR
                <i class=""></i>
              </p>
            </a>
             <a href="PMIS.php" class="nav-link active">
              <i style="margin-left:0px; " class="nav-icon fas fa-chart-pie"></i>
              <p>
                PMIS
                <i class=""></i>
              </p>
            </a>
             <a href="http://117.247.187.20:8071/Oppurtunity/qrdash-home.php" target="new" class="nav-link active">
              <i style="margin-left:0px; " class="nav-icon fas fa-chart-pie"></i>
              <p>
                BD Dashboard
                <i class=""></i>
              </p>
            </a>
             <a href="https://surbanajurong.sharepoint.com/sites/region-same/SitePages/Askaquestion.aspx" target="new" class="nav-link active">
              <i style="margin-left:0px; " class="nav-icon fas fa-chart-pie"></i>
              <p>
                AI ChatBot
                <i class=""></i>
              </p>
            </a>
          </li> -->
         <!--  <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tree"></i>
              <p>
                UI Elements
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sacadb/theme/UI/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/icons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Icons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/buttons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Buttons</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/sliders.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Sliders</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/modals.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Modals & Alerts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/navbar.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Navbar & Tabs</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/timeline.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Timeline</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/UI/ribbons.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Ribbons</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Forms
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sacadb/theme/forms/general.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>General Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/forms/advanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Advanced Elements</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/forms/editors.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Editors</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/forms/validation.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Validation</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-table"></i>
              <p>
                Tables
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sacadb/theme/tables/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Tables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/tables/data.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>DataTables</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/tables/jsgrid.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>jsGrid</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">EXAMPLES</li>
          <li class="nav-item">
            <a href="../sacadb/theme/calendar.html" class="nav-link">
              <i class="nav-icon far fa-calendar-alt"></i>
              <p>
                Calendar
                <span class="badge badge-info right">2</span>
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../sacadb/theme/gallery.html" class="nav-link">
              <i class="nav-icon far fa-image"></i>
              <p>
                Gallery
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="../sacadb/theme/kanban.html" class="nav-link">
              <i class="nav-icon fas fa-columns"></i>
              <p>
                Kanban Board
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-envelope"></i>
              <p>
                Mailbox
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sacadb/theme/mailbox/mailbox.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Inbox</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/mailbox/compose.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Compose</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/mailbox/read-mail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Read</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Pages
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../sacadb/theme/examples/invoice.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Invoice</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/profile.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Profile</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/e-commerce.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>E-commerce</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/projects.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Projects</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/project-add.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Add</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/project-edit.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Edit</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/project-detail.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Project Detail</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/contacts.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contacts</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/faq.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>FAQ</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/contact-us.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Contact us</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-plus-square"></i>
              <p>
                Extras
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v1
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/login.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/register.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/forgot-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v1</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/recover-password.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v1</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Login & Register v2
                    <i class="fas fa-angle-left right"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/login-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Login v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/register-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Register v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/forgot-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Forgot Password v2</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="../sacadb/theme/examples/recover-password-v2.html" class="nav-link">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Recover Password v2</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/lockscreen.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Lockscreen</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/legacy-user-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Legacy User Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/language-menu.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Language Menu</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/404.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 404</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/500.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Error 500</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/pace.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Pace</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../sacadb/theme/examples/blank.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Blank Page</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../../sacadb/theme/starter.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Starter Page</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-search"></i>
              <p>
                Search
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="../search/simple.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Simple Search</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="../search/enhanced.html" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Enhanced</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-header">MISCELLANEOUS</li>
          <li class="nav-item">
            <a href="../../sacadb/theme/iframe.html" class="nav-link">
              <i class="nav-icon fas fa-ellipsis-h"></i>
              <p>Tabbed IFrame Plugin</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="https://adminlte.io/docs/3.1/" class="nav-link">
              <i class="nav-icon fas fa-file"></i>
              <p>Documentation</p>
            </a>
          </li>
          <li class="nav-header">MULTI LEVEL EXAMPLE</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-circle"></i>
              <p>
                Level 1
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>
                    Level 2
                    <i class="right fas fa-angle-left"></i>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="far fa-dot-circle nav-icon"></i>
                      <p>Level 3</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="#" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Level 2</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="fas fa-circle nav-icon"></i>
              <p>Level 1</p>
            </a>
          </li>
          <li class="nav-header">LABELS</li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-danger"></i>
              <p class="text">Important</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-warning"></i>
              <p>Warning</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-circle text-info"></i>
              <p>Informational</p>
            </a>
          </li> -->
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>