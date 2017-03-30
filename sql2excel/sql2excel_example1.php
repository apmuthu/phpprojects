<?php
	/* 
	 * @version V1.0 2002/July/18 (c) Erh-Wen,Kuo (erhwenkuo@yahoo.com). All rights reserved.
	 * Released under both BSD license and Lesser GPL library license. 
	 * Whenever there is any discrepancy between the two licenses, 
	 * the BSD license will take precedence. 
	 *
	 * purpose: This is a example how to use "sql2excel" class to write mysql sql content
	 *          to excel file format and stream the output to user's browser directly.
	 */
	 
	include_once('sql2excel.class.php');
		
	//the query string you want to show
	$query="SELECT * FROM employees";
	
	//setup parameters for initiating Sql2Excel class instance
	//modify your mysql connection parameters & database name below:
	$db_host="localhost";
	$db_user="";
	$db_pwd="";
	$db_dbname="xcompany";
	
	//initiating Sql2Excel class instance
	$excel=new Sql2Excel($db_host,$db_user,$db_pwd,$db_dbname);
	//Output excel file to user's browser
	$excel->ExcelOutput($query);
	echo"<h1>Exel Generate Completed!!</h1>";

/*
// Saving the excel file on the server
	$file = '/var/www/files/MyExcel'; // .xls will get suffixed by ExcelGen class constructor
	$relpath = '../files'; // relative url path to retrieve excel file from
	$excel=new Sql2Excel($dbhost,$dbuser,$dbpass,$dbname, $file);
	//Output excel file to user's browser
	$savfile = $excel->ExcelOutput($query, true); // save the file
	$savfile = basename($savfile);
	echo "Saved <a href=\"$relpath$savfile\">$savfile</a>". $brlf;
*/

?>