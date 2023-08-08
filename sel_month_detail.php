<?php  
require 'db.php'; 
//include("check_rights.php");
?>

<?php

$smonth = intval($_GET['smonth']);
 if(isset($_GET['c']) && isset($_GET['s']) )
		{
			
		 if($_GET['c']=="all")
		 {
			 if($_GET['s']=='pt')
					{
						$updates="All PMIS";
						$system='PMIS';
						$table="pmis_update_data";
						$condition="1=1";
					}
					else if($_GET['s']=='pu')
					{
						$updates="Updated PMIS";
						$system='PMIS';
						$table="pmis_update_data";
						$condition=" item_value1>= now()-interval $smonth month";
					}
					else if($_GET['s']=='pnu')
					{
						$updates="Not Updated PMIS";
						$system='PMIS';
						$table="pmis_update_data";
						$condition=" project_id not in (select project_id from $table where item_value1>= now()-interval $smonth month group by project_id) ";
					}
		 }
		 else
		 {
		
					$country=$_GET['c'];
					
					if($_GET['s']=='pt')
					{
						$updates="All PMIS - ". $_GET['c'];
						$system='PMIS';
						$table="pmis_update_data";
						$condition="country_name='$country'";
					}
					else if($_GET['s']=='pu')
					{
						$updates="Updated PMIS - ". $_GET['c'];
						$system='PMIS';
						$table="pmis_update_data";
						$condition="country_name='$country' and item_value1>= now()-interval $smonth month";
					}
					else if($_GET['s']=='pnu')
					{
						$updates="Not Updated PMIS - ". $_GET['c'];
						$system='PMIS';
						$table="pmis_update_data";
						$condition="project_id not in (select project_id from $table where country_name='$country' and item_value1>= now()-interval $smonth month group by project_id) and country_name='$country'";
					}
					
					
				}
		}
		
		else
			{
			$updates="All PMIS";
			$system='PMIS';
			$table="pmis_update_data";
			$condition="1=1 and item_value1>= now()-interval $smonth month";
			}?>


                  
                
   
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
                  
                    <?php 
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
                 </div>
           
               
       
  