<?php
/*
	Purpose: Strip line feeds in quoted strings
	Author : Ap.Muthu <apmuthu@usa.net>
	Release: 2020-01-24
	Notes  : Beware of \" type strings as they will get in the way
	Excel  : SUBSTITUTE(A1, CHAR(10), " ") # Strips Line Feeds
	Excel  : ALT-Enter # Inserts a Line Feed
*/

$a = file_get_contents('./source.csv');
$b = explode('"', $a);
unset ($a);
$c = '';
foreach ($b as $k => $v) {
	if ($k%2 == 1) {
		$v = str_replace("\r","",$v);
		$v = str_replace("\n"," ",$v);
	}
	$c .= $v;
}
file_put_contents('./output.csv', $c);