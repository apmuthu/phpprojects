<?php
	
	/* 
	 * @version V1.0 2002/July/18 (c) Erh-Wen,Kuo (erhwenkuo@yahoo.com). All rights reserved.
	 * Released under both BSD license and Lesser GPL library license. 
	 * Whenever there is any discrepancy between the two licenses, 
	 * the BSD license will take precedence. 
	 *
	 * purpose: This is a example how to use "ExcelGen" class to write number or text
	 *          to excel file format and stream the output to user's browser directly.
	 */
	
	//include "excelgen" class
	include( "excelgen.class.php" );
	
	//initiate a instance of "excelgen" class
	$excel = new ExcelGen("ExcelGen");
	
	//initiate $row,$col variables
	$row=0;
	$col=0;
	
	//write text in cell(0,0)
	$excel->WriteText($row,$col,"This is a ExcelGen Clas Example");
	$row++;
	
	//write number in cell($row,$col)	
	for($row;$row<9;$row++){
		for($col=0;$col<9;$col++){
			$excel->WriteNumber($row,$col,$row*$col);
		}
	}
	
	//stream Excel for user to download or show on browser
	$excel->SendFile();
?>