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
	 
	echo"<a href=\"./sql2excel_example1.php\">Download Excel Example1<a><br>";
	$query="SELECT * FROM employees";
	$query=urlencode($query);
	echo"<a href=\"./sql2excel_example2.php?query=$query\">Download Excel Example2<a>";
?>