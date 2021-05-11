<?php
/*
	Program      : Excel data parsing into PHP
	Author       : Ap.Muthu <apmuthu@usa.net>
	Version      : 1.0
	Release Date : 2021-05-12
	Reference    : https://github.com/PHPOffice/PHPExcel
*/

$filename = 'sample.xlsx'; // can be .xls also

date_default_timezone_set('Asia/Kolkata');

/** Include PHPExcel_IOFactory from https://github.com/PHPOffice/PHPExcel */
require_once dirname(__FILE__) . '../libraries/phpoffice/phpexcel/Classes/PHPExcel/IOFactory.php';

// Use PCLZip rather than ZipArchive to read the Excel2007 OfficeOpenXML file
PHPExcel_Settings::setZipClass(PHPExcel_Settings::PCLZIP);
$objPHPExcel = PHPExcel_IOFactory::load("$filename");
$objPHPExcel->setActiveSheetIndex(0);  //set first sheet as active

// Get single cell constant
$the_cell = $objPHPExcel->getActiveSheet()->getCell('A2')->getValue();
echo $the_cell . "<br>\n";

// Get range of cells constant and formulae
$all_rows = array();
for($row = 4; $row <= 40; ++$row) {
	$v = array(); // single row at a time
    for ($col = 'B'; $col <= 'U'; ++$col) {
		$val = '';
		$the_cell = $objPHPExcel->getActiveSheet()->getCell($col.$row);
        if (!is_null($formula = $the_cell->getValue())) {
			if ($formula[0] == '=') {
	//            echo 'Value of ' , $col , $row , ' [' , $formula , ']: ' , $the_cell->getCalculatedValue() . EOL;
				$val = $the_cell->getCalculatedValue();
			} else {
				$val = $formula;
			}
		}
		$val = addslashes($val);
		$val = iconv("UTF-8", "ISO-8859-1", $val);
		$val = trim($val, "\t\n\r\0\x0B\xc2\xa0"); // remove all non blank linefeeds
		$v[] = $val;
	}
	$v[3] = convertDate($v[3]); // Assuming that $v[3] is a full datetime constant in the excel sheet
	$all_rows[] = $v;
}
echo print_r($all_rows, true);

function convertDate($dateValue) {    
	// days since 0000-01-01 till 1970-01-01 is 25569
	$unixDate = ($dateValue - 25569) * 86400;  return gmdate("Y-m-d H:i:s", $unixDate);
	// where Y is YYYY, m is MM, and d is DD
}
