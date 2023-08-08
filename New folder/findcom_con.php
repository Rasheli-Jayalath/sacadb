<?php
 require 'db.php'; 
?>

<?php
 $div_id=$_GET['div_id'];
 	
 $sql_lis3="SELECT *
FROM
    saca_project_master
    INNER JOIN ds002region  
        ON (saca_project_master.region = ds002region .rid) where division='$div_id' group by region";
 $res_lis3=mysqli_query($con,$sql_lis3);

 
 /*$sql_lis3="select pcid from ds005project where cmid='$comm_id' group by pcid";
$res_lis3=mysql_query($sql_lis3);*/
?>
<table width="100%">
<?php
while($res2=mysqli_fetch_assoc($res_lis3))
{
/*$Sqlc = "SELECT * FROM ds003country where cid='$res2[pcid]'";
			$resc=mysql_query($Sqlc);
			$resultc=mysql_fetch_array($resc);
			$cid=$res2['cid'];*/
			$rid=$res2['rid'];
?>
<tr><td >
<input type="checkbox" name="cmid_<?php echo $div_id?>_<?php echo $rid; ?>"  id="cmid_<?php echo $div_id?>_<?php echo $rid; ?>" value="<?php echo  $rid;?>" onchange="getccpid(<?php echo $div_id?>,<?php echo $rid; ?>)" /> <?=$res2['rname']; ?>
</td></tr>
<?php			
}			

?>
</table>

