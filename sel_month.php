<?php  
require 'db.php'; 
//include("check_rights.php");
?>
<?php

$smonth = intval($_GET['smonth']);

?>
                  
                
                  <thead id="th">
                    <tr>
                      
                      <th id="th">Country</th>
                      <th id="th">Total PMIS</th>
                      <th id="th">Updated</br> <small>(<?php echo $smonth;?> Months)</small></th>
                      <th id="th">Not Updated</br> <small>(<?php echo $smonth;?> Months)</small></th>
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
					   
					   
					 $pmissum1 = "select project_id,country_name,max(item_value1) as max_date from pmis_update_data where item_value1>= now()-interval $smonth month and country_name='$country'  group by project_id";
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
                      <td>
                       <a onclick="detailpmis('<?php echo $country;?>','pt','<?php echo $smonth?>')" style="cursor:pointer"> <?php echo $pmissumCount;?></a>
                      <!-- <a href="pmis.php?c=<?php echo $country;?>&s=pt&m=<?php echo $smonth?>" onclick="pmis_detail(<?php echo $smonth?>)"> <?php echo $pmissumCount;?></a>-->
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detailpmis('<?php echo $country;?>','pu','<?php echo $smonth?>')" style="cursor:pointer"><?php  echo $pmissumCount1;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detailpmis('<?php echo $country;?>','pnu','<?php echo $smonth?>')" style="cursor:pointer"><?php echo $notupdated;?></a></span></td>
                    </tr>
                    <?php
					$u++;
				   }
				   ?>
                   <tr>
                     
                      <td id="td-title-total"><?php echo "Total";?></td>
                      <td id="td-data">
                       
                       <a onclick="detailpmis('all','pt','<?php echo $smonth?>')" style="cursor:pointer"> <?php echo $pmis_total;?></a>
                      
                      </td>
                      <td id="td-data"><span ><a onclick="detailpmis('all','pu','<?php echo $smonth?>')" style="cursor:pointer"><?php  echo $pmis_total_updated;?></a></span></td>
                       <td id="td-data"><span ><a onclick="detailpmis('all','pnu','<?php echo $smonth?>')" style="cursor:pointer"><?php echo $pmis_total_nupdated;?></a></span></td>
                    </tr>
                    
                      
                  </tbody>
               