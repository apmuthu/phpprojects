<?php
/*
// Program       : Encode and Decode files using ASCII code shift
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2021-08-28
// Usage:
//	$a = file_get_contents("a.txt"); // contents of file to be decoded
//	echo ascii_decode($a);
// Implementation:
//	Alphion Fibre Modem/Router Config file
*/

function ascii_decode($str) {
	$b = str_split($str);

	foreach($b as $k => $v) {
		$b[$k] = chr(ord($v)-1);
	}
	return implode("", $b);
}

function ascii_encode($str) {
	$b = str_split($str);

	foreach($b as $k => $v) {
		$b[$k] = chr(ord($v)+1);
	}
	return implode("", $b);
}
?>
