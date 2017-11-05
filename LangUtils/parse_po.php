<?php
/*
// Program       : Parse a gettext template PO file to extract the translation keys
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-11-05
//
// $src - location of the PO template
// $keys - name of the output key file
// Translation context not provided for.
// Use output in Google Translate for bulk translation of string to any target language.
*/

$src = '../frontac24/lang/new_language_template/LC_MESSAGES/empty.po';
$keys='FA242_en.txt';

$a = file_get_contents($src);
$a = str_replace(chr(13), '', $a); // remove CR
$a = str_replace('"'.chr(10).'"', '', $a); // make each string on a single line
$a = explode(chr(10), $a);
$lines = '';
$h = fopen($keys, "w");
foreach ($a as $line) {

	if (substr($line, 0, 7) == 'msgid "' && substr($line, 0, 8) <> 'msgid ""') {
//		$lines .= substr($line, 7, -1) . chr(10);
		fwrite($h, substr($line, 7, -1) . chr(10));
	}
}
fclose($h);
echo '<a href="./'.$keys.'">Download Translation Keys</a>';


?>
