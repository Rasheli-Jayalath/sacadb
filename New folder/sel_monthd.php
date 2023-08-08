<?php  require 'db.php'; ?>
<?php

$smonth = intval($_GET['smonth']);

?>
                  
                
                  <thead id="th-abcd">
                    <tr>
                      
                      <th id="th-abcd">Country</th>
                      <th id="th-abcd">Total PMIS</th>
                      <th id="th-abcd">Updated</br> <small>(<?php echo $smonth;?> Months)</small></th>
                      <th id="th-abcd">Not Updated</br> <small>(<?php echo $smonth;?> Months)</small></th>
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
					   
					   $pmissum = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where country_name='$country' and item_name='DMS' group by project_id";
                        $pmissumres = mysqli_query($con,$pmissum);
                  		 $pmissumCount  = mysqli_num_rows($pmissumres);
					   if($u<=$countryCount)
					   {
						   $pmis_total=$pmissumCount+$pmis_total;
					   }
					   
					   
					   $pmissum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval $smonth month and country_name='$country' and item_name='DMS' group by project_id";
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
                     
                      <td id="td-title"><?php echo $country;?></td>
                      <td>
                       
                        <?php echo $pmissumCount;?>
                      
                      </td>
                      <td id="td-data"><span ><?php  echo $pmissumCount1;?></span></td>
                       <td id="td-data"><span ><?php echo $notupdated;?></span></td>
                    </tr>
                    <?php
					$u++;
				   }
				   ?>
                   <tr>
                     
                      <td id="td-title-total"><?php echo "Total";?></td>
                      <td id="td-data">
                       
                        <?php echo $pmis_total;?>
                      
                      </td>
                      <td id="td-data"><span ><?php  echo $pmis_total_updated;?></span></td>
                       <td id="td-data"><span ><?php echo $pmis_total_nupdated;?></span></td>
                    </tr>
                    
                      
                  </tbody>
               