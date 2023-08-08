
<?php 
require 'db.php'; 
//print_r($_POST);
if(isset($_REQUEST)){ 
$Region      = isset($_REQUEST['Region']);
$Location    = isset($_REQUEST['Location']);
$project     = isset($_REQUEST['project']);

$fmonth      = isset($_REQUEST['fmonth']);

$year        = isset($_REQUEST['year']);

  if(isset($_REQUEST) && isset($_REQUEST['Region']) or isset($_REQUEST['Location']) or isset($_REQUEST['project'])){
       $eshsListQuery = "select smt.*, sp.*,

                  case when month=1 then WIP end as wip_jan,
                  case when month=2 then WIP end as wip_feb,
                  case when month=3 then WIP end as wip_mar,
                  case when month=4 then WIP end as wip_apr,
                  case when month=5 then WIP end as wip_may,
                  case when month=6 then WIP end as wip_june,
                  case when month=7 then WIP end as wip_july,
                  case when month=8 then WIP end as wip_aug,
                  case when month=9 then WIP end as wip_sep,
                  case when month=10 then WIP end as wip_oct,
                  case when month=11 then WIP end as wip_nov,
                  case when month=12 then WIP end as wip_dec,

                  case when month=1 then Debtors end as debtors_jan,
                  case when month=2 then Debtors end as debtors_feb,
                  case when month=3 then Debtors end as debtors_mar,
                  case when month=4 then Debtors end as debtors_apr,
                  case when month=5 then Debtors end as debtors_may,
                  case when month=6 then Debtors end as debtors_june,
                  case when month=7 then Debtors end as debtors_july,
                  case when month=8 then Debtors end as debtors_aug,
                  case when month=9 then Debtors end as debtors_sep,
                  case when month=10 then Debtors end as debtors_oct,
                  case when month=11 then Debtors end as debtors_nov,
                  case when month=12 then Debtors end as debtors_dec,


                  case when month=1 then Billings end as billings_jan,
                  case when month=2 then Billings end as billings_feb,
                  case when month=3 then Billings end as billings_mar,
                  case when month=4 then Billings end as billings_apr,
                  case when month=5 then Billings end as billings_may,
                  case when month=6 then Billings end as billings_june,
                  case when month=7 then Billings end as billings_july,
                  case when month=8 then Billings end as billings_aug,
                  case when month=9 then Billings end as billings_sep,
                  case when month=10 then Billings end as billings_oct,
                  case when month=11 then Billings end as billings_nov,
                  case when month=12 then Billings end as billings_dec,

                   SUM(sp.Billings)  AS Billings,
                   SUM(sp.WIP) AS WIP,
                   SUM(sp.Debtors) AS Debtors,

                   SUM(sp.Fees2)  AS LTD_Fees2,
                   SUM(sp.Reimb2) AS LTD_Reimb2,
                   SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
                   SUM(sp.Salary2) AS LTD_Salary2,
                   SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
                   SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
                   SUM(sp.Contrib2) AS LTD_Contrib2,
                   SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,

                  ifnull(sum(case when replace(debtor_Days, '>','') <= 30 then debtors end),0) as debtors_30,
                  ifnull(sum(case when replace(debtor_Days, '>','') > 30 and replace(debtor_Days, '>','') <= 90 then debtors end),0) as debtors_90, 
                  ifnull(sum(case when replace(debtor_Days, '>','') > 90 and replace(debtor_Days, '>','') <= 365 then debtors end),0) as debtors_365, 
                  ifnull(sum(case when replace(debtor_Days, '>','') > 365 then debtors end),0) as debtors_1000,


                  ifnull(sum(case when replace(WIP_Days, '>','') <= 30 then wip end),0) as wip_30,
                  ifnull(sum(case when replace(WIP_Days, '>','') > 30 and replace(WIP_Days, '>','') <= 90 then wip end),0) as wip_90, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 90 and replace(WIP_Days, '>','') <= 365 then wip end),0) as wip_365, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 365 then wip end),0) as wip_1000,


                   ifnull(sum(case when replace(Lockup_Days, '>','') <= 30 then lockup end),0) as lockup_30,
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 30 and replace(Lockup_Days, '>','') <= 90 then lockup end),0) as lockup_90, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 90 and replace(Lockup_Days, '>','') <= 365 then lockup end),0) as lockup_365, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 365 then lockup end),0) as lockup_1000

                  FROM saca_project_master as smt Inner Join saca_profitability as sp
                  ON smt.project_code = sp.project Where 1 ";
                  if(!empty($Region)){
                         $eshsListQuery .= " AND sp.Region = '".$Region."' ";
                  }
                  if(!empty($Location)){
                         $eshsListQuery .= " AND sp.Location = '".$Location."' ";
                  }
                   if(!empty($project)){
                       
                         $eshsListQuery .= " AND sp.project = '".$project."' ";
                  }
     $eshsListResult = mysqli_query($con,$eshsListQuery);
     $eshsListCount  = mysqli_num_rows($eshsListResult);
     $filterArrayData = array();
     $singleProjectdata = array();
  if($eshsListCount > 0){ 
        $counterListLoop   = 0;
       while($singleProjectRes = mysqli_fetch_assoc($eshsListResult)){
     
        $singleProjectdata['Billings'] = $singleProjectRes['Billings'];
        $singleProjectdata['WIP'] = $singleProjectRes['WIP'];
        $singleProjectdata['Debtors'] = $singleProjectRes['Debtors'];
       

        $singleProjectdata['wip_jan'] = $singleProjectRes['wip_jan'];
        $singleProjectdata['wip_feb'] = $singleProjectRes['wip_feb'];
        $singleProjectdata['wip_mar'] = $singleProjectRes['wip_mar'];
        $singleProjectdata['wip_apr'] = $singleProjectRes['wip_apr'];
        $singleProjectdata['wip_may'] = $singleProjectRes['wip_may'];
        $singleProjectdata['wip_june'] =  $singleProjectRes['wip_june'];
        $singleProjectdata['wip_july'] =  $singleProjectRes['wip_july'];
        $singleProjectdata['wip_aug'] =  $singleProjectRes['wip_aug'];
        $singleProjectdata['wip_sep'] =  $singleProjectRes['wip_sep'];
        $singleProjectdata['wip_oct'] =  $singleProjectRes['wip_oct'];
        $singleProjectdata['wip_nov'] =  $singleProjectRes['wip_nov'];
        $singleProjectdata['wip_dec'] =  $singleProjectRes['wip_dec'];

        $singleProjectdata['debtors_jan'] = $singleProjectRes['debtors_jan'];
        $singleProjectdata['debtors_feb'] = $singleProjectRes['debtors_feb'];
        $singleProjectdata['debtors_mar'] = $singleProjectRes['debtors_mar'];
        $singleProjectdata['debtors_apr'] = $singleProjectRes['debtors_apr'];
        $singleProjectdata['debtors_may'] = $singleProjectRes['debtors_may'];
        $singleProjectdata['debtors_june'] = $singleProjectRes['debtors_june'];
        $singleProjectdata['debtors_july'] = $singleProjectRes['debtors_july'];
        $singleProjectdata['debtors_aug'] = $singleProjectRes['debtors_aug'];
        $singleProjectdata['debtors_sep'] = $singleProjectRes['debtors_sep'];
        $singleProjectdata['debtors_oct'] = $singleProjectRes['debtors_oct'];
        $singleProjectdata['debtors_nov'] = $singleProjectRes['debtors_nov'];
        $singleProjectdata['debtors_dec'] = $singleProjectRes['debtors_dec'];

        $singleProjectdata['billings_jan'] = $singleProjectRes['billings_jan'];
        $singleProjectdata['billings_feb'] = $singleProjectRes['billings_feb'];
        $singleProjectdata['billings_mar'] = $singleProjectRes['billings_mar'];
        $singleProjectdata['billings_apr'] = $singleProjectRes['billings_apr'];
        $singleProjectdata['billings_may'] = $singleProjectRes['billings_may'];
        $singleProjectdata['billings_june'] = $singleProjectRes['billings_june'];
        $singleProjectdata['billings_july'] = $singleProjectRes['billings_july'];
        $singleProjectdata['billings_aug'] = $singleProjectRes['billings_aug'];
        $singleProjectdata['billings_sep'] = $singleProjectRes['billings_sep'];
        $singleProjectdata['billings_oct'] = $singleProjectRes['billings_oct'];
        $singleProjectdata['billings_nov'] = $singleProjectRes['billings_nov'];
        $singleProjectdata['billings_dec'] = $singleProjectRes['billings_dec'];

        $singleProjectdata['debtors_30'] = $singleProjectRes['debtors_30'];
        $singleProjectdata['debtors_90'] = $singleProjectRes['debtors_90'];
        $singleProjectdata['debtors_365'] = $singleProjectRes['debtors_365'];
        $singleProjectdata['debtors_1000'] = $singleProjectRes['debtors_1000'];

         $singleProjectdata['wip_30'] = $singleProjectRes['wip_30'];
        $singleProjectdata['wip_90'] = $singleProjectRes['wip_90'];
        $singleProjectdata['wip_365'] = $singleProjectRes['wip_365'];
        $singleProjectdata['wip_1000'] = $singleProjectRes['wip_1000'];

           $singleProjectdata['lockup_30'] = $singleProjectRes['lockup_30'];
        $singleProjectdata['lockup_90'] = $singleProjectRes['lockup_90'];
        $singleProjectdata['lockup_365'] = $singleProjectRes['lockup_365'];
        $singleProjectdata['lockup_1000'] = $singleProjectRes['lockup_1000'];

        $singleProjectdata['Fees_LTD'] = $singleProjectRes['Fees2'];
        $singleProjectdata['Reimb_LTD'] = $singleProjectRes['Reimb2'];
        $singleProjectdata['Total_Rev_LTD'] = $singleProjectRes['Total_Rev2'];
        $singleProjectdata['Salary_LTD'] = $singleProjectRes['Salary2'];
        $singleProjectdata['Reim_Cost_LTD'] = $singleProjectRes['Reim_Cost2'];
        $singleProjectdata['Total_Cost_LTD'] = $singleProjectRes['Total_Cost2'];
        $singleProjectdata['Contrib_LTD'] = $singleProjectRes['Contrib2'];
        $singleProjectdata['Cont_Margin_LTD'] = $singleProjectRes['Cont_Margin2'];

        $singleProjectdata['project'] = $singleProjectRes['project'];
        $singleProjectdata['Project_Description'] = $singleProjectRes['Project_Description'];


         $counterListLoop++;
       } 
    }
    else{
      header('location:bili_wip_deb_graph.php?msg=1');
    }

  }
  ###### search project by field
}  
//print_r($singleProjectdata['Cont_Margin_LTD']);exit;
####get sum of whole project in saca###
     // echo $totalProjectQuery  = "SELECT 
     //                         smt.*,
     //                        (select SUM(sp.WIP) where month = '1') as wip_jan,
     //                        (select SUM(sp.WIP) where month = '2') as wip_feb,
     //                        (select SUM(sp.WIP) where month = '3') as wip_mar,
     //                        (select SUM(sp.WIP) where month = '4') as wip_apr,
     //                        (select SUM(sp.WIP) where month = '5') as wip_may,
     //                        (select SUM(sp.WIP) where month = '6') as wip_june,
     //                        (select SUM(sp.WIP) where month = '7') as wip_july,
     //                        (select SUM(sp.WIP) where month = '8') as wip_aug,
     //                        (select SUM(sp.WIP) where month = '9') as wip_sep,
     //                        (select SUM(sp.WIP) where month = '10') as wip_oct,
     //                        (select SUM(sp.WIP) where month = '11') as wip_nov,
     //                        (select SUM(sp.WIP) where month = '12') as wip_dec,

     //                        (select SUM(sp.Debtors) where month = '1') as debtors_jan,
     //                        (select SUM(sp.Debtors) where month = '2') as debtors_feb,
     //                        (select SUM(sp.Debtors) where month = '3') as debtors_mar,
     //                        (select SUM(sp.Debtors) where month = '4') as debtors_apr,
     //                        (select SUM(sp.Debtors) where month = '5') as debtors_may,
     //                        (select SUM(sp.Debtors) where month = '6') as debtors_june,
     //                        (select SUM(sp.Debtors) where month = '7') as debtors_july,
     //                        (select SUM(sp.Debtors) where month = '8') as debtors_aug,
     //                        (select SUM(sp.Debtors) where month = '9') as debtors_sep,
     //                        (select SUM(sp.Debtors) where month = '10') as debtors_oct,
     //                        (select SUM(sp.Debtors) where month = '11') as debtors_nov,
     //                        (select SUM(sp.Debtors) where month = '12') as debtors_dec,

     //                        (select SUM(sp.Billings) where month = '1') as billings_jan,
     //                        (select SUM(sp.Billings) where month = '2') as billings_feb,
     //                        (select SUM(sp.Billings) where month = '3') as billings_mar,
     //                        (select SUM(sp.Billings) where month = '4') as billings_apr,
     //                        (select SUM(sp.Billings) where month = '5') as billings_may,
     //                        (select SUM(sp.Billings) where month = '6') as billings_june,
     //                        (select SUM(sp.Billings) where month = '7') as billings_july,
     //                        (select SUM(sp.Billings) where month = '8') as billings_aug,
     //                        (select SUM(sp.Billings) where month = '9') as billings_sep,
     //                        (select SUM(sp.Billings) where month = '10') as billings_oct,
     //                        (select SUM(sp.Billings) where month = '11') as billings_nov,
     //                        (select SUM(sp.Billings) where month = '12') as billings_dec,
   
     //                       SUM(sp.Billings)  AS Billings,
     //                       SUM(sp.WIP) AS WIP,
     //                       SUM(sp.Debtors) AS Debtors,
                           

     //                       SUM(sp.Fees1)  AS YTD_Fees1,
     //                       SUM(sp.Reimb1) AS YTD_Reimb1,
     //                       SUM(sp.Total_Rev1) AS YTD_Total_Rev1,
     //                       SUM(sp.Salary1) AS YTD_Salary1,
     //                       SUM(sp.Reim_Cost1) AS YTD_Reim_Cost1,
     //                       SUM(sp.Total_Cost1) AS YTD_Total_Cost1,
     //                       SUM(sp.Contrib1) AS YTD_Contrib1,
     //                       SUM(sp.Cont_Margin1) AS YTD_Cont_Margin1,


     //                        SUM(sp.Fees2)  AS LTD_Fees2,
     //                       SUM(sp.Reimb2) AS LTD_Reimb2,
     //                       SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
     //                       SUM(sp.Salary2) AS LTD_Salary2,
     //                       SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
     //                       SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
     //                       SUM(sp.Contrib2) AS LTD_Contrib2,
     //                       SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2

     //                      FROM saca_project_master as smt

     //                      Inner Join saca_profitability as sp

     //                      ON smt.project_code = sp.project
                         
     //                       Where 1 ";

      $totalProjectQuery = " select smt.*, sp.*,

          SUM(case when month=1 then WIP end) as wip_jan,
          SUM(case when month=2 then WIP end) as wip_feb,
          SUM(case when month=3 then WIP end) as wip_mar,
          SUM(case when month=4 then WIP end) as wip_apr,
          SUM(case when month=5 then WIP end) as wip_may,
          SUM(case when month=6 then WIP end) as wip_june,
          SUM(case when month=7 then WIP end) as wip_july,
          SUM(case when month=8 then WIP end) as wip_aug,
          SUM(case when month=9 then WIP end) as wip_sep,
          SUM(case when month=10 then WIP end) as wip_oct,
          SUM(case when month=11 then WIP end) as wip_nov,
          SUM(case when month=12 then WIP end) as wip_dec,

          SUM(case when month=1 then Debtors end) as debtors_jan,
          SUM(case when month=2 then Debtors end) as debtors_feb,
          SUM(case when month=3 then Debtors end) as debtors_mar,
          SUM(case when month=4 then Debtors end) as debtors_apr,
          SUM(case when month=5 then Debtors end) as debtors_may,
          SUM(case when month=6 then Debtors end) as debtors_june,
          SUM(case when month=7 then Debtors end) as debtors_july,
          SUM(case when month=8 then Debtors end) as debtors_aug,
          SUM(case when month=9 then Debtors end) as debtors_sep,
          SUM(case when month=10 then Debtors end) as debtors_oct,
          SUM(case when month=11 then Debtors end) as debtors_nov,
          SUM(case when month=12 then Debtors end) as debtors_dec,


          SUM(case when month=1 then Billings end) as billings_jan,
          SUM(case when month=2 then Billings end) as billings_feb,
          SUM(case when month=3 then Billings end) as billings_mar,
          SUM(case when month=4 then Billings end) as billings_apr,
          SUM(case when month=5 then Billings end) as billings_may,
          SUM(case when month=6 then Billings end) as billings_june,
          SUM(case when month=7 then Billings end) as billings_july,
          SUM(case when month=8 then Billings end) as billings_aug,
          SUM(case when month=9 then Billings end) as billings_sep,
          SUM(case when month=10 then Billings end) as billings_oct,
          SUM(case when month=11 then Billings end) as billings_nov,
          SUM(case when month=12 then Billings end) as billings_dec,

          SUM(sp.Billings)  AS Billings,
           SUM(sp.WIP) AS WIP,
           SUM(sp.Debtors) AS Debtors,
           

           SUM(sp.Fees1)  AS YTD_Fees1,
           SUM(sp.Reimb1) AS YTD_Reimb1,
           SUM(sp.Total_Rev1) AS YTD_Total_Rev1,
           SUM(sp.Salary1) AS YTD_Salary1,
           SUM(sp.Reim_Cost1) AS YTD_Reim_Cost1,
           SUM(sp.Total_Cost1) AS YTD_Total_Cost1,
           SUM(sp.Contrib1) AS YTD_Contrib1,
           SUM(sp.Cont_Margin1) AS YTD_Cont_Margin1,


            SUM(sp.Fees2)  AS LTD_Fees2,
           SUM(sp.Reimb2) AS LTD_Reimb2,
           SUM(sp.Total_Rev2) AS LTD_Total_Rev2,
           SUM(sp.Salary2) AS LTD_Salary2,
           SUM(sp.Reim_Cost2) AS LTD_Reim_Cost2,
           SUM(sp.Total_Cost2) AS LTD_Total_Cost2,
           SUM(sp.Contrib2) AS LTD_Contrib2,
           SUM(sp.Cont_Margin2) AS LTD_Cont_Margin2,

          ifnull(sum(case when replace(debtor_Days, '>','') <= 30 then debtors end),0) as debtors_30,
          ifnull(sum(case when replace(debtor_Days, '>','') > 30 and replace(debtor_Days, '>','') <= 90 then debtors end),0) as debtors_90, 
          ifnull(sum(case when replace(debtor_Days, '>','') > 90 and replace(debtor_Days, '>','') <= 365 then debtors end),0) as debtors_365, 
          ifnull(sum(case when replace(debtor_Days, '>','') > 365 then debtors end),0) as debtors_1000,

           ifnull(sum(case when replace(WIP_Days, '>','') <= 30 then wip end),0) as wip_30,
                  ifnull(sum(case when replace(WIP_Days, '>','') > 30 and replace(WIP_Days, '>','') <= 90 then wip end),0) as wip_90, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 90 and replace(WIP_Days, '>','') <= 365 then wip end),0) as wip_365, 
                  ifnull(sum(case when replace(WIP_Days, '>','') > 365 then wip end),0) as wip_1000,

             ifnull(sum(case when replace(Lockup_Days, '>','') <= 30 then lockup end),0) as lockup_30,
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 30 and replace(Lockup_Days, '>','') <= 90 then lockup end),0) as lockup_90, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 90 and replace(Lockup_Days, '>','') <= 365 then lockup end),0) as lockup_365, 
                  ifnull(sum(case when replace(Lockup_Days, '>','') > 365 then lockup end),0) as lockup_1000       

          FROM saca_project_master as smt Inner Join saca_profitability as sp
          ON smt.project_code = sp.project Where 1 ";
                           
                
     $totalProjectResult = mysqli_query($con,$totalProjectQuery);
     $totalProjectCount  = mysqli_num_rows($totalProjectResult);
   
     $totalProjectdata = array();
    if($totalProjectCount > 0){ 
        $counterListLoop   = 0;
       while($totalProjectRes = mysqli_fetch_assoc($totalProjectResult)){
        $totalProjectdata['Billings'] = $totalProjectRes['Billings'];
        $totalProjectdata['WIP'] = $totalProjectRes['WIP'];
        $totalProjectdata['Debtors'] = $totalProjectRes['Debtors'];
       

        $totalProjectdata['wip_jan'] = $totalProjectRes['wip_jan'];
        $totalProjectdata['wip_feb'] = $totalProjectRes['wip_feb'];
        $totalProjectdata['wip_mar'] = $totalProjectRes['wip_mar'];
        $totalProjectdata['wip_apr'] = $totalProjectRes['wip_apr'];
        $totalProjectdata['wip_may'] = $totalProjectRes['wip_may'];
        $totalProjectdata['wip_june'] =  $totalProjectRes['wip_june'];
        $totalProjectdata['wip_july'] =  $totalProjectRes['wip_july'];
        $totalProjectdata['wip_aug'] =  $totalProjectRes['wip_aug'];
        $totalProjectdata['wip_sep'] = $totalProjectRes['wip_sep'];
        $totalProjectdata['wip_oct'] = $totalProjectRes['wip_oct'];
        $totalProjectdata['wip_nov'] = $totalProjectRes['wip_nov'];
        $totalProjectdata['wip_dec'] = $totalProjectRes['wip_dec'];

          $totalProjectdata['debtors_jan'] = $totalProjectRes['debtors_jan'];
        $totalProjectdata['debtors_feb'] = $totalProjectRes['debtors_feb'];
        $totalProjectdata['debtors_mar'] = $totalProjectRes['debtors_mar'];
        $totalProjectdata['debtors_apr'] = $totalProjectRes['debtors_apr'];
        $totalProjectdata['debtors_may'] = $totalProjectRes['debtors_may'];
        $totalProjectdata['debtors_june'] =  $totalProjectRes['debtors_june'];
        $totalProjectdata['debtors_july'] =  $totalProjectRes['debtors_july'];
        $totalProjectdata['debtors_aug'] =  $totalProjectRes['debtors_aug'];
        $totalProjectdata['debtors_sep'] = $totalProjectRes['debtors_sep'];
        $totalProjectdata['debtors_oct'] = $totalProjectRes['debtors_oct'];
        $totalProjectdata['debtors_nov'] = $totalProjectRes['debtors_nov'];
        $totalProjectdata['debtors_dec'] = $totalProjectRes['debtors_dec'];

          $totalProjectdata['billings_jan'] = $totalProjectRes['billings_jan'];
        $totalProjectdata['billings_feb'] = $totalProjectRes['billings_feb'];
        $totalProjectdata['billings_mar'] = $totalProjectRes['billings_mar'];
        $totalProjectdata['billings_apr'] = $totalProjectRes['billings_apr'];
        $totalProjectdata['billings_may'] = $totalProjectRes['billings_may'];
        $totalProjectdata['billings_june'] =  $totalProjectRes['billings_june'];
        $totalProjectdata['billings_july'] =  $totalProjectRes['billings_july'];
        $totalProjectdata['billings_aug'] =  $totalProjectRes['billings_aug'];
        $totalProjectdata['billings_sep'] = $totalProjectRes['billings_sep'];
        $totalProjectdata['billings_oct'] = $totalProjectRes['billings_oct'];
        $totalProjectdata['billings_nov'] = $totalProjectRes['billings_nov'];
        $totalProjectdata['billings_dec'] = $totalProjectRes['billings_dec'];

         $totalProjectdata['debtors_30'] = $totalProjectRes['debtors_30'];
        $totalProjectdata['debtors_90'] = $totalProjectRes['debtors_90'];
        $totalProjectdata['debtors_365'] = $totalProjectRes['debtors_365'];
        $totalProjectdata['debtors_1000'] = $totalProjectRes['debtors_1000'];

          $totalProjectdata['wip_30'] = $totalProjectRes['wip_30'];
        $totalProjectdata['wip_90'] = $totalProjectRes['wip_90'];
        $totalProjectdata['wip_365'] = $totalProjectRes['wip_365'];
        $totalProjectdata['wip_1000'] = $totalProjectRes['wip_1000'];

         $totalProjectdata['lockup_30'] = $totalProjectRes['lockup_30'];
        $totalProjectdata['lockup_90'] = $totalProjectRes['lockup_90'];
        $totalProjectdata['lockup_365'] = $totalProjectRes['lockup_365'];
        $totalProjectdata['lockup_1000'] = $totalProjectRes['lockup_1000'];
     

        $totalProjectdata['sum_Fees_LTD'] = $totalProjectRes['LTD_Fees2'];
        $totalProjectdata['sum_Reimb_LTD'] = $totalProjectRes['LTD_Reimb2'];
        $totalProjectdata['sum_Total_Rev_LTD'] = $totalProjectRes['LTD_Total_Rev2'];
        $totalProjectdata['sum_Salary_LTD'] = $totalProjectRes['LTD_Salary2'];
        $totalProjectdata['sum_Reim_Cost_LTD'] = $totalProjectRes['LTD_Reim_Cost2'];
        $totalProjectdata['sum_Total_Cost_LTD'] =  $totalProjectRes['LTD_Total_Cost2'];
        $totalProjectdata['sum_Contrib_LTD'] =  $totalProjectRes['LTD_Contrib2'];
        $totalProjectdata['sum_Cont_Margin_LTD'] =  $totalProjectRes['LTD_Cont_Margin2'];
       
         $counterListLoop++;
         //echo $totalProjectdata['sum_Cont_Margin_LTD'];
       } 
    }
    ####get sum of whole project inside saca###
 ?>
 <?php //print_r($totalProjectdata['sum_Cont_Margin_LTD']);?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Billings, WIP & Lockup Analysis</title>
  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../../sacadb/theme/plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../../sacadb/theme/dist/css/adminlte.min.css">
   <script type="text/javascript" src="https://code.jquery.com/jquery-1.7.1.min.js"></script>
