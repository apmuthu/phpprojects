<?php
/*
// Program       : Parse a gettext template PO file to extract the translation keys
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-11-05
// Last Update   : 2017-11-12
//
// $src - location of the PO template
// $keys - base name of the output key file
// $keys_t - base name of the translation output key file
// Translation context not provided for.
// Use $keys_t file in Google Translate for bulk translation of string to any target language.
*/
//$src = '../frontac/install.off/lang/new_language_template/LC_MESSAGES/empty.po';
//$src = '../frontac/lang/new_language_template/LC_MESSAGES/empty.po';
//$src = '../frontac24/install.off/lang/new_language_template/LC_MESSAGES/empty.po';
$src = '../frontac24/lang/new_language_template/LC_MESSAGES/empty.po';

$keys = 'FA24_en';

$lf = chr(10);

$keys_t  = $keys.'_tx';
$keys   .= '.txt';
$keys_t .= '.html';

$a = file_get_contents($src);
$a = str_replace(chr(13), '', $a); // remove CR
$a = str_replace('"'.$lf.'"', '', $a); // make each string on a single line
$a = explode($lf, $a);
$lines = '';
$h = fopen($keys, "w");
$t = fopen($keys_t, "w");
fwrite($t, '<html><head><title>FA Translations</title></head>' . $lf . '<body><pre>' . $lf);
foreach ($a as $line) {

	if (substr($line, 0, 7) == 'msgid "' && substr($line, 0, 8) <> 'msgid ""') {
		$base_string = substr($line, 7, -1);
		fwrite($h, $base_string . $lf);

		$base_string = str_replace(' & ', '###|###', $base_string);
		$base_string = str_replace('&', '', $base_string); // remove only hotkey parts of such strings
		$base_string = str_replace('###|###', ' & ', $base_string);
		fwrite($t, $base_string . $lf);

	}
}
fclose($h);
fwrite($t, '</pre></body>' . $lf . '</html>' . $lf);
fclose($t);
echo '<a href="./' . $keys .   '" download>Download Translation Keys</a><br><br>' . $lf;
echo '<a href="./' . $keys_t . '" download>Download Keys for translation</a><br><br>';

?>
