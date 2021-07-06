<?php
/*
// Program       : PHP Legacy equivalent functions backported
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2021-07-07
*/

/**
 * Backport of array_key_first() available since PHP 7.3
 */
if (!function_exists('array_key_first')) {
	function array_key_first($array) {
		$a = array_keys($array);
		return $a[0];
	}
}

/**
 * Search for start string in values of an array and return key
 */
function search_start($search_string, $array) {
	$result = preg_grep('/^' . preg_quote($search_string, '/') . '/', $array);
	return array_key_first($result);
}

?>
