<?php
/*
// Program       : Merge the translations and the keys for the body of a gettext PO file
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-11-05
// Last Update   : 2017-11-06
//
// $src - location of the translation keys (English) file
// $trn - location of target language translated strings file
//
// Screen output is the body of the target PO translated file.
// Merge screen output with appropriate PO header to get PO file
// Upload newly created PO file in Transifex to fill missing strings
//
// Google Translation of templated strings:
// http://translate.google.com/translate?js=n&sl=auto&tl=destination_language&u=http://example.net
// FA 2.4.2+ to Hindi: http://translate.google.com/translate?js=n&sl=auto&tl=hi&u=http://www.sacollege.net/FA242en.html
//
// Google language support: https://cloud.google.com/translate/docs/languages
// Google translation language codes: https://sites.google.com/site/tomihasa/google-language-codes
*/

$src = 'FA242_en.txt'; // The translation keys
$trn = 'hi_IN-2.4.2-1_hindi.txt'; // Target Language strings taken from Google Translation
$s   = 1; // Starting String
$n   = 3302; // Ending String

$lf = chr(10);

if (!file_exists($src) || !file_exists($trn)) die ('Missing Source and/or Translation file(s).');

$src = explode($lf, file_get_contents($src));
$trn = explode($lf, file_get_contents($trn));
$mis = '';
$po = '';
for ($i = $s-1; $i < $n; $i++) {
	$srcstr = str_replace(chr(13), '', $src[$i]);
	$po .= 'msgid "' . $srcstr . '"'.$lf;
	$a = $trn[$i];
	$a = str_replace(chr(13), '', $a);
	if (strlen($a) == 0) $mis .= $srcstr . $lf;
	$a = str_replace('&amp;', '', $a);
	$a = str_replace(' \ N ', '\n', $a);
	$a = str_replace('\ t ', '\t', $a);
	$a = str_replace('% d', '%d', $a);
	$a = str_replace('% s', '%s', $a);
	$a = str_replace('% S', '%s', $a);
	$a = str_replace(':%s', ': %s', $a);
	$pos = strpos($a,'%');
	$prevchar = substr($a,$pos-1,1);
	if ($pos !== false && $pos>0 && !in_array($prevchar, array(' ','#', '(', "'"))) $a = stringInsert($a, ' ', $pos);
	if (strstr($a, '&') && !strstr($a, ' & ')) $a = str_replace('&', '', $a);
	$po .= 'msgstr "'.$a.'"'.$lf .$lf;
}
session_start();
$_SESSION['missing'] = $mis;
$_SESSION['po_pairs'] = $po;

if (strlen($mis) == 0) echo 'No Missing Strings';
else echo '<div><a href="makefile.php?fn=missing">Download Missing Translation Strings</a></div><br>';

echo '<div><a href="makefile.php?fn=po_pairs">Download PO Paired Translation Strings</a></div><br>';

// echo $po;


function stringInsert($str,$insertstr,$pos)
{
    $str = substr($str, 0, $pos) . $insertstr . substr($str, $pos);
    return $str;
}
