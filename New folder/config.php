<?php 
if($_SERVER['HTTP_HOST'] == "pmis.leadrail.in:8071"  || $_SERVER['HTTP_HOST'] == "localhost" || $_SERVER['HTTP_HOST'] == "sacaapps.com:8071" || $_SERVER['HTTPS_HOST'] == "pmis.leadrail.in:8071" || $_SERVER['HTTP_HOST'] == "localhost:8071" || $_SERVER['HTTP_HOST'] == "10.200.80.6:8071" || $_SERVER['HTTP_HOST'] == "117.247.187.20:8071"  )
	{# For local
	$_CONFIG['site_url'] 		= "http://".$_SERVER['HTTP_HOST']."/ppr/";
	$_CONFIG['site_url'] 		= "http://".$_SERVER['HTTP_HOST']."/ppr/";
	$_CONFIG['site_path'] 		= $_SERVER['DOCUMENT_ROOT'] . "/HORC/";
}