<?php
error_reporting(0);
include '../../db.php';
$response = array();

$devision = $_REQUEST["devision"];
$region = $_REQUEST["region"];
$country = $_REQUEST["country"];
$sector = $_REQUEST["sector"];
$months = $_REQUEST["months"];
$isfx = $_REQUEST["isfx"];

if ($isfx == "1") {
    $isfx = "%";
}

$query = "";
$opetor = "";
if ($region == "%") {
    $opetor = "like";
    $region = "'%'";
} else {
    $opetor = "in";
}
$opetor1 = "";
if ($sector == "%") {
    $opetor1 = "like";
    $sector = "'%'";
} else {
    $opetor1 = "in";
}

$query = "with profit as (
select round(sum(case when project_type = 'External' then total_rev else 0 end),2) as total_rev_mtd,round(sum(case when project_type = 'External' then total_rev1 else 0 end),2) as total_rev1_ytd,round(sum(Fees),2) as total_fee_mtd,round(sum(Fees1),2) as total_fee_ytd,round(sum(Contrib),2) as total_contrib_mtd,round(sum(Contrib1),2) as total_contrib_ytd ,
round((sum(Contrib)/sum(Fees)*100),2) as total_contrib_mtd_percentage,
round((sum(Contrib1)/sum(Fees1)*100),2) as total_contrib_ytd_percentage,1210000 as mtd_country_overhead,
0 as mtd_division_overhead,1210000 as ytd_country_overhead,0 as ytd_division_overhead,
round(sum(Contrib)-(1210000+0),2) as net_mtd_contribution,round(sum(Contrib1)-(1210000+0),2) as net_ytd_contribution,
round((sum(Contrib)-(1210000+0))/sum(Fees) *100,2) as net_mtd_contribution_percen,
round((sum(Contrib1)-(1210000+0))/sum(Fees1) *100,2) as net_ytd_contribution_percen,
round(sum(case when project_type = 'External' then WIP else 0 end),2) as ytd_wip,
round(max(replace(WIP_Days,'>','')),2) as ytd_wip_days,
round(sum(case when project_type = 'External' then Debtors else 0 end),2) as ytd_debtors,
round(max(replace(Debtor_Days,'>','')),2) as ytd_debtors_days,
round(sum(Lockup),2) as ytd_lockup,round(max(replace(Lockup_Days,'>','')),2) as ytd_lockup_days,
round(sum(Billings),2) as ytd_billings,
(select DATEDIFF(LAST_DAY(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),
MAKEDATE(year(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),1))+1) as month_days
from saca_profitability where concat(month,'-',year) like '" . $months . "' and project in (
select project_code from saca_project_master where division=" . $devision . " and region " . $opetor . " (" . $region . ") and sector " . $opetor1 . " (" . $sector . ") and is_fx like '" . $isfx . "')
),forcast_join as(
with forcast as(
select division_code,region_code,sector_code,fee,gc,nww,dates,concat(month(dates),'-',fc_year) as months from(
select *,DATE_FORMAT( STR_TO_DATE( concat('1','-',fc_month,'-',fc_year) , '%d-%m-%Y' ) , '%Y-%m-%d' ) as dates
from country_forcasts where  division_code=" . $devision . " and region_code " . $opetor . " (" . $region . ") and 
sector_code " . $opetor1 . " (" . $sector . ")
) as f
),ytd as(
select sum(fee) as ytd_forcast_fee,sum(gc) as ytd_forcast_contrib from forcast where dates between MAKEDATE(year(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),1) and DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )
),mtd as(
select sum(fee) as mtd_forcast_fee,sum(gc) as mtd_forcast_contrib from forcast where months like '" . $months . "'
)
select *,round((mtd_forcast_contrib/mtd_forcast_fee)*100,2) as mtd_forcast_fee_percen,round((ytd_forcast_contrib/ytd_forcast_fee)*100,2) as ytd_forcast_fee_percen from mtd,ytd
),budget as(
with b1 as(
with feebudget as(
select region_code,sector,fee,dates,concat(month(dates),'-',year) as months from(
select *,DATE_FORMAT( STR_TO_DATE( concat('1','-',months,'-',year) , '%d-%m-%Y' ) , '%Y-%m-%d' ) as dates
from fee_budget where  division=" . $devision . " and region_code " . $opetor . " (" . $region . ") and 
sector " . $opetor1 . " (" . $sector . ") 
) as f
),ytd as(
select sum(fee) as ytd_budget_fee from feebudget where dates between MAKEDATE(year(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),1) and DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )
),mtd as(
select sum(fee) as mtd_budget_fee from feebudget where months like '" . $months . "'
)
select * from mtd,ytd
),b2 as(
with gcbudget as(
select region_code,sector,gc,dates,concat(month(dates),'-',year) as months from(
select *,DATE_FORMAT( STR_TO_DATE( concat('1','-',months,'-',year) , '%d-%m-%Y' ) , '%Y-%m-%d' ) as dates
from gc_budget where division=" . $devision . " and  region_code " . $opetor . " (" . $region . ") and 
sector " . $opetor1 . " (" . $sector . ") 
) as f
),ytd as(
select sum(gc) as ytd_budget_contrib from gcbudget where dates between MAKEDATE(year(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),1) and DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )
),mtd as(
select sum(gc) as mtd_budget_contrib from gcbudget where months like '" . $months . "'
)
select * from mtd,ytd
)
select * from b1,b2
),
overhead_fnl as(   
with overhead as(
    select *,concat(month(dates),'-',year) as months from(
    select *,
    DATE_FORMAT( STR_TO_DATE( concat('1','-',month,'-',year) , '%d-%m-%Y' ) , '%Y-%m-%d' ) as dates  
    from saca_overhead_combin where did=" . $devision . " and rid " . $opetor . " (" . $region . ") and 
    sid " . $opetor1 . " (" . $sector . ")  
    ) as foo
    ),ytd as(
    select round(sum(case when budget_type='Actual' and distributation_type='Divisional' then overheads else 0 end),2) as ytd_divisional_overhead,
    round(sum(case when budget_type='Actual' and distributation_type='Country' then overheads else 0 end),2) as ytd_country_overhead,round(sum(case when budget_type='Budget' and distributation_type='Divisional' then overheads else 0 end),2) as ytd_divisional_overhead_budget,
    round(sum(case when budget_type='Budget' and distributation_type='Country' then overheads else 0 end),2) as ytd_country_overhead_budget  
    from overhead where dates between MAKEDATE(year(DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )),1) and DATE_FORMAT( STR_TO_DATE( concat('1','-','" . $months . "') , '%d-%m-%Y' ) , '%Y-%m-%d' )
    ),mtd as(
    select round(sum(case when budget_type='Actual' and distributation_type='Divisional' then overheads else 0 end),2) as divisional_overhead,
    round(sum(case when budget_type='Actual' and distributation_type='Country' then overheads else 0 end),2) as country_overhead,round(sum(case when budget_type='Budget' and distributation_type='Divisional' then overheads else 0 end),2) as divisional_overhead_budget,
    round(sum(case when budget_type='Budget' and distributation_type='Country' then overheads else 0 end),2) as country_overhead_budget  
    from overhead where months like '" . $months . "'
    )
    select * from mtd,ytd
)
select * from profit,forcast_join,budget,overhead_fnl;";

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
