<?php
/*
// Program        : To check validity of a given PAN number
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2021-04-20
// Reference      : https://techotut.com/pan-card-validation-php/
//                : https://www.geeksforgeeks.org/how-to-validate-pan-card-number-using-regular-expression/
// Usage          :
	$value = "PAN Card NUMBER"; //Put your 10 character PAN card Number here
	echo (checkPAN($value)) ? "Yes" : "No";
*/

function checkPAN($str) {
	$str = trim($str);
	if (strlen($str) <> 10) {
		$msg = false;
	} else {
		$pattern = '/^([a-zA-Z]){5}([0-9]){4}([a-zA-Z]){1}?$/';
		$result = preg_match($pattern, $str);

		if ($result) {
			$findme = ucfirst(substr($str, 3, 1));
			$mystring = 'CPHFATBLJG';
			$pos = strpos($mystring, $findme);
			if ($pos === false) {
				$msg = false;
			} else {
				$msg = true;
			}
		} else {
			$msg = false;
		}
	}
	return $msg;
}
