<?php
/*
// Program  : Convert Text date to Words
// Author   : Ap.Muthu <apmuthu@usa.net>
// Version  : 1.0
// Release  : 2021-07-24
// Source   : https://www.studentstutorial.com/php/number-to-words
// Usage    : $mydate =  strtotime("27.04.2001"); echo dateTowords($mydate);
*/

// https://www.studentstutorial.com/php/number-to-words
// $mydate =  strtotime("27.04.2001");
// echo dateTowords($mydate);

function dateTowords($mydate) {

	$myday =  date("j", $mydate);
	$mymonth =  date("F", $mydate);
	$myyear =  date("Y", $mydate);

	$words = numberTowords($myday) . ' ' . $mymonth . ' ' . numberTowords($myyear);
	return ucwords(strtolower($words));
}

function numberTowords($num) {

	$ones = array(
	0 =>"ZERO",
	1 => "ONE",
	2 => "TWO",
	3 => "THREE",
	4 => "FOUR",
	5 => "FIVE",
	6 => "SIX",
	7 => "SEVEN",
	8 => "EIGHT",
	9 => "NINE",
	10 => "TEN",
	11 => "ELEVEN",
	12 => "TWELVE",
	13 => "THIRTEEN",
	14 => "FOURTEEN",
	15 => "FIFTEEN",
	16 => "SIXTEEN",
	17 => "SEVENTEEN",
	18 => "EIGHTEEN",
	19 => "NINETEEN",
	"014" => "FOURTEEN"
	);
	$tens = array( 
	0 => "ZERO",
	1 => "TEN",
	2 => "TWENTY",
	3 => "THIRTY", 
	4 => "FORTY", 
	5 => "FIFTY", 
	6 => "SIXTY", 
	7 => "SEVENTY", 
	8 => "EIGHTY", 
	9 => "NINETY" 
	); 
	$hundreds = array( 
	"HUNDRED", 
	"THOUSAND", 
	"MILLION", 
	"BILLION", 
	"TRILLION", 
	"QUARDRILLION" 
	); /*limit t quadrillion */
	$num = number_format($num,2,".",","); 
	$num_arr = explode(".",$num); 
	$wholenum = $num_arr[0]; 
	$decnum = $num_arr[1]; 
	$whole_arr = array_reverse(explode(",",$wholenum)); 
	krsort($whole_arr,1); 
	$rettxt = ""; 
	foreach($whole_arr as $key => $i) {
		
		while(substr($i,0,1)=="0")
			$i=substr($i,1,5);
		if($i < 20) { 
		/* echo "getting:".$i; */
			$rettxt .= $ones[$i]; 
		} elseif($i < 100) { 
			if(substr($i,0,1)!="0") $rettxt .= $tens[substr($i,0,1)]; 
			if(substr($i,1,1)!="0") $rettxt .= " ".$ones[substr($i,1,1)]; 
		} else { 
			if(substr($i,0,1)!="0") $rettxt .= $ones[substr($i,0,1)]." ".$hundreds[0]; 
			if(substr($i,1,1)!="0") $rettxt .= " ".$tens[substr($i,1,1)]; 
			if(substr($i,2,1)!="0") $rettxt .= " ".$ones[substr($i,2,1)]; 
		} 
		if($key > 0) { 
			$rettxt .= " ".$hundreds[$key]." "; 
		}
	} 
	if($decnum > 0) {
		$rettxt .= " and ";
		if($decnum < 20) {
			$rettxt .= $ones[$decnum];
		} elseif($decnum < 100) {
			$rettxt .= $tens[substr($decnum,0,1)];
			$rettxt .= " ".$ones[substr($decnum,1,1)];
		}
	}
	return $rettxt;
}
?>