</head>
<style type="text/css">
    .card-success:not(.card-outline)>.card-header {
    background-color: #79a9ce; 
    }
    .card-danger:not(.card-outline)>.card-header {
    background-color: #1d3a67;

    }
      #filter-sec{
      margin-left:1em;
      margin-right:1em;
    }
    #result-sec{
      margin-left:1em;
      margin-right:1em;
    }
    </style>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Navbar -->
<?php 

require 'partials/header.php'; ?> 
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <?php require 'partials/sidebar.php'; ?> 

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <!-- <h1><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'];}else{echo "";}?>
            </h1> -->
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
             <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">ChartJS</li> -->
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

     <div class="card card-danger" id="filter-sec">
      <!-- <div class="card-header">
        <h3 class="card-title">Different Width</h3>
      </div> -->
      <div class="card-body">
        <form method="post" id="form-id" action="">
          <div class="row">
              <div class="col-2"> 
                 <select class="custom-select" name="Region" id="Region">
                   <option value="">Select Region</option>
                   <?php if($con){
                       echo $incListQuery  = "SELECT *
                                         FROM saca_profitability GROUP BY Region
                                        ";   
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['Region']; ?>"><?php echo $incListRes['Region']; ?></option>
                         <?php
                     }}?>
                   </select>
              </div>
              <div class="col-2">
                <select class="custom-select" name="Location" id="Location">
                    <option value="">Select Region first</option>
                </select>
              </div>
              <div class="col-2">
                <select class="custom-select" name="project" id="project">
                  <option value="">Select Location first</option>
                </select>
              </div>
              <script>
                $(document).ready(function(){
                    $('#Region').on('change', function(){
                        var RegionID = $(this).val();
                        //alert(RegionID);
                       
                      
                        if(RegionID){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'Region_id='+RegionID,
                                success:function(html){
                                    $('#Location').html(html);
                                    $('#project').html('<option value="">Select project first</option>'); 
                                }
                            }); 
                        }else{
                            $('#Location').html('<option value="">Select Region first</option>');
                            $('#project').html('<option value="">Select Location first</option>'); 
                        }
                    });
                    
                    $('#Location').on('change', function(){
                        var LocationID = $(this).val();
                        if(LocationID){
                            $.ajax({
                                type:'POST',
                                url:'ajaxData.php',
                                data:'Location_id='+LocationID,
                                success:function(html){
                                    $('#project').html(html);
                                }
                            }); 
                        }else{
                            $('#project').html('<option value="">Select Location first</option>'); 
                        }
                    });
                });
                </script>
               <div class="col-1">
                <button type="button" name="search" id="search" onclick="document.getElementById('form-id').submit();" class="btn btn-success" onclick="docume">SEARCH</button>
              </div>
               <div class="col-2" style="text-align:right;">
                  <label style="text-align:right;">Data Update Month: </label>
              </div>
              <div class="col-1.5">
                <select class="custom-select" name="fmonth">
                  <option value="">Month</option>
                  <?php 
                   if($con){
                       echo $incListQuery  = "SELECT month
                                  FROM saca_profitability  GROUP BY month order by month DESC ";
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['month'].$i; ?>" 
                            <?php if($incListCount == $i){ echo "selected";} ?>
                            ><?php echo $incListRes['month']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
              <div class="col-1.5">
                   <select class="custom-select" name="year">
                  <option value="">Month</option>
                  <?php 
                   if($con){
                        $incListQuery  = "SELECT year
                           FROM saca_profitability  GROUP BY year order by year ASC ";
                                           
                    }          
                    $incListResult = mysqli_query($con,$incListQuery);
                    $incListCount  = mysqli_num_rows($incListResult);
                    $resArrayData  = array();
                    if($incListCount > 0){
                      $i= 1;
                        while($incListRes = mysqli_fetch_assoc($incListResult)){?>
                           <option value="<?php echo $incListRes['year'].$i; ?>" 
                            <?php if($incListCount == $i){ echo "selected";} ?>
                            ><?php echo $incListRes['year']; ?></option>
                         <?php $i ++;
                        } 
                    }
                    ?>
                 </select>
              </div>
             
          </div>
        </form>
      </div>
      <!-- /.card-body -->
    </div>
    
    <div class="card card-danger" id="result-sec">
      
      <?php if(isset($_REQUEST['msg']) && $_REQUEST['msg'] == '1'){ ?>
    <div class="card-body" style="color: red; text-align: center;">
      
   
        <div class="row">
            <div class="col-12"> 
               <span  style="color: red; text-align: right;font-size:1.25em"><?php echo "Record Not Found"; ?></span>
            </div>
         </div>   
    </div>
      <?php } ?>
    
  </div>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-6">
        
        
            <!-- BAR CHART -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Billings, WIP & Debtors</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="Fee-MTD" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
            <!-- /.card -->
           
            <!-- /.card -->

          </div>
          <!-- /.col (LEFT) -->
          <div class="col-md-6">
          
             <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">WIP, Billings & Debtors Trands</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas id="Trands" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- BAR CHART -->
           
          </div>
          <!-- /.col (RIGHT) -->

                <!-- /.col (LEFT) -->



          <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Debtors 30 90 > 365</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="debtors_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>

           <div class="col-md-4">
            <div class="card card-danger">
              <div class="card-header">
                <h3 class="card-title">WIP 30 90 > 365</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="wip_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>

           <div class="col-md-4">
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Lockup 30 90 > 365</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <div class="chart">
                  <canvas id="lockup_days" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
              
            </div>
           
          </div>




        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Billings, WIP & Debtors";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoBillings, WIP & Debtors';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Billings</th>
                      <th>WIP</th>
                      <th>Debtors</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['Billings']; ?></td>
                        <td><?php echo $totalProjectdata['WIP']; ?></td>
                        <td><?php echo $totalProjectdata['Debtors']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Billings</th>
                      <th>WIP</th>
                      <th>Debtors</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['Billings']; ?></td>
                        <td><?php echo $singleProjectdata['WIP']; ?></td>
                        <td><?php echo $singleProjectdata['Debtors']; ?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <!--YTD-->
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoWip Trands";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoWip Trands';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['wip_jan']; ?></td>
                        <td><?php echo $totalProjectdata['wip_feb']; ?></td>
                        <td><?php echo $totalProjectdata['wip_mar']; ?></td>
                        <td><?php echo $totalProjectdata['wip_apr'];?></td>
                        <td><?php echo $totalProjectdata['wip_may']?></td>
                        <td><?php echo $totalProjectdata['wip_june']; ?></td>
                        <td><?php echo $totalProjectdata['wip_july']; ?></td>
                        <td><?php echo $totalProjectdata['wip_aug']; ?></td>
                         <td><?php echo $totalProjectdata['wip_sep']; ?></td>
                         <td><?php echo $totalProjectdata['wip_oct']; ?></td>
                         <td><?php echo $totalProjectdata['wip_nov']; ?></td>
                         <td><?php echo $totalProjectdata['wip_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                      <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['wip_jan']; ?></td>
                        <td><?php echo $singleProjectdata['wip_feb']; ?></td>
                        <td><?php echo $singleProjectdata['wip_mar']; ?></td>
                        <td><?php echo $singleProjectdata['wip_apr'];?></td>
                        <td><?php echo $singleProjectdata['wip_may']?></td>
                        <td><?php echo $singleProjectdata['wip_june']; ?></td>
                        <td><?php echo $singleProjectdata['wip_july']; ?></td>
                        <td><?php echo $singleProjectdata['wip_aug']; ?></td>
                         <td><?php echo $singleProjectdata['wip_sep']; ?></td>
                         <td><?php echo $singleProjectdata['wip_oct']; ?></td>
                         <td><?php echo $singleProjectdata['wip_nov']; ?></td>
                         <td><?php echo $singleProjectdata['wip_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

         <div class="row">
           <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoBillings Trands";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoBillings Trands';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['billings_jan']; ?></td>
                        <td><?php echo $totalProjectdata['billings_feb']; ?></td>
                        <td><?php echo $totalProjectdata['billings_mar']; ?></td>
                        <td><?php echo $totalProjectdata['billings_apr'];?></td>
                        <td><?php echo $totalProjectdata['billings_may']?></td>
                        <td><?php echo $totalProjectdata['billings_june']; ?></td>
                        <td><?php echo $totalProjectdata['billings_july']; ?></td>
                        <td><?php echo $totalProjectdata['billings_aug']; ?></td>
                         <td><?php echo $totalProjectdata['billings_sep']; ?></td>
                         <td><?php echo $totalProjectdata['billings_oct']; ?></td>
                         <td><?php echo $totalProjectdata['billings_nov']; ?></td>
                         <td><?php echo $totalProjectdata['billings_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                      <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['billings_jan']; ?></td>
                        <td><?php echo $singleProjectdata['billings_feb']; ?></td>
                        <td><?php echo $singleProjectdata['billings_mar']; ?></td>
                        <td><?php echo $singleProjectdata['billings_apr'];?></td>
                        <td><?php echo $singleProjectdata['billings_may']?></td>
                        <td><?php echo $singleProjectdata['billings_june']; ?></td>
                        <td><?php echo $singleProjectdata['billings_july']; ?></td>
                        <td><?php echo $singleProjectdata['billings_aug']; ?></td>
                         <td><?php echo $singleProjectdata['billings_sep']; ?></td>
                         <td><?php echo $singleProjectdata['billings_oct']; ?></td>
                         <td><?php echo $singleProjectdata['billings_nov']; ?></td>
                         <td><?php echo $singleProjectdata['billings_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>

          <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquoDebtors Trands";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoDebtors Trands';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['debtors_jan']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_feb']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_mar']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_apr'];?></td>
                        <td><?php echo $totalProjectdata['debtors_may']?></td>
                        <td><?php echo $totalProjectdata['debtors_june']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_july']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_aug']; ?></td>
                         <td><?php echo $totalProjectdata['debtors_sep']; ?></td>
                         <td><?php echo $totalProjectdata['debtors_oct']; ?></td>
                         <td><?php echo $totalProjectdata['debtors_nov']; ?></td>
                         <td><?php echo $totalProjectdata['debtors_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                      <tr>
                      <th>Jan</th>
                      <th>Feb</th>
                      <th>Mar</th>
                      <th>Apr</th>
                      <th>May</th>
                      <th>June</th>
                      <th>July</th>
                      <th>Aug</th>
                      <th>Sep</th>
                      <th>Oct</th>
                      <th>Nov</th>
                      <th>Dec</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $singleProjectdata['debtors_jan']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_feb']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_mar']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_apr'];?></td>
                        <td><?php echo $singleProjectdata['debtors_may']?></td>
                        <td><?php echo $singleProjectdata['debtors_june']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_july']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_aug']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_sep']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_oct']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_nov']; ?></td>
                         <td><?php echo $singleProjectdata['debtors_dec']; ?></td>   
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>


         <div class="row">
           <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Debtors 30, 90 > 365";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoDebtors 30, 90 > 365';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Debtors 30</th>
                      <th>Debtors 90</th>
                      <th>Debtors 365</th>
                      <th>Debtors 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['debtors_30']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_90']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_365']; ?></td>
                        <td><?php echo $totalProjectdata['debtors_1000'];?></td>
                       
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Debtors 30</th>
                      <th>Debtors 90</th>
                      <th>Debtors 365</th>
                      <th>Debtors 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['debtors_30']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_90']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_365']; ?></td>
                        <td><?php echo $singleProjectdata['debtors_1000'];?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
        </div>


        <div class="row">
           <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo WIP 30, 90 > 365";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoWIP 30, 90 > 365';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>WIP 30</th>
                      <th>WIP 90</th>
                      <th>WIP 365</th>
                      <th>WIP 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['wip_30']; ?></td>
                        <td><?php echo $totalProjectdata['wip_90']; ?></td>
                        <td><?php echo $totalProjectdata['wip_365']; ?></td>
                        <td><?php echo $totalProjectdata['wip_1000'];?></td>
                       
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>WIP 30</th>
                      <th>WIP 90</th>
                      <th>WIP 365</th>
                      <th>WIP 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['wip_30']; ?></td>
                        <td><?php echo $singleProjectdata['wip_90']; ?></td>
                        <td><?php echo $singleProjectdata['wip_365']; ?></td>
                        <td><?php echo $singleProjectdata['wip_1000'];?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
        </div>

         <div class="row">
           <div class="col-12">
            <div class="card">
              <div class="card-header" style="background-color: #79a9ce; color: white; ">
                <h3 class="card-title"><bold><?php if(isset($totalProjectdata) && empty($singleProjectdata)){ echo "SACA DIVISION &raquo Lockup 30, 90 > 365";}if(isset($singleProjectdata)){ echo $singleProjectdata['project']." - ".$singleProjectdata['Project_Description'].'&raquoLockup 30, 90 > 365';}?></bold></h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <?php if(isset($totalProjectdata) && empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Lockup 30</th>
                      <th>Lockup 90</th>
                      <th>Lockup 365</th>
                      <th>Lockup 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td><?php echo $totalProjectdata['lockup_30']; ?></td>
                        <td><?php echo $totalProjectdata['lockup_90']; ?></td>
                        <td><?php echo $totalProjectdata['lockup_365']; ?></td>
                        <td><?php echo $totalProjectdata['lockup_1000'];?></td>
                       
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>
              <?php if(!empty($singleProjectdata)){?>
              <div class="card-body table-responsive p-0">
                <table class="table table-head-fixed text-nowrap">
                  <thead>
                    <tr>
                      <th>Lockup 30</th>
                      <th>Lockup 90</th>
                      <th>Lockup 365</th>
                      <th>Lockup 1000</th>
                    </tr>
                  </thead>
                  <tbody>
                     <tr>
                          <td><?php echo $singleProjectdata['lockup_30']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_90']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_365']; ?></td>
                        <td><?php echo $singleProjectdata['lockup_1000'];?></td>
                      </tr>
                  </tbody>
                </table>
              </div>
              <?php } ?>

              <!--YTD-->

              <!-- /.card-body -->
            </div>
            <!-- /.card -->
           </div>
        </div>



        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
   
  <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b></b> 
    </div>
    <strong><a href="https://adminlte.io"></a></strong> 
  </footer>
  <!-- <footer class="main-footer">
    <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div>
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
  </footer> -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Add Content Here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="../../sacadb/theme/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../sacadb/theme/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="../../sacadb/theme/plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE App -->
