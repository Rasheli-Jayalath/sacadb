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


?>
<table width="100%">
<?php
while($res2=mysqli_fetch_assoc($res_lis3))
{

			$rid=$res2['rid'];
?>
<tr><td >

<input type="checkbox" name="count_arraya[]"  id="cmid_<?php echo $div_id?>_<?php echo $rid; ?>" value="<?php echo $div_id?>_<?php echo  $rid;?>" onchange="getccpid_p(<?php echo $div_id?>,<?php echo $rid; ?>)" /> <?=$res2['rname']; ?>

</td></tr>
<?php			
}			

?>
</table>

