<?php
	/* 
	 * @version V1.0 2002/July/18 (c) Erh-Wen,Kuo (erhwenkuo@yahoo.com). All rights reserved.
	 * Released under both BSD license and Lesser GPL library license. 
	 * Whenever there is any discrepancy between the two licenses, 
	 * the BSD license will take precedence. 
	 *
	 * purpose: This class is used to generate simple MS Excel file (xls) via
	 * PHP & stream to user's browser.
	 * Credits: This class is based on Erol Ozcan's psxlsgen
	 *          Excel library functions.
	 */

	class  ExcelGen {
	      var  $excel_data;      	// a buffer for store excel stream data
	      var  $excel_filename;     // excel filename
      

	     // Default constructor
	     function  ExcelGen($excel_filename='excelgen',$excel_wksheetname='david')
	     {
		$this->excel_data="";		             // a buffer for store excel stream data
		$this->excel_filename=$excel_filename;	     // excel filename
	
		$this->ExcelStart();
	     }
     
	     // start of the excel file
	     function ExcelStart()
	     {
	     	// start of excel file header
	     	$this->excel_data = pack( "vvvvvv", 0x809, 0x08, 0x00,0x10, 0x0, 0x0 );
     	     }
     
	     // end of the excel file
	     function ExcelEnd()
	     {
	       $this->excel_data .= pack( "vv", 0x0A, 0x00 );
	     }

	     // write a Number (double) into cell(row, col)
	     function WriteNumber( $row, $col, $value )
	     {
	        $this->excel_data .= pack( "vvvvv", 0x0203, 14, $row, $col, 0x00 );
	        $this->excel_data .= pack( "d", $value );
	     }

	     // write a text into cell(Row,Col)
	     function WriteText( $row, $col, $value )
	     {
	        $len = strlen( $value );
	        $this->excel_data .= pack( "v*", 0x0204, 8 + $len, $row, $col, 0x00, $len );
	        $this->excel_data .= $value;
	     }
     
	     // send generated xls as stream file
	     function SendFile()
	     {
	     	//Close Excel File         
	        $this->ExcelEnd();
	        header ( "Expires: Mon, 1 Apr 1974 05:00:00 GMT");
	        header ( "Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT" );
	        header ( "Pragma: no-cache" );
	        header ( "Content-type: application/octet-stream; name=$this->excel_filename.xls" );
	        header ( "Content-Disposition: attachment; filename=$this->excel_filename.xls"); 
	        header ( "Content-Description: PHP ExcelGen Class" );
	        print $this->excel_data;
	     }

	} // end of the class ExcelGen() class
?>
