<?php 
// Include the database config file 
include_once 'db.php'; 
 
if(!empty($_POST["Region_id"])){ 
    $incListQuery  = "SELECT Location
                      FROM saca_profitability WHERE Region = '".$_POST["Region_id"]."' GROUP BY Location  ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Select Location</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['Location'].'">'.$incListRes['Location'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Location not available</option>'; 
    } 
}elseif(!empty($_POST["Location_id"])){ 
   $incListQuery  = "SELECT project
                      FROM saca_profitability WHERE Location = '".$_POST["Location_id"]."' GROUP BY project  ";
                                          
                              
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
    if($incListCount > 0){ 
        echo '<option value="">Select Project</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['project'].'">'.$incListRes['project'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">PROJECT not available</option>'; 
    } 
}
?>