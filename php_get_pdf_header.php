<?php
/*
  Program      : Get header information from pdf file
  Author       : Ap.Muthu <apmuthu@usa.net>
  Version      : 1.0
  Release Date : 2021-04-22

// Usage:
$file = 'alpha.pdf';
$content = file_get_contents($file);
echo print_r(get_pdf_header($content), true);

// Output:
Array
(
    [PDFversion] => 1.6
    [Pages] => 2
    [CreationDate] => 2021-04-21 08:40:22
    [ModDate] => 2021-04-21 14:34:26
)
*/

function get_pdf_header($string) {
	$header_dates = array('CreationDate', 'ModDate');

	$header['PDFversion'] =  substr($string, 5,3);
	$header['Pages'] = get_pdf_num_pages($string);

	foreach ($header_dates as $val) {
		$header[$val] =  get_pdf_header_date($string, $val);
	}
	return $header;
}

function get_pdf_header_date($string, $val) {
	$b = array();
	if (strpos($string, $val.' (D:') !== false) 
		$b = explode($val.' (D:', $string);
	elseif (strpos($string, $val.'(D:') !== false)
		$b = explode($val.'(D:', $string);
	else return false;
	$a = explode('+', str_replace('-','+',$b[1]));
	return date("Y-m-d H:i:s", strtotime($a[0]));
}

function get_pdf_num_pages($string) {
	$a = explode('Count ', $string);
	$a = explode('>', $a[1]);
	$a = explode("\n", $a[0]);
	return $a[0];
}

?>