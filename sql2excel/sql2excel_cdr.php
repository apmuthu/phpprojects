<?php

// Example SQL2Excel Usage for Elastix CDRs

	include_once('sql2excel.class.php');
		
	//the query string you want to show
	$query = '';
	if(!isset($_REQUEST['query'])) {
//		$query="Select * From employees";
		exit;
	} else {
		$query=base64_decode($_REQUEST['query']);
	}
	$filename = 'report';
	if(isset($_REQUEST['f'])) $filename = trim($_REQUEST['f']);
	$filename = str_replace('-','',$filename);
	
	//setup parameters for initiating Sql2Excel class instance
	//modify your mysql connection parameters & database name below:
	$db_host="localhost";
	$db_user="asteriskuser";
	$db_pwd="asterisk";
	$db_dbname="asteriskcdrdb";
	
	//initiating Sql2Excel class instance
	$excel=new Sql2Excel($db_host,$db_user,$db_pwd,$db_dbname,$filename);
	//Output excel file to user's browser
	$excel->ExcelOutput($query);
//	echo"<h1>Excel Generate Completed!!</h1>";
?>