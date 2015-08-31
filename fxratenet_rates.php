<?php
/*
// Program       : Obtain Exchange Rate from fx-rate.net
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-08-31
//
// Example Usage :
// 	$bcurr = 'INR';
// 	$xcurr = 'MYR';
// 	get the current exchange rate of $xcurr (default USD) in $bcurr units
// 	echo "1 $xcurr = " . get_fxratenet_rate($bcurr, $xcurr) . " $bcurr";
*/

function get_allfxratenet_rates() {

// $basecurr = substr(trim(strtoupper($basecurr)),0,3);
// $url = "http://fx-rate.net//converter.php?layout=vertical&amount=1000&tcolor=000000&default_pair=$basecurr";
$url = "http://fx-rate.net//converter.php";
$a = file_get_contents($url);
$b = explode("[", $a);
$x = explode("]",$b[1]);
$units = explode(",",$x[0]);
$x = explode("]",$b[2]);
$names = explode(",",$x[0]);
$x = explode("]",$b[3]);
$symbols = explode(",",$x[0]);
$x = explode("]",$b[4]);
$rates = explode(",",$x[0]);

$ratelist = Array();
// Exchange rate base currency is in default_pair parameter from URL
// $metals = Array('XAL', 'XCP', 'XAU', 'XPD', 'XPT', 'XAG');
// CUP => Cuban Peso cannot be exchanged outside Cuba
//        and the CUP rate is set as 1:1 with USD and hence skipped
// ZWD => Zimbabwean Dollar exchange rate is not provided
$skip_cur = Array('CUP', 'ZWD');

foreach ($units as $key => $val) {
	$val = str_replace("'","",$val);
	if (!in_array($val, $skip_cur))
		$ratelist[$val] = Array('ccode' => $val, 
							'currency' => str_replace("'","",$names[$key]), 
//							   'symbol' => str_replace("'","",$symbols[$key]), 
							   'symbol' => html_entity_decode(str_replace("'","",$symbols[$key])), 
								 'rate' => $rates[$key]);	
}

return $ratelist;

}

function get_fxratenet_rate($bcur, $xcur='USD') {
	$bcur = substr(trim(strtoupper($bcur)),0,3);
	$xcur = substr(trim(strtoupper($xcur)),0,3);
	$allrates = get_allfxratenet_rates();
	return (($xcur == 'USD') ? $allrates[$bcur]['rate'] : $allrates[$bcur]['rate'] / $allrates[$xcur]['rate']);
}
?>
