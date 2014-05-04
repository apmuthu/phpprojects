<?php
/*
// Program      : Output buffer flushing for progress monitoring of php script
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2014-05-04
*/

set_time_limit(0);
ini_set('default_socket_timeout', 300); // 300 Seconds = 5 Minutes

// Declare Constants, Acquire Variables and include support files

$brlf = "<BR>" . chr(10);

// Sequential code that does not need buffer flushing goes here

ob_start();
header('Content-Type: text/html; charset=utf-8');
while (ob_get_level()) ob_end_flush();
ob_implicit_flush(true);
echo "This page acquires Sequential files" . $brlf;

// Start Operational loop code needing buffer flushing like for, while, or other control structure

	ob_flush();
	flush();

// End Operational loop


ob_flush();
flush();
ob_end_clean();

// Sequential closing code if any that does not need buffer flushing goes here

echo "Done!";

?>