<script src="../../sacadb/theme/dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="../../sacadb/theme/dist/js/demo.js"></script> -->
<!-- Page specific script -->

<script type="text/javascript">
  

$(function () {
  'use strict'

  var ticksStyle = {
    fontColor: '#495057',
    fontStyle: 'bold'
  }

  var mode = 'index'
  var intersect = true
////////////////////////////////////////////////////////
  var $salesChart = $('#Fee-MTD')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Billings', 'WIP', 'Debtors'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['Billings']; ?>,
                 <?php echo $totalProjectdata['WIP']; ?>, 
                 
                 <?php echo $totalProjectdata['Debtors']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['Billings'] ; ?>,
                 <?php  echo $singleProjectdata['WIP']; ?>,
               
                  <?php  echo $singleProjectdata['Debtors']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })


  
////////////////////////////////////////////////////////
  var $salesChart = $('#debtors_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['Debtors 30', 'Debtors 90', 'Debtors 365','Debtors 1000'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['debtors_30']; ?>,
                 <?php echo $totalProjectdata['debtors_90']; ?>, 
                  <?php echo $totalProjectdata['debtors_365']; ?>,
                 
                 <?php echo $totalProjectdata['debtors_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['debtors_30'] ; ?>,
                 <?php  echo $singleProjectdata['debtors_90']; ?>,
                 <?php  echo $singleProjectdata['debtors_365']; ?>,
               
                  <?php  echo $singleProjectdata['debtors_1000']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////
 var $salesChart = $('#wip_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['wip 30', 'wip 90', 'wip 365','wip 1000'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_30']; ?>,
                 <?php echo $totalProjectdata['wip_90']; ?>, 
                  <?php echo $totalProjectdata['wip_365']; ?>,
                 
                 <?php echo $totalProjectdata['wip_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['wip_30'] ; ?>,
                 <?php  echo $singleProjectdata['wip_90']; ?>,
                 <?php  echo $singleProjectdata['wip_365']; ?>,
               
                  <?php  echo $singleProjectdata['wip_1000']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////
  var $salesChart = $('#lockup_days')
  // eslint-disable-next-line no-unused-vars
  var salesChart = new Chart($salesChart, {
    type: 'bar',
    data: {
      labels: ['lockup 30', 'lockup 90', 'lockup 365','lockup 1000'],
      datasets: [
        {
          backgroundColor: '#007bff',
          borderColor: '#007bff',
          data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['lockup_30']; ?>,
                 <?php echo $totalProjectdata['lockup_90']; ?>, 
                  <?php echo $totalProjectdata['lockup_365']; ?>,
                 
                 <?php echo $totalProjectdata['lockup_1000']; 
                 }
                if(isset($singleProjectdata)){?>
             
                 <?php   echo $singleProjectdata['lockup_30'] ; ?>,
                 <?php  echo $singleProjectdata['lockup_90']; ?>,
                 <?php  echo $singleProjectdata['lockup_365']; ?>,
               
                  <?php  echo $singleProjectdata['lockup_1000']; 
                  } ?>
        ]
        },
        
      ]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,

            // Include a dollar sign in the ticks
            callback: function (value) {
              if (value >= 1000) {
                value /= 1000
                value += 'k'
              }

              return '$' + value
            }
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
/////////////////////////////////////////////////////////
////////////////////////////////////////////////////////

  var $visitorsChart = $('#Trands')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Janury', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [{
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['billings_jan']; ?>,
                 <?php echo $totalProjectdata['billings_feb']; ?>, 
                 <?php echo $totalProjectdata['billings_mar']; ?>,
                 <?php echo $totalProjectdata['billings_apr']; ?> ,
                 <?php echo $totalProjectdata['billings_may']; ?> ,
                 <?php echo $totalProjectdata['billings_june']; ?> ,
                 <?php echo $totalProjectdata['billings_july']; ?> ,
                 <?php echo $totalProjectdata['billings_aug']; ?> ,
                 <?php echo $totalProjectdata['billings_sep']; ?> ,
                 <?php echo $totalProjectdata['billings_oct']; ?> ,
                 <?php echo $totalProjectdata['billings_nov']; ?> ,
                
                 <?php echo $totalProjectdata['billings_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['billings_jan']; ?>,
                 <?php echo $singleProjectdata['billings_feb']; ?>, 
                 <?php echo $singleProjectdata['billings_mar']; ?>,
                 <?php echo $singleProjectdata['billings_apr']; ?> ,
                 <?php echo $singleProjectdata['billings_may']; ?> ,
                 <?php echo $singleProjectdata['billings_june']; ?> ,
                 <?php echo $singleProjectdata['billings_july']; ?> ,
                 <?php echo $singleProjectdata['billings_aug']; ?> ,
                 <?php echo $singleProjectdata['billings_sep']; ?> ,
                 <?php echo $singleProjectdata['billings_oct']; ?> ,
                 <?php echo $singleProjectdata['billings_nov']; ?> ,
                  <?php  echo $singleProjectdata['billings_dec']; 
                  } ?>
        ],
       
        backgroundColor: 'transparent',
        borderColor: '#ff0000',
        pointBorderColor: '#ff0000',
        pointBackgroundColor: '##ff0000',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                  <?php  echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
        backgroundColor: 'transparent',
        borderColor: '#33cc33',
        pointBorderColor: '#33cc33',
        pointBackgroundColor: '#33cc33',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      },
        {
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['debtors_jan']; ?>,
                 <?php echo $totalProjectdata['debtors_feb']; ?>, 
                 <?php echo $totalProjectdata['debtors_mar']; ?>,
                 <?php echo $totalProjectdata['debtors_apr']; ?> ,
                 <?php echo $totalProjectdata['debtors_may']; ?> ,
                 <?php echo $totalProjectdata['debtors_june']; ?> ,
                 <?php echo $totalProjectdata['debtors_july']; ?> ,
                 <?php echo $totalProjectdata['debtors_aug']; ?> ,
                 <?php echo $totalProjectdata['debtors_sep']; ?> ,
                 <?php echo $totalProjectdata['debtors_oct']; ?> ,
                 <?php echo $totalProjectdata['debtors_nov']; ?> ,
                
                 <?php echo $totalProjectdata['debtors_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['debtors_jan']; ?>,
                 <?php echo $singleProjectdata['debtors_feb']; ?>, 
                 <?php echo $singleProjectdata['debtors_mar']; ?>,
                 <?php echo $singleProjectdata['debtors_apr']; ?> ,
                 <?php echo $singleProjectdata['debtors_may']; ?> ,
                 <?php echo $singleProjectdata['debtors_june']; ?> ,
                 <?php echo $singleProjectdata['debtors_july']; ?> ,
                 <?php echo $singleProjectdata['debtors_aug']; ?> ,
                 <?php echo $singleProjectdata['debtors_sep']; ?> ,
                 <?php echo $singleProjectdata['debtors_oct']; ?> ,
                 <?php echo $singleProjectdata['debtors_nov']; ?> ,
                  <?php  echo $singleProjectdata['debtors_dec']; 
                  } ?>
        ],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
      


    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })

