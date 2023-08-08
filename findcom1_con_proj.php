<?php
 require 'db.php'; 


 $div_id=$_GET['div_id'];
 $region_id=$_GET['region_id'];
$sql_lis31="select region from saca_project_master where division=$div_id group by region";
$res_lis31=mysqli_query($con,$sql_lis31);

?>

<table width="100%">
<?php
			

?>
</table>


