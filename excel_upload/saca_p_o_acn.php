<?php
error_reporting(E_ALL ^ E_WARNING  ^ E_DEPRECATED); 
if(isset($_FILES['uploadFile']) && isset($_POST['year'])) {
	 $year = $_POST['year'];
	 $month = $_POST['month'];
     if(isset($_FILES['uploadFile']['name']) && $_FILES['uploadFile']['name'] != "") {
        $allowedExtensions = array("xls","xlsx","application/vnd.ms-excel","text/xls","application/vnd.oasis.opendocument.spreadsheet","text/xlsx");
        $ext = pathinfo($_FILES['uploadFile']['name'], PATHINFO_EXTENSION);
        
		
        if(in_array($ext, $allowedExtensions)) {
				// Uploaded file
               $file = "uploads/".$_FILES['uploadFile']['name'];
               $isUploaded = copy($_FILES['uploadFile']['tmp_name'], $file);
			   // check uploaded file
               if($isUploaded) {
					// Include PHPExcel files and database configuration file
                    include("db.php");
					//require_once __DIR__ . '/vendor/autoload.php';
                    include('PHPExcel-1.8/Classes/PHPExcel/IOFactory.php');
                    try {
                        // load uploaded file
                        $objPHPExcel = PHPExcel_IOFactory::load($file);
                    } catch (Exception $e) {
                         die('Error loading file "' . pathinfo($file, PATHINFO_BASENAME). '": ' . $e->getMessage());
                    }
                    // Specify the excel sheet index
                   

                    if($sheet1 = $objPHPExcel->getSheet(0)){
                    	$sheet1 = $objPHPExcel->getSheet(0);
	                    $total_rows = $sheet1->getHighestRow();
						$highestColumn      = $sheet1->getHighestColumn();	
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);		
						
						//	loop over the rows
						for ($row = 1; $row <= $total_rows; ++ $row) {
							for ($col = 0; $col < $highestColumnIndex; ++ $col) {
								$cell = $sheet1->getCellByColumnAndRow($col, $row);
								$val = $cell->getValue();
								$records[$row][$col] = $val;
								 //echo '<pre>',print_r($val),'</pre>';exit;

							}
						}
						$html="<table border='1'>";
						foreach($records as $row){
							$i= 0;
							// if(!is_null($row[$i]) AND $row[$i] != "BGDBD1 Total" AND $row[$i] != "Grand Total"  AND $row[$i] != "PPR" AND $row[$i] != "AUSTRALIA & NZ" AND $row[$i] != "AUSTRALIA & NZ Total" AND $row[$i] != "ANZ MANAGED SERVICES Total" AND $row[$i] != "NORTH ASIA Total" AND $row[$i] != "BGDBD1 Total" AND $row[$i] != "NORTH ASIA" ) {
							

                            if( $row[$i] == "SOUTH ASIA" ) {
								// HTML content to render on webpage
								$html.="<tr>";
								$d0 = isset($row[0]) ? $row[0] : '';
								$d1 = isset($row[1]) ? $row[1] : '';
								$d2 = isset($row[2]) ? $row[2] : '';
								$d3 = isset($row[3]) ? $row[3] : '';
								$d4 = isset($row[4]) ? $row[4] : '';
								$d5 = isset($row[5]) ? $row[5] : '';
								$d6 = isset($row[6]) ? $row[6] : '';
								$d7 = isset($row[7]) ? $row[7] : '';
								$d8 = isset($row[8]) ? $row[8] : '';
								$d9 = isset($row[9]) ? $row[9] : '';
								$d10 = isset($row[10]) ? $row[10] : '';
								$d11 = isset($row[11]) ? $row[11] : '';
								$d12 = isset($row[12]) ? $row[12] : '';
								$d13 = isset($row[13]) ? $row[13] : '';
								$d14 = isset($row[14]) ? $row[14] : '';
								$d15 = isset($row[15]) ? $row[15] : '';
								$d16 = isset($row[16]) ? $row[16] : '';
								$d17 = isset($row[17]) ? $row[17] : '';
								$d18 = isset($row[18]) ? $row[18] : '';
								$d19 = isset($row[19]) ? $row[19] : '';
								$d20 = isset($row[20]) ? $row[20] : '';
								$d21 = isset($row[21]) ? $row[21] : '';
								$d22 = isset($row[22]) ? $row[22] : '';
								$d23 = isset($row[23]) ? $row[23] : '';
								$d24= isset($row[24]) ? $row[24] : '';
								$d25 = isset($row[25]) ? $row[25] : '';
								$d26 = isset($row[26]) ? $row[26] : '';
								$d27 = isset($row[27]) ? $row[27] : '';
								$d28 = isset($row[28]) ? $row[28] : '';
								$d29 = isset($row[29]) ? $row[29] : '';
								$d30 = isset($row[30]) ? $row[30] : '';
								$d31 = isset($row[31]) ? $row[31] : '';
								$d32 = isset($row[32]) ? $row[32] : '';
								$d33 = isset($row[33]) ? $row[33] : '';
								$d34 = isset($row[34]) ? $row[34] : '';
								$d35 = isset($row[35]) ? $row[35] : '';
								$d36 = isset($row[36]) ? $row[36] : '';
								$d37 = isset($row[37]) ? $row[37] : '';
								$d38 = isset($row[38]) ? $row[38] : '';
								$d39 = isset($row[39]) ? $row[39] : '';
								$d40 = isset($row[40]) ? $row[40] : '';
								$d41 = isset($row[41]) ? $row[41] : '';
								$d42 = isset($row[42]) ? $row[42] : '';
								$d43 = isset($row[43]) ? $row[43] : '';
								$d44 = isset($row[44]) ? $row[44] : '';
								$d45 = isset($row[45]) ? $row[45] : '';
								$d46 = isset($row[46]) ? $row[46] : '';
								$d47 = isset($row[47]) ? $row[47] : '';
								$d48 = isset($row[48]) ? $row[48] : '';
								$d49 = isset($row[49]) ? $row[49] : '';
								$d50 = isset($row[50]) ? $row[50] : '';
								$d51 = isset($row[51]) ? $row[51] : '';
								$d52 = isset($row[52]) ? $row[52] : '';
								$d53 = isset($row[53]) ? $row[53] : '';
								$d54 = isset($row[54]) ? $row[54] : '';
								$d55 = isset($row[55]) ? $row[55] : '';
								$d56 = isset($row[56]) ? $row[56] : '';
								$d57 = isset($row[57]) ? $row[57] : '';
								$d58 = isset($row[58]) ? $row[58] : '';
								$d59 = isset($row[59]) ? $row[59] : '';
								$d60 = isset($row[60]) ? $row[60] : '';
								$d61 = isset($row[61]) ? $row[61] : '';
								$d62 = isset($row[62]) ? $row[62] : '';
								$d63 = isset($row[63]) ? $row[63] : '';
								$d64 = isset($row[64]) ? $row[64] : '';
								$d65 = isset($row[65]) ? $row[65] : '';
								$d66 = isset($row[66]) ? $row[66] : '';
								$d67 = isset($row[67]) ? $row[67] : '';
								$d68 = isset($row[68]) ? $row[68] : '';
								$d69 = isset($row[69]) ? $row[69] : '';
								$d70 = isset($row[70]) ? $row[70] : '';
								$d71 = isset($row[71]) ? $row[71] : '';
								$d72 = isset($row[72]) ? $row[72] : '';
								

								$html.="<td>".$d0."</td>";
								$html.="<td>".$d1."</td>";
								$html.="<td>".$d2."</td>";
								$html.="<td>".$d3."</td>";
								$html.="<td>".$d4."</td>";
								$html.="<td>".$d5."</td>";
								$html.="<td>".$d6."</td>";
								$html.="<td>".$d7."</td>";
								$html.="<td>".$d8."</td>";
								$html.="<td>".$d9."</td>";
								$html.="<td>".$d10."</td>";
								$html.="<td>".$d11."</td>";
								$html.="<td>".$d12."</td>";
								$html.="<td>".$d13."</td>";
								$html.="<td>".$d14."</td>";
								$html.="<td>".$d15."</td>";
								$html.="<td>".$d16."</td>";
								$html.="<td>".$d17."</td>";
								$html.="<td>".$d18."</td>";
								$html.="<td>".$d19."</td>";
								$html.="<td>".$d20."</td>";
								$html.="<td>".$d21."</td>";
								$html.="<td>".$d22."</td>";
								$html.="<td>".$d23."</td>";
								$html.="<td>".$d24."</td>";
								$html.="<td>".$d25."</td>";
								$html.="<td>".$d26."</td>";
								$html.="<td>".$d27."</td>";
								$html.="<td>".$d28."</td>";
								$html.="<td>".$d29."</td>";
								$html.="<td>".$d30."</td>";
								$html.="<td>".$d31."</td>";
								$html.="<td>".$d32."</td>";
								$html.="<td>".$d33."</td>";
								$html.="<td>".$d34."</td>";
								$html.="<td>".$d35."</td>";
								$html.="<td>".$d36."</td>";
								$html.="<td>".$d37."</td>";
								$html.="<td>".$d38."</td>";
								$html.="<td>".$d39."</td>";
								$html.="<td>".$d40."</td>";
								$html.="<td>".$d41."</td>";
								$html.="<td>".$d42."</td>";
								$html.="<td>".$d43."</td>";
								$html.="<td>".$d44."</td>";
								$html.="<td>".$d45."</td>";
								$html.="<td>".$d46."</td>";
								$html.="<td>".$d47."</td>";
								$html.="<td>".$d48."</td>";
								$html.="<td>".$d49."</td>";
								$html.="<td>".$d50."</td>";
								$html.="<td>".$d51."</td>";
								$html.="<td>".$d52."</td>";
								$html.="<td>".$d53."</td>";
								$html.="<td>".$d54."</td>";
								$html.="<td>".$d55."</td>";
								$html.="<td>".$d56."</td>";
								$html.="<td>".$d57."</td>";
								$html.="<td>".$d58."</td>";
								$html.="<td>".$d59."</td>";
								$html.="<td>".$d60."</td>";
								$html.="<td>".$d61."</td>";
								$html.="<td>".$d62."</td>";
								$html.="<td>".$d63."</td>";
								$html.="<td>".$d64."</td>";
								$html.="<td>".$d65."</td>";
								$html.="<td>".$d66."</td>";
								$html.="<td>".$d67."</td>";
								$html.="<td>".$d67."</td>";
								$html.="</tr>";
									$query = "INSERT INTO `saca_profitability`(`Division`,`Region_Group`,`Region`,`Location`,`project`, `Project_Description`, `Reviewed`, `Organisation`, `Func_Group`, `PROJECT1`, `Fees`, `Reimb`, `Total_Rev`, `Salary`, `Reim_Cost`, `Total_Cost`, `Contrib`, `Cont_Margin`, `Fees1`, `Reimb1`, `Total_Rev1`, `Salary1`, `Reim_Cost1`, `Total_Cost1`, `Contrib1`, `Cont_Margin1`, `Fees2`, `Reimb2`, `Total_Rev2`, `Salary2`, `Reim_Cost2`, `Total_Cost2`, `Contrib2`, `Cont_Margin2`, `Fees3`, `Reimb3`, `Total_Rev3`, `Salary3`, `Reim_Cost3`, `Total_Cost3`, `Contrib3`, `Cont_Margin3`, `Fees4`, `Reimb4`, `Total_Rev4`, `Salary4`, `Reim_Cost4`, `Total_Cost4`, `Contrib4`, `Cont_Margin4`, `Billings`, `WIP`, `WIP_Days`, `Debtors`, `Debtor_Days`, `Lockup`, `Lockup_Days`, `Last_Rivision Date`,`year`,`month`)
											values('".$d0."','".$d1."','".$d7."','".$d6."','".$d2."','".$d3."','".$d4."','".$d11."','".$d12."','".$d13."','".$d17."','".$d18."','".$d19."','".$d20."','".$d21."','".$d22."','".$d23."','".$d24."','".$d25."','".$d26."','".$d27."','".$d28."','".$d29."','".$d30."','".$d31."','".$d32."','".$d36."','".$d37."','".$d38."','".$d39."','".$d40."','".$d41."','".$d42."','".$d43."','".$d50."','".$d51."','".$d52."','".$d53."','".$d54."','".$d55."','".$d56."','".$d57."','".$d58."','".$d59."','".$d60."','".$d61."','".$d62."','".$d63."','".$d64."','".$d65."','".$d66."','".$d67."','".$d68."','".$d69."','".$d70."','".$d71."','".$d72."','".$d5."','".$year."','".$month."')"; 
									//$mysqli->query($query);	
									$mysqli = mysqli_query($con1,$query);
							       
						   }    
						   $i ++;
					    }
						$html.="</table>";
						//echo $html;
					}
					
					if($sheet2 = $objPHPExcel->getSheet(1)){
                    	$sheet2 = $objPHPExcel->getSheet(1);
	                    $total_rows = $sheet2->getHighestRow();
						$highestColumn      = $sheet2->getHighestColumn();	
						$highestColumnIndex = PHPExcel_Cell::columnIndexFromString($highestColumn);		
						
						//	loop over the rows
						for ($row = 1; $row <= $total_rows; ++ $row) {
							for ($col = 0; $col < $highestColumnIndex; ++ $col) {
								$cell = $sheet2->getCellByColumnAndRow($col, $row);
								$val = $cell->getValue();
								$records[$row][$col] = $val;
								 //echo '<pre>',print_r($val),'</pre>';exit;

							}
						}
						$html="<table border='1'>";
						foreach($records as $row){
							$i= 0;
							if($row[$i] == "SOUTH ASIA") {
								// HTML content to render on webpage
								$html.="<tr>";
								$d0 = isset($row[0]) ? $row[0] : '';
								$d1 = isset($row[1]) ? $row[1] : '';
								$d2 = isset($row[2]) ? $row[2] : '';
								$d3 = isset($row[3]) ? $row[3] : '';
								$d4 = isset($row[4]) ? $row[4] : '';
								$d5 = isset($row[5]) ? $row[5] : '';
								$d6 = isset($row[6]) ? $row[6] : '';
								$d7 = isset($row[7]) ? $row[7] : '';
								$d8 = isset($row[8]) ? $row[8] : '';
								$d9 = isset($row[9]) ? $row[9] : '';
								$d10 = isset($row[10]) ? $row[10] : '';
								$d11 = isset($row[11]) ? $row[11] : '';
								$d12 = isset($row[12]) ? $row[12] : '';
								$d13 = isset($row[13]) ? $row[13] : '';
								$d14 = isset($row[14]) ? $row[14] : '';
								$d15 = isset($row[15]) ? $row[15] : '';
								$d16 = isset($row[16]) ? $row[16] : '';
								$d17 = isset($row[17]) ? $row[17] : '';
								$d18 = isset($row[18]) ? $row[18] : '';
								$d19 = isset($row[19]) ? $row[19] : '';
								$d20 = isset($row[20]) ? $row[20] : '';
								$d21 = isset($row[21]) ? $row[21] : '';
								
								$html.="<td>".$d1."</td>";
								$html.="<td>".$d2."</td>";
								$html.="<td>".$d3."</td>";
								$html.="<td>".$d4."</td>";
								$html.="<td>".$d5."</td>";
								$html.="<td>".$d6."</td>";
								$html.="<td>".$d7."</td>";
								$html.="<td>".$d8."</td>";
								$html.="<td>".$d9."</td>";
								$html.="<td>".$d10."</td>";
								$html.="<td>".$d11."</td>";
								$html.="<td>".$d12."</td>";
								$html.="<td>".$d13."</td>";
								$html.="<td>".$d14."</td>";
								$html.="<td>".$d15."</td>";
								$html.="<td>".$d16."</td>";
								$html.="<td>".$d17."</td>";
								$html.="<td>".$d18."</td>";
								$html.="<td>".$d19."</td>";
								$html.="<td>".$d20."</td>";
								$html.="<td>".$d21."</td>";
								
								
								$html.="</tr>";
									$query = "INSERT INTO `saca_overhead`(`Division`,`Region_Group`,`Region`,`Location`,`project`, `Project_Description`, `Organisation`, `Func_Group`, `Salary`, `Reimb`, `Total_Cost`, `Budget`, `Variance`, `Salary1`, `Reimb1`, `Total_cost1`, `Budget1`, `Variance1`, `status`, `entity`,`month`,`year`) 
											values('".$d0."','".$d1."','".$d2."','".$d3."','".$d4."','".$d5."','".$d6."','".$d8."','".$d9."','".$d10."','".$d11."','".$d12."','".$d13."','".$d14."','".$d15."','".$d16."','".$d17."','".$d18."','".$d19."','".$d21."','".$month."','".$year."')"; 
									//$mysqli->query($query);	
									$mysqli = mysqli_query($con1,$query);
							       
						   }    
						   $i ++;
					    }
						$html.="</table>";
						echo $html;
					}	
					echo "Data inserted in Database";
				
                    unlink($file);
                } else {
                    echo '<span class="msg">File not uploaded!</span>';
                }
        } else {
            echo '<span class="msg">Please upload excel sheet.</span>';
        }
    } else {
        echo '<span class="msg">Please upload excel file.</span>';
    }
 }   

?>