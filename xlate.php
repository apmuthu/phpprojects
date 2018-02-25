<?php 
/*
 * The xlate source for the website http://paulschou.com/tools/xlate/
 * Alternate location: http://home2.paulschou.net/tools/xlate/
 *                     http://home3.paulschou.net/tools/xlate/
 * Archived location: http://web.archive.org/web/20111217015137/http://home1.paulschou.net/tools/xlate
 *                    http://web.archive.org/web/20120124061748/http://home1.paulschou.net/tools/xlate/source.php
 *   By using this source code you agree to do the following:
 *   - Link back to my site in some manner to show support
 *   - Use -> Modify -> Share (aka: GNU License)
 *
 * If you find youself unable to perform these tasks, this source code
 *   is *not* for you and should be deleted now.
 *
 */ // P.S. Donations are always appreciated. :-)

static $binary;
static $ascii;
static $hex;
static $b64;
static $char;

?>
<html>
<head>
<title>TRANSLATOR, BINARY</title>
<style>
.ff{font-size: 10px;
	font-family:verdana,arial,helvetica,sans;
	color: #333333;
	background: #eee;
	}
.btn{
	font-size: 8px;
	font-family:verdana,arial,helvetica,sans;
	color: #333333;
	background: #eee;
	}
BODY{
scrollbar-3dlight-color:#999999;
scrollbar-arrow-color:#999999;
scrollbar-base-color:#DDDDDD;
scrollbar-darkshadow-color:#999999;
scrollbar-face-color:#DDDDDD;
scrollbar-highlight-color:#DDDDDD;
scrollbar-shadow-color:#DDDDDD;
scrollbar-track-color:#CCCCCC;
}

</style>

</head>
<body bgcolor="#ffffff" text="#000">

<center>
<table border=0 cellspacing=0 cellpadding=0><tr><td align=center>
<font face="verdana,arial,helvetica" size=1>
<h1>TRANSLATOR, BINARY</h1>
<p><b>Please note:</b><br> This application encodes and decodes 
<a href="http://en.wikipedia.org/wiki/ASCII">ASCII</a> and 
<a href="http://en.wikipedia.org/wiki/ANSI">ANSI</a> 
text.  <br>Only codepoints &lt; 128 are ASCII.  This is provided for educational and entertainment use only.<br>
<a href="rot13.html">ROT13 Online Convertor</a></p>

