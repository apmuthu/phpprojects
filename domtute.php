<?php
/*
// Program        : PHP DOMDocument for different PHP versions
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2020-01-26
// Reference      : https://stackoverflow.com/questions/35845819/fatal-error-cannot-use-object-of-type-domnodelist-as-array
// Ref: PHP 5.3.0 : https://code.google.com/archive/p/php-sql-parser/downloads
// Notes: DOMNodeList as array syntax for PHP v5.6.3 and above vs before that version
//        getElementsByTagName() returns a DOMNodeList, which implements ArrayAccess as of PHP 5.6.3. This is what allows you to access a node within via $cells[0].
//        In prior versions you'll need to use DOMNodeList's item() method to access a specific index, e.g. $cells->item(0).
*/

*/

$html = '<html>
<head><title>Tute</title></head>
<body>
<div id="mango">
This is the mango div. It has some text and a form too.
<form>
<input type="text" name="first_name" value="Yahoo" />
<input type="text" name="last_name" value="Bingo" />
</form>

<table class="inner">
<tr><td>Happy</td><td>Sky</td></tr>
</table>
</div>

<table id="data" class="outer">
<tr><td>Happy</td><td><span>Sky</span></td></tr>
<tr><td>Happy</td><td><span>Moon</span></td></tr>
<tr><td>Happy</td><td>Sky</td></tr>
<tr><td>Happy</td><td>Sky</td></tr>
<tr><td>Happy</td><td>Sky</td></tr>
</table>
</body>
</html>';

$dom = new DOMDocument;
libxml_use_internal_errors(true); // suppress non-well formed html5 errors
$dom->loadHTML($html); 
$dom->preserveWhiteSpace = false;
$tables = $dom->getElementsByTagName('span');
/*
foreach($tables as $table) {
//	if ($table->nodeValue == 'Moon')
		echo $dom->saveXML($table) . "<br>\n";
}
*/


// In PHP < v5.6.3, only the following works:
echo $tables->item(1)->nodeValue; // Moon

// In PHP v5.6.3 onwards, the following also works and is preferred:
// echo $tables[1]->nodeValue;

?>
