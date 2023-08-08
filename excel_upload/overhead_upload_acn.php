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
                   

                    if($sheet1 = $objPHPExcel->getSheet(3)){
                    	$sheet1 = $objPHPExcel->getSheet(3);
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
							if(!is_null($row[$i]) AND $row[$i] != "BGDBD1 Total" AND $row[$i] != "Grand Total"  AND $row[$i] != "Division"  ) {
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
									$query = "INSERT INTO `saca_overhead`(`Division`,`Region_Group`,`Region`,`Location`,`project`, `Project_Description`, `Reviewed`, `Organisation`, `Func_Group`, `PROJECT1`, `Salary`, `Reimb`, `Total_Cost`, `Budget`, `Variance`, `Salary1`, `Reimb1`, `Total_cost1`, `Budget1`, `Variance1`, `status`, `entity`,`year`,`month`) 
											values('".$d0."','".$d1."','".$d2."','".$d3."','".$d4."','".$d5."','".$d6."','".$d7."','".$d8."','".$d9."','".$d10."','".$d11."','".$d12."','".$d13."','".$d14."','".$d15."','".$d16."','".$d17."','".$d18."','".$d19."','".$d20."','".$d21."','".$year."','".$month."')";
									//$mysqli->query($query);	
									$mysqli = mysqli_query($con1,$query);
							       
						   }    
						   $i ++;
					    }
						$html.="</table>";
						//echo $html;
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