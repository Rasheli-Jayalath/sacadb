<?php
 require 'db.php'; 


 $div_id=$_GET['div_id'];
 $region_id=$_GET['region_id'];
echo $sql_lis31="select distinct country from saca_project_master where division=$div_id and region=$region_id";
$res_lis31=mysqli_query($con,$sql_lis31);

?>

<table width="100%">
<?php
while($res21=mysqli_fetch_assoc($res_lis31))
{
$country_id=$res21['country'];
$Sqlc = "SELECT * FROM ds003country where cid=$country_id";
			$resc=mysqli_query($con,$Sqlc);
			$resultc=mysqli_fetch_assoc($resc);
			$cid=$resultc['cid'];
?>
<tr><td width="70%">
<input type="checkbox" name="cmid_<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $country_id; ?>"  id="cmid_<?php echo $div_id?>_<?php echo $region_id; ?>_<?php echo $country_id; ?>" value="<?php echo  $country_id;?>" onchange="getproject_p(<?php echo $div_id; ?>,<?php echo $region_id; ?>,<?php echo $country_id; ?>)" /> <?=$resultc['cname']; ?>

<!--<input type="checkbox" id="country_arr[]" name="country_arr[]" value="<?php echo $div_id; ?>_<?php echo $region_id; ?>_<?php echo $country_id; ?>"  /> <?php			
			//echo $resultc['cname'];
			?> -->
			
			
		
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

