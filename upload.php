<?php
//ob_start();
//session_start();
require 'db.php'; 
//include("check_rights.php");
//$strusername = $_SESSION['user_name'];

 //$user_cd=$_SESSION['uid'];

$distinct_key=$_REQUEST['dkey'];
// (A) HELPER FUNCTION - SERVER RESPONSE
function verbose ($ok=1, $info="") {
  if ($ok==0) { http_response_code(400); }

  exit(json_encode(["ok"=>$ok, "info"=>$info]));
}
//echo $report_id=$_REQUEST['rid'];
// (B) INVALID UPLOAD
if (empty($_FILES) || $_FILES["file"]["error"]) {
  verbose(0, "Failed to move uploaded file.");
}

// (C) UPLOAD DESTINATION - CHANGE FOLDER IF REQUIRED!
$filePath ="photos";
if (!file_exists($filePath)) { if (!mkdir($filePath, 0777, true)) {
  verbose(0, "Failed to create $filePath");
}}
$fileName = isset($_REQUEST["name"]) ? $_REQUEST["name"] : $_FILES["file"]["name"];


$ext = pathinfo($fileName, PATHINFO_EXTENSION);
$array_sname=str_replace(".".$ext,'',$fileName);
$report_title_1=preg_replace("/[^a-zA-Z0-9.]/", "", $array_sname);
//$filename1=uniqid()."_".$report_title_1.".".$ext;
$filename1=$distinct_key."_".$report_title_1.".".$ext;
$filePath = $filePath . DIRECTORY_SEPARATOR . $filename1;

// (D) DEAL WITH CHUNKS
$chunk = isset($_REQUEST["chunk"]) ? intval($_REQUEST["chunk"]) : 0;
$chunks = isset($_REQUEST["chunks"]) ? intval($_REQUEST["chunks"]) : 0;
$out = @fopen("{$filePath}.part", $chunk == 0 ? "wb" : "ab");
if ($out) {
  $in = @fopen($_FILES["file"]["tmp_name"], "rb");
  if ($in) { while ($buff = fread($in, 4096)) { fwrite($out, $buff); } }
  else { verbose(0, "Failed to open input stream"); }
  @fclose($in);
  @fclose($out);
  @unlink($_FILES["file"]["tmp_name"]);
} else { verbose(0, "Failed to open output stream"); }

// (E) CHECK IF FILE HAS BEEN UPLOADED
if (!$chunks || $chunk == $chunks - 1) { 
 $sql_pro_ins="INSERT INTO rs_tbl_videos_stored (document_name, distinct_key) Values('".$filename1."','".$distinct_key."')";
$query_res=mysqli_query($con,$sql_pro_ins);

rename("{$filePath}.part", $filePath); 



}

verbose(1, $filename1);