<table border=0 cellspacing=0 cellpadding=10>
<tr><form method="POST"><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>[ <a href="http://home2.paulschou.net/tools/ascii/">TEXT</a> ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="ascii" class="ff"><?php

if (function_exists('set_magic_quotes_runtime')) set_magic_quotes_runtime(0);
foreach($_POST as $key=>$val){ $$key = stripslashes($val); }

#$_POST[ascii] = str_replace("\\'","'",$_POST[ascii]);
#$_POST[ascii] = str_replace("\\\"","\"",$_POST[ascii]);
#$_POST[ascii] = str_replace("\\\\","\\",$_POST[ascii]);
if($ascii != "") print htmlentities($ascii);
else {

if($binary != "") {
	$binary_ = preg_replace("/[^01]/","", $binary);
	for($i = 0; $i < strlen($binary_); $i = $i + 8)
	$ascii = $ascii.chr(bindec(substr($binary_, $i, 8)));
}

if($hex != "") {
	$hex_ = preg_replace("/[^0-9a-fA-F]/","", $hex);
	for($i = 0; $i < strlen($hex_); $i = $i + 2)
	$ascii = $ascii.chr(hexdec(substr($hex_, $i, 2)));
}

if($b64 != "") {
	//$ascii = gzinflate($gzip);
	$ascii = base64_decode($b64);
}

if($char != "") {
	$char_ = preg_split("/\\D+/",trim($char));
	foreach ($char_ as $key)
	$ascii = $ascii.chr($key);
}

echo htmlentities($ascii);
}

?></textarea>
<br>
<input type="submit" class="btn" value="&lt; ENCODE &gt;">
</td></form><form method="POST"><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>2 [ <a href="http://en.wikipedia.org/wiki/Binary_numeral_system"><acronym title="Binary">BINARY</acronym></a> ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="binary" class="ff"><?php

if($binary != "") echo $binary;
else if($ascii != "") {
$val = strval(decbin(ord(substr($ascii, 0, 1))));
echo str_repeat("0", 8-strlen($val)).$val;
for($i = 1; $i < strlen($ascii); $i = $i + 1) {
$val = strval(decbin(ord(substr($ascii, $i, 1))));
echo " ".str_repeat("0", 8-strlen($val)).$val;
}
}

?></textarea>
<br>
<input type="submit" class="btn" value="&lt; DECODE &gt;">
</td></form><form method="POST"><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>4 [ <a href="http://en.wikipedia.org/wiki/Hexidecimal"><acronym title="Hexidecimal">HEX</acronym></a> ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="hex" class="ff"><?php

if($hex != "") echo $hex;
else if($ascii != "") {
$val = dechex(ord(substr($ascii, 0, 1)));
echo str_repeat("0", 2-strlen($val)).$val;
for($i = 1; $i < strlen($ascii); $i = $i + 1) {
  $val = dechex(ord(substr($ascii, $i, 1)));
  echo " ".str_repeat("0", 2-strlen($val)).$val;
}
}


?></textarea>
<br>
<input type="submit" class="btn" value="&lt; DECODE &gt;">
</td></tr></form>
<?php
/*
<!--OCT-->
<form method="POST"><tr><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>3 [ OCT ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="oct" class="ff"><?php

if($oct != "") echo $oct;
else if($ascii != "") {
	$val = 0;
	for($i = 0; $i < strlen($ascii); $i = $i + 3) {
		$val = ord(substr($ascii, $i, 1));
		$val = $val * 256 + ord(substr($ascii, $i + 1, 1));
		$val = $val * 256 + ord(substr($ascii, $i + 2, 1));
		//echo "debug $val topbit = ".intval($val / 64 / 64 / 64)."\n";
		printf("%08d",oct_decode($val));
		$val = 0;
	}
	if($val > 0) echo oct_decode($val);
}

function b64_decode($val) {
$tab = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/";
if($val >= 64) return oct_decode(intval($val / 64))."".substr($tab,$val%64,1);
return substr($tab,$val,1);
}
function oct_decode($val) {
if($val >= 8) return oct_decode(intval($val / 8))."".($val%8);
return "".$val;
}
*/
?></textarea>
<br>
<?php //<input type="submit" class="btn" value="&lt; DECODE &gt;">?>
</td></form>

<!--BASE 64-->
<form method="POST"><tr><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>6 [ <a href="http://en.wikipedia.org/wiki/Base64">BASE64</a> ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="b64" class="ff"><?php

if($b64 != "") echo $b64;
else if($ascii != "") {
echo base64_encode($ascii);
//$gzip = gzencode($ascii, 9);
//echo substr($gzip,10,strlen($gzip)-19);
}

?></textarea>
<br>
<input type="submit" class="btn" value="&lt; DECODE &gt;">
</td></form>

<!--CHAR-->
<form method="POST"><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>

<b>[ DEC / CHAR ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="char" class="ff"><?php

if($char != "") echo $char;
else if($ascii != "") {
echo ord(substr($ascii, 0, 1));
for($i = 1; $i < strlen($ascii); $i = $i + 1)
echo " ".ord(substr($ascii, $i, 1));
}


?></textarea>
<br>
<input type="submit" class="btn" value="&lt; DECODE &gt;">
</td></form><form method="POST"><td align=center valign=top>
<font face="verdana,arial,helvetica" size=1>


<b>[ MESSAGE DIGEST / CHECK SUM ]</b><br>
<textarea cols=48 rows=15 wrap="virtual" name="char" class="ff"><?php

$tmpfname = tempnam("/tmp", "xlate");
$handle = fopen($tmpfname, "w");
fwrite($handle, $ascii);
fclose($handle);

#echo "MD2: ".exec("/home/paulscho/bin/md2 $tmpfname")."\n";
echo "MD2: ".openssl("md2",$tmpfname)."\n";
#echo "MD4: ".exec("/home/paulscho/bin/md4 $tmpfname")."\n";
echo "MD4: ".openssl("md4",$tmpfname)."\n";
echo "MD5: ".md5($ascii)."\n";
echo "CRC 8, ccitt, 16, 32 : ".
#  exec("/home/paulscho/bin/crc8 $tmpfname").", ".
#  exec("/home/paulscho/bin/crcc $tmpfname").", ".
#  exec("/home/paulscho/bin/crc16 $tmpfname").", ".
  exec("/usr/bin/crc32 $tmpfname")."\n\n";
#crc32($ascii)."\n\n";
echo "CRYPT (form: $ MD5? $ SALT $ CRYPT):\n".crypt($ascii)."\n";
echo "      (form: SALT[2] CRYPT[11]):\n".crypt($ascii,"ps")."\n\n";
#include("sha1lib.class.inc.php");
#$sha = new Sha1Lib;

#echo "SHA1:".base64_encode($sha->str_sha1($ascii))."\n";
$sha1 = explode("= ",exec("/usr/bin/openssl dgst -sha1 $tmpfname"));
echo "SHA1: $sha1[1]";
#$ascii = $sha->str_sha1($ascii);
#for($i = 1; $i < strlen($ascii); $i = $i + 1) {
#  $val = dechex(ord(substr($ascii, $i, 1)));
#  echo "".str_repeat("0", 2-strlen($val)).$val;
#}
echo "\n";
#echo "RIPEMD-160: ".splitn(60,exec("/home/paulscho/bin/ripemd160 $tmpfname"))."\n";
echo "RIPEMD-160: ".splitn(60,openssl("rmd160",$tmpfname))."\n";
#echo "SHA2-256: ".split32(exec("/home/paulscho/bin/sha2-256 $tmpfname"))."\n";
#echo "SHA2-384: ".split32(exec("/home/paulscho/bin/sha2-384 $tmpfname"))."\n";
#echo "SHA2-512: ".split32(exec("/home/paulscho/bin/sha2-512 $tmpfname"))."\n";
unlink($tmpfname);

function openssl($dgst = "sha1", $filename) {
$sha1 = explode("= ",exec("/usr/bin/openssl dgst -$dgst $filename"));
return trim($sha1[1]);
}

?></textarea>
<br>
(This cannot be decoded<sup>*</sup>)
</td></tr></form></table>


<br>
<sup>*</sup>Cannot be decoded easily (within my lifespan).
The source code for this page is available <a href="http://home2.paulschou.net/tools/xlate/source.php">here</a>.<br>
Credit for this idea goes to <a href="http://nickciske.com/binary/">nickciske.com/binary</a> in its original form in 2000.
</center>
<?php
function split32($text) {
	$string = "";
	for($i = 0; $i < strlen($text); $i = $i + 32) {
		$string = "$string\n  ".substr($text, $i, 32);
	}
	return $string;
}
function splitn($n,$text) {
	$string = "";
	for($i = 0; $i < strlen($text); $i = $i + $n) {
		$string = "$string\n  ".substr($text, $i, $n);
	}
	return $string;
}
?>
</body>
</html>
