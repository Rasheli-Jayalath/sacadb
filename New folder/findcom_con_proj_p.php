<?php
 require 'db.php'; 


 $div_id=$_GET['div_id'];
 $region_id=$_GET['region_id'];
  $country_id=$_GET['country_id'];
echo $sql_lis31="select distinct master_code, project_desc from saca_project_master where division=$div_id and region=$region_id and country=$country_id";
$res_lis31=mysqli_query($con,$sql_lis31);

?>

<table width="100%">
<?php
while($res21=mysqli_fetch_assoc($res_lis31))
{
$master_code=$res21['master_code'];
$project_desc=$res21['project_desc'];

?>
<tr><td width="70%">
<input type="checkbox"  name="project_arr[]"  id="project_arr[]" value="<?php echo $div_id; ?>_<?php echo $region_id; ?>_<?php echo $countryid; ?>_<?php echo $master_code; ?>"  <?php if($checkedp1=="1"){?>checked<?php }?>/> 			


 <?php			
			echo $res21['project_desc'];
			?> 
			
			
		
			</td>
			<!--<td width="30%"><select id="roles[]" name="roles[]"> 
		      <option value="<?php echo $div_id; ?>_<?php echo $coun_id; ?>_<?php echo $pid; ?>_0" >Select Role</option> 

      <option value="<?php echo $comm_id; ?>_<?php echo $coun_id; ?>_<?php echo $pid; ?>_1" <?php if($resultd['user_role']==1){?> selected="selected"<?php } ?> >Padmin</option> 
      <option value="<?php echo $comm_id; ?>_<?php echo $coun_id; ?>_<?php echo $pid; ?>_2" <?php if($resultd['user_role']==2){?> selected="selected"<?php } ?>>Paccount</option> 
      <option value="<?php echo $comm_id; ?>_<?php echo $coun_id; ?>_<?php echo $pid; ?>_3" <?php if($resultd['user_role']==3){?> selected="selected"<?php } ?>>Preadonly</option> 
   </select></td>--></tr>
	
			<?php			
}			

?>
</table>

