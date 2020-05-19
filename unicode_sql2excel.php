<?php
/*
// Program       : Export Unicode (like Tamil) data from MySQL to Excel as CSV
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2020-05-19
// Reference     : https://www.the-art-of-web.com/php/dataexport/
// Reference     : https://stackoverflow.com/questions/4348802/how-can-i-output-a-utf-8-csv-in-php-that-excel-will-read-properly/4762708#4762708
// Reference     : https://stackoverflow.com/questions/10942900/convert-ucs-2-file-to-utf-8-with-php
// Reference     : https://www.php.net/manual/en/function.mb-convert-encoding.php
*/

$link = mysqli_connect("localhost", "my_user", "my_pass", "my_db");

// Example use of parameter for use in User SQLs
// $Zone = isset($_REQUEST['Zone']) ? mysqli_real_escape_string($link, $_REQUEST['Zone']) : false;
// if(!$Zone) die("No zone given.");

$sqls = Array(
	  "SET NAMES utf8"
	, "SET character_set_results = 'utf8'
	   , character_set_client = 'utf8'
	   , character_set_connection = 'utf8'
	   , character_set_database = 'utf8'
	   , character_set_server = 'utf8'"
	, "SET CHARACTER SET utf8"
	, "SET COLLATION_CONNECTION = 'utf8_unicode_ci'"
);

foreach ($sqls as $sql) {
	mysqli_query($link, $sql);
}

// User SQLs

$sql = "SELECT * from addressbook";
$result = mysqli_query($link, $sql);

$out = "";
$out .= sqlresult2tsv($result);

// filename for download
$filename = "Output" . '_' . date('YmdHis') . ".xls";

header("Content-Disposition: attachment; filename=\"$filename\"");
header("Content-Type: application/vnd.ms-excel; charset=UTF-16LE");
header('Content-Description: File Transfer');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: public');

// For Excel unicode visibility UCS-2LE is used - 0xFF 0xFE BOM
print chr(255) . chr(254) . mb_convert_encoding($out, 'UTF-16LE', 'UTF-8');

// Functions
function sqlresult2tsv($result) {
	$out = "";
	$flag = false; // first pass for headings
	while($row = mysqli_fetch_assoc($result)) {
		if(!$flag) {
		  // display field/column names as first row
		  $out .= implode("\t", array_keys($row)) . "\r\n";
		  $flag = true;
		}
		array_walk($row, __NAMESPACE__ . '\cleanData');
		$out .= implode("\t", array_values($row)) . "\r\n";
	}
	return $out;
}

function cleanData(&$str) {
    // escape tab characters
    $str = preg_replace("/\t/", "\\t", $str);

    // escape new lines
    $str = preg_replace("/\r?\n/", "\\n", $str);

    // convert 't' and 'f' to boolean values
//    if($str == 't') $str = 'TRUE';
//    if($str == 'f') $str = 'FALSE';

    // force certain number formats to be imported as strings
//    if(preg_match("/^0/", $str)) $str = "'$str"; // 0 as String
//    if(preg_match("/^\+?\d{8,}$/", $str))  $str = "'$str"; // 8 digits as String

    // force certain date formats to be imported as strings
    if(preg_match("/^\d{4}.\d{1,2}.\d{1,2}/", $str)) $str = "'$str"; // MySQL date as string

    // escape fields that include double quotes
    if(strstr($str, '"')) $str = '"' . str_replace('"', '""', $str) . '"';
}

?>