<?php
error_reporting(0);
include '../../db.php';
$response = array();

$division = $_REQUEST["division"];
// $region = $_REQUEST["region"];
$ddfor = $_REQUEST["ddfor"];
$query = "";

if ($ddfor == 'DDDivision') {
    $query = "select did as ddid,dname as ddname,'Select Division' as ddlabel from ds001division;";
} else if ($ddfor == 'DDRegion') {
    $query = "select rid as ddid,rname as ddname,'Select Region' as ddlabel from ds002region where did=" . $division . ";";
} else if ($ddfor == 'DDSector') {
    $query = "select sid as ddid,sectors as ddname,'Select Sector' as ddlabel from ds004sectors;";
} else if ($ddfor == 'DDMonths') {
    $query = "select *,'Select Month' as ddlabel from(
        select months as ddid,DATE_FORMAT( STR_TO_DATE( months , '%m-%Y' ) , '%M-%Y' ) as ddname,
        DATE_FORMAT( STR_TO_DATE( concat('01','-',months) , '%d-%m-%Y' ) , '%Y-%m-%d' ) as d 
        from(
        select distinct concat(month,'-',year) as months from saca_profitability
        ) as foo 
        )as goo order by d desc;";
}

// echo $query;
$result = mysqli_query($con, $query);
//   $rcount=mysqli_num_rows($result);
//   $res=mysqli_fetch_assoc($result);
$res = mysqli_fetch_all($result, MYSQLI_ASSOC);

if ($res) {
    // print_r($res);
    // $res["status"] = '200';
    echo json_encode($res);
} else {
    //Some error while fetching data
    $response = array(
        "msgstatus" => '402',
        "msg" => 'No Data Found'
    );
    $tarr[0] = $response;
    echo json_encode($tarr);
}
