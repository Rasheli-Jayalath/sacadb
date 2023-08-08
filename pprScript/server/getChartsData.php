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
$fmonth = explode("-", $months)[0];
$fyear = explode("-", $months)[1];
$chart = $_REQUEST["chart"];

if ($isfx == "1") {
    $isfx = "%";
}

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


$query = "";
if ($chart == "projectChartCounts") {
    $query = "with res as(
        with fltr as( 
        select project_code,region,division from saca_project_master m 
        where division=" . $devision . " and m.region " . $opetor . " (" . $region . ") and 
        m.sector " . $opetor1 . " (" . $sector . ")  and m.is_fx like '" . $isfx . "'
        )
        select Status as lbl,count(*) as vals from saca_profitability sp,fltr 
        where fltr.project_code=sp.project and concat(sp.month,'-',sp.year) like '" . $months . "' group by Status
        )
        select s.status as lbl,vals from res left outer join ds005status s on res.lbl=s.status_code;";
} else if ($chart == "MTDFeeChartByRegion") {
    $query = "with fltr as( 
        with rgn as(
        select rid,rname from ds002region
        )
        select project_code,region,division,rname as region_name from saca_project_master m,rgn 
        where rgn.rid=m.region and division=" . $devision . " and m.region " . $opetor . " (" . $region . ") and 
        m.sector " . $opetor1 . " (" . $sector . ") and m.is_fx like '" . $isfx . "'
        )
        select region_name as lbl,fltr.region,ROUND(sum(Fees)/1000000,2) as vals from saca_profitability sp,fltr 
        where fltr.project_code=sp.project and concat(sp.month,'-',sp.year) like '" . $months . "' group by fltr.region;";
} else if ($chart == "MTDFeeChartBySector") {
    $query = "with fltr as( 
        with lbl as(
        select sid,sectors from ds004sectors
        )
        select project_code,region,sector,division,sectors as sector_name from saca_project_master m,lbl 
        where lbl.sid=m.sector and m.sector<>6 and division=" . $devision . " and m.region " . $opetor . " (" . $region . ") and m.sector " . $opetor1 . " (" . $sector . ") and m.is_fx like '" . $isfx . "'
        )
        select sector_name as lbl,fltr.sector,ROUND(sum(Fees)/1000000,2) as vals from saca_profitability sp,fltr 
        where fltr.project_code=sp.project and concat(sp.month,'-',sp.year) like '" . $months . "' group by fltr.sector;";
} else if ($chart == "PPRChartRevenueVsContribution") {
    $query = "select MONTHNAME(DATE_FORMAT( STR_TO_DATE( concat('1','-',lbl) , '%d-%m-%Y' ) , '%Y-%m-%d' )) as lbl,ROUND(sum(total_rev1)/1000000,2) as vals,ROUND(sum(total_contrib)/1000000,2) as vals1 from(
        select Total_Rev1 as total_rev1,Contrib1 as total_contrib,concat(month,'-',year) as lbl from saca_profitability 
         where month <= " . $fmonth . " and year='" . $fyear . "' and project in (
            select project_code from saca_project_master where division=" . $devision . " and region " . $opetor . " (" . $region . ") and sector " . $opetor1 . " (" . $sector . ") and is_fx like '" . $isfx . "'  )
        ) as foo  group by lbl;";
} else if ($chart == "MonthlyInvoicesStatisticChart") {
    $query = "select MONTHNAME(DATE_FORMAT( STR_TO_DATE( concat('1','-',lbl) , '%d-%m-%Y' ) , '%Y-%m-%d' )) as lbl,ROUND(sum(invoice_amount_aud)/1000000,2) as vals,count(*) as vals1 from(
        select projectcode,concat(MONTH(invoicedate),'-',year(invoicedate)) as lbl,invoice_amount_aud,invoicedate from(
        SELECT projectcode,DATE_FORMAT( STR_TO_DATE( invoicedate , '%m/%d/%Y' ) , '%Y-%m-%d' )  as invoicedate,
        invoice_amount_aud FROM saca_invoicing  where projectcode in (
    select project_code from saca_project_master where division=" . $devision . " and  region " . $opetor . " (" . $region . ") and sector " . $opetor1 . " (" . $sector . ") and is_fx like '" . $isfx . "'  )
        ) as f
        ) as foo where month(invoicedate) <= " . $fmonth . " and year(invoicedate)='" . $fyear . "'  group by lbl;";
} else if ($chart == "WipAndDebtorChart") {
    $query = "select MONTHNAME(DATE_FORMAT( STR_TO_DATE( concat('1','-',lbl) , '%d-%m-%Y' ) , '%Y-%m-%d' )) as lbl,ROUND(sum(WIP)/1000000,2) as vals,ROUND(sum(Debtors)/1000000,2) as vals1 from(
        select WIP,Debtors,concat(month,'-',year) as lbl from saca_profitability where month <= " . $fmonth . " and year='" . $fyear . "' and project in (
            select project_code from saca_project_master where division=" . $devision . " and region " . $opetor . " (" . $region . ") and sector " . $opetor1 . " (" . $sector . ")  and is_fx like '" . $isfx . "' )
        ) as foo group by lbl;";
} else if ($chart == "SectorWiseYTDFeeByCountChart") {
    $query = "with fltr as(
        select project_code,(select rname from ds002region r where r.rid=m.region) as region_name,division,
        (select sectors from ds004sectors s where s.sid=m.sector) as sector_name 
        from saca_project_master m where division=" . $devision . " and m.region " . $opetor . " (" . $region . ") and 
        m.sector " . $opetor1 . " (" . $sector . ")  and m.is_fx like '" . $isfx . "'
        )
        select region_name as lbl,ROUND(sum(case when sector_name='Transportation' then Fees1 else 0 end)/1000000,2) as vals_trans,
        ROUND(sum(case when sector_name='Water' then Fees1 else 0 end)/1000000,2) as vals_water,
        ROUND(sum(case when sector_name='Renewables' then Fees1 else 0 end)/1000000,2) as vals_renewable,
        ROUND(sum(case when sector_name='Urban' then Fees1 else 0 end)/1000000,2) as vals_urban,
        ROUND(sum(case when sector_name='Others' then Fees1 else 0 end)/1000000,2) as vals_others,
        ROUND(sum(case when sector_name='Internal' then Fees1 else 0 end)/1000000,2) as vals_internal
        from saca_profitability sp,fltr where fltr.project_code=sp.project and concat(month,'-',year) like '" . $months . "'  group by fltr.region_name;";
} else if ($chart == "MonthlyPercenMTDFeeRevenueChart") {
    $query = "select *,round((total_yes/total)*100,2) as vals,round((total_no/total)*100,2) as vals1 from(
        select MONTHNAME(DATE_FORMAT( STR_TO_DATE( concat('1','-',lbl) , '%d-%m-%Y' ) , '%Y-%m-%d' )) as lbl,count(*) as total,sum(case when lower(Reviewed)='yes' then 1 else 0 end) as total_yes,
        sum(case when lower(Reviewed)='no' then 1 else 0 end) as total_no from(
        select Reviewed,concat(month,'-',year) as lbl from saca_profitability where month <= " . $fmonth . " and year='" . $fyear . "' and project in (
            select project_code from saca_project_master where division=" . $devision . " and region " . $opetor . " (" . $region . ") and sector " . $opetor1 . " (" . $sector . ") and is_fx like '" . $isfx . "'  )
        ) as foo group by lbl
        ) as foo;";
} else if ($chart == "SectorWiseYTDNWWByCountChart") {
    $query = "
    with fltr as(
        select project_code,(select rname from ds002region r where r.rid=m.region) as region_name,division,
        (select sectors from ds004sectors s where s.sid=m.sector) as sector_name 
        from saca_project_master m where division=" . $devision . " and m.region " . $opetor . " (" . $region . ") and 
        m.sector " . $opetor1 . " (" . $sector . ") and is_fx like '" . $isfx . "'
        )
        select region_name as lbl,ROUND(sum(case when sector_name='Transportation' then nww_total_revenue else 0 end)/1000000,2) as vals_trans,
        ROUND(sum(case when sector_name='Water' then nww_total_revenue else 0 end)/1000000,2) as vals_water,
        ROUND(sum(case when sector_name='Renewables' then nww_total_revenue else 0 end)/1000000,2) as vals_renewable,
        ROUND(sum(case when sector_name='Urban' then nww_total_revenue else 0 end)/1000000,2) as vals_urban,
        ROUND(sum(case when sector_name='Others' then nww_total_revenue else 0 end)/1000000,2) as vals_others,
        ROUND(sum(case when sector_name='Internal' then nww_total_revenue else 0 end)/1000000,2) as vals_internal
        from saca_nww sp,fltr where fltr.project_code=sp.projectcode and 
        months <= " . $fmonth . " and year='" . $fyear . "'  group by fltr.region_name;";
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
