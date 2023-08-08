<?php 
// Include the database config file 
include_once 'db.php'; 
 if(!empty($_POST["cid"])){ 
  $incListQuery  = "SELECT DISTINCT(sp.entity) as entity FROM saca_project_master as smt Inner Join saca_profitability as sp ON (smt.master_code = sp.project)
	 Where 1=1 AND   smt.country = '".$_POST["cid"]."' ";
                 
                   $incListResult = mysqli_query($con,$incListQuery);
                     $incListCount  = mysqli_num_rows($incListResult);
					
    if($incListCount > 0){ 
        echo '<option value="">Entity</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['entity'].'">'.$incListRes['entity'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Entity not available'.$incListResult.'</option>' ; 
    } }
	
