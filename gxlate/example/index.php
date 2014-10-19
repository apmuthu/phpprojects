<?php 
include "../gxlate.php";

include "giftcards_lang.php";

$lf = chr(10);
$output = '';

foreach ($lang as $key => $msgstr) {
    $trstr = get_tamil($msgstr, 'ta');
    $output .= '$lang['."'".$key."'] = '".$trstr."';" . $lf;
}
$output = "<"."?php" . $lf . $output . "?".">" . $lf;

echo $output;

