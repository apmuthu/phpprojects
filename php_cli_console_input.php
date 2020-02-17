<?php
/*
	Purpose  : Obtain user input from php console in CLI
	Author   : Ap.Muthu <apmuthu@usa.net>
	Release  : 2020-02-17
	Reference: https://stackoverflow.com/questions/15322371/php-wait-for-input-from-command-line

	Usage:

//	=====
$match    = "yes";
$prompt   = "Are you sure you want to do this?  Type '$match' to continue: ";
$ok_msg   = "Thank you, continuing...\n";
$fail_msg = "ABORTING!\n";

$a = get_val_from_console($prompt, $match, $ok_msg, $fail_msg);
if ($a === false)
	exit;
else
	echo "The Input Value is: " . $a . "\n";
//  =====

	Outputs for ..\php test.php:
Are you sure you want to do this?  Type 'yes' to continue: no

ABORTING!

Are you sure you want to do this?  Type 'yes' to continue: yes

Thank you, continuing...
The Input Value is: yes

*/

function get_val_from_console($prompt, $match = null, $ok_msg, $fail_msg) {
	echo $prompt;
	$handle = fopen ("php://stdin","r");
	$line = fgets($handle);
	$ret_val = trim($line);
	fclose($handle);
	if (!is_null($match)) {
		echo "\n"; 
		if ($ret_val != $match) {
			if (!empty($fail_msg)) echo $fail_msg;
			$ret_val = false;
		} else {
			if (!empty($ok_msg)) echo $ok_msg;
		}
	}
	return $ret_val;
}
