<?php 
// Include the database config file 
include_once 'db.php'; 
 if(!empty($_POST["cid"])){ 
  $incListQuery  = "SELECT DISTINCT(smt.entity) as entity FROM saca_overhead_master as smt Inner Join saca_overhead as sp ON (smt.project = sp.project)
	 Where 1=1 AND   smt.cid = '".$_POST["cid"]."' ";
                 
                   $incListResult = mysqli_query($con,$incListQuery);
                     $incListCount  = mysqli_num_rows($incListResult);
					
    if($incListCount > 0){ 
        echo '<option value="">Entity</option>'; 
        while($incListRes = mysqli_fetch_assoc($incListResult)){  
            echo '<option value="'.$incListRes['entity'].'">'.$incListRes['entity'].'</option>'; 
        } 
    }else{ 
        echo '<option value="">Entity not available'.'</option>' ; 
    } }
	
