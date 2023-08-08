<?php
 require 'db.php'; 
?>

<?php
 $div_id=$_GET['div_id'];
 echo $sql_lis3="select region from saca_project_master where division='$div_id' group by region";
$res_lis3=mysqli_query($con,$sql_lis3);
?>
<table width="100%">
<?php
while($res2=mysqli_fetch_assoc($res_lis3))
{
$Sqlc = "SELECT * FROM ds002region where rid='$res2[region]'";
			$resc=mysqli_query($con,$Sqlc);
			$resultc=mysqli_fetch_assoc($resc);
			$rid=$resultc['rid'];
?>
<tr><td >
<input type="checkbox" name="count_arraya[]"  id="count_arraya[]" value="<?php echo $div_id?>_<?php echo $rid; ?>" /> <?=$resultc['rname']; ?>

</td></tr>
<?php			
}			

?>
</table>

