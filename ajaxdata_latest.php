<?php 
// Include the database config file 
include_once 'db.php'; 
 
if(!empty($_POST["did"])){ 
    $incListQuery  = "SELECT * 
                      FROM ds002region WHERE did = '".$_POST["did"]."' order by rid  ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Region</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['rid'].'">'.$incListRes['rname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Region not available</option>'; 
    } 
}
if(!empty($_POST["rid"])){ 
   $incListQuery  = "SELECT * FROM ds003country WHERE rid = '".$_POST["rid"]."' order by cid ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Country</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['cid'].'">'.$incListRes['cname'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Country not available</option>'; 
    } 
	
	
	
}
//else if(!empty($_POST["sid"])&& $_POST["sid"]!=0 && $_POST["sid"]!="" &&  $_POST["sid"]!="undefined" && !empty($_POST["cid"])&& $_POST["cid"]!=0 && $_POST["cid"]!="" &&  $_POST["cid"]!="undefined" && !empty($_POST["Project_Type"]) && $_POST["Project_Type"]!=0 && $_POST["Project_Type"]!="" &&  $_POST["Project_Type"]!="undefined"){ 

 if(!empty($_POST["cid"]) && !empty($_POST["entity"]) && !empty($_POST["Project_Type"]) && !empty($_POST["Status"]) && (empty($_POST["sid"]) || $_POST["sid"]==0 || $_POST["sid"]=="" || $_POST["sid"]=="undefined")){ 
    $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."' AND sp.Project_Type='".$_POST["Project_Type"]."' AND sp.Status='".$_POST["Status"]."' AND smt.company='".$_POST["entity"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project'.'</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }
  }
  else if(!empty($_POST["sid"])&& !empty($_POST["cid"]) && !empty($_POST["entity"])&& $_POST["Project_Type"]=="" && $_POST["Status"]==""  ){ 
    $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."' AND smt.sector='".$_POST["sid"]."' AND smt.entity='".$_POST["entity"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project'.'</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }
  }
 elseif(!empty($_POST["sid"])&&!empty($_POST["cid"])&& $_POST["Project_Type"]=="" && $_POST["Status"]==""  ){ 
    $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."' AND smt.sector='".$_POST["sid"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project'.'</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">PROJECT not available</option>'; 
    } }
	
else if(!empty($_POST["sid"])&& !empty($_POST["cid"])&&  !empty($_POST["Project_Type"]) && $_POST["Status"]=="" ){ 
    $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."' AND smt.sector='".$_POST["sid"]."' AND sp.Project_Type='".$_POST["Project_Type"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">PROJECT not available'.'</option>' ; 
    } }
	
else if(!empty($_POST["sid"])&& !empty($_POST["cid"])&&  !empty($_POST["Project_Type"]) && !empty($_POST["Status"])){ 
    echo $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."' AND smt.sector='".$_POST["sid"]."' AND sp.Project_Type='".$_POST["Project_Type"]."' AND sp.Status='".$_POST["Status"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">PROJECT not available'.'</option>' ; 
    } }

else if(!empty($_POST["cid"])&& $_POST["cid"]!=0 && $_POST["cid"]!="" && $_POST["cid"]!="undefined" && (empty($_POST["sid"]) || $_POST["sid"]==0 || $_POST["sid"]=="" || $_POST["sid"]=="undefined") && (empty($_POST["Project_Type"]) || $_POST["Project_Type"]==0 || $_POST["Project_Type"]=="" || $_POST["Project_Type"]=="undefined") ){ 
   $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                      FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.country = '".$_POST["cid"]."'  order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
	
        echo '<option value="">3PROJECT not available</option>'; 
    } }
	
elseif(!empty($_POST["sid"]) && $_POST["sid"]!=0 && $_POST["sid"]!="" && $_POST["sid"]!="undefined" && (empty($_POST["cid"]) || $_POST["cid"]==0 || $_POST["cid"]=="" || $_POST["cid"]=="undefined") && (empty($_POST["Project_Type"]) || $_POST["Project_Type"]==0 || $_POST["Project_Type"]=="" || $_POST["Project_Type"]=="undefined" )){ 
   $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                       FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND smt.sector='".$_POST["sid"]."' order by sp.project ASC ";
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code']." - ".$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">4PROJECT not available</option>'; 
    } }
	
elseif(!empty($_POST["Project_Type"]) && $_POST["Project_Type"]!=0 && $_POST["Project_Type"]!="" && (empty($_POST["sid"]) || $_POST["sid"]==0 || $_POST["sid"]=="" || $_POST["sid"]=="undefined") && (empty($_POST["cid"]) || $_POST["cid"]==0 || $_POST["cid"]=="" || $_POST["cid"]=="undefined")){ 
   $incListQuery  = "select DISTINCT(smt.master_code), sp.Project_Description 
                       FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1=1 AND sp.Project_Type='".$_POST["Project_Type"]."' order by sp.project ASC ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['master_code'].'">'.$incListRes['master_code'].$incListRes['Project_Description'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">5PROJECT not available</option>'; 
    } }

?>