///////////////////////////////////////////////////////////




  
  var $visitorsChart = $('#trangdfgdgdfds')
  // eslint-disable-next-line no-unused-vars
  var visitorsChart = new Chart($visitorsChart, {
    data: {
      labels: ['Janury', 'February', 'March', 'April', 'May', 'June', 'July','August','September','October','November','December'],
      datasets: [{
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                  <?php  echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
        backgroundColor: 'transparent',
        borderColor: '#007bff',
        pointBorderColor: '#007bff',
        pointBackgroundColor: '#007bff',
        fill: false
        // pointHoverBackgroundColor: '#007bff',
        // pointHoverBorderColor    : '#007bff'
      },
      {
        type: 'line',
        data: [<?php 
                 if(isset($totalProjectdata) && empty($singleProjectdata))
                  { ?>
                 <?php  echo $totalProjectdata['wip_jan']; ?>,
                 <?php echo $totalProjectdata['wip_feb']; ?>, 
                 <?php echo $totalProjectdata['wip_mar']; ?>,
                 <?php echo $totalProjectdata['wip_apr']; ?> ,
                 <?php echo $totalProjectdata['wip_may']; ?> ,
                 <?php echo $totalProjectdata['wip_june']; ?> ,
                 <?php echo $totalProjectdata['wip_july']; ?> ,
                 <?php echo $totalProjectdata['wip_aug']; ?> ,
                 <?php echo $totalProjectdata['wip_sep']; ?> ,
                 <?php echo $totalProjectdata['wip_oct']; ?> ,
                 <?php echo $totalProjectdata['wip_nov']; ?> ,
                
                 <?php echo $totalProjectdata['wip_dec']; 
                 }
                if(isset($singleProjectdata)){?>
             
                <?php  echo $singleProjectdata['wip_jan']; ?>,
                 <?php echo $singleProjectdata['wip_feb']; ?>, 
                 <?php echo $singleProjectdata['wip_mar']; ?>,
                 <?php echo $singleProjectdata['wip_apr']; ?> ,
                 <?php echo $singleProjectdata['wip_may']; ?> ,
                 <?php echo $singleProjectdata['wip_june']; ?> ,
                 <?php echo $singleProjectdata['wip_july']; ?> ,
                 <?php echo $singleProjectdata['wip_aug']; ?> ,
                 <?php echo $singleProjectdata['wip_sep']; ?> ,
                 <?php echo $singleProjectdata['wip_oct']; ?> ,
                 <?php echo $singleProjectdata['wip_nov']; ?> ,
                 <?php echo $singleProjectdata['wip_dec']; 
                  } ?>
        ],
        backgroundColor: 'tansparent',
        borderColor: '#ced4da',
        pointBorderColor: '#ced4da',
        pointBackgroundColor: '#ced4da',
        fill: false
        // pointHoverBackgroundColor: '#ced4da',
        // pointHoverBorderColor    : '#ced4da'
      }]
    },
    options: {
      maintainAspectRatio: false,
      tooltips: {
        mode: mode,
        intersect: intersect
      },
      hover: {
        mode: mode,
        intersect: intersect
      },
      legend: {
        display: false
      },
      scales: {
        yAxes: [{
          // display: false,
          gridLines: {
            display: true,
            lineWidth: '4px',
            color: 'rgba(0, 0, 0, .2)',
            zeroLineColor: 'transparent'
          },
          ticks: $.extend({
            beginAtZero: true,
            suggestedMax: 200
          }, ticksStyle)
        }],
        xAxes: [{
          display: true,
          gridLines: {
            display: false
          },
          ticks: ticksStyle
        }]
      }
    }
  })
})

</script>
</script>
</body>
</html>
