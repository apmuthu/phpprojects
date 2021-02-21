<?php
/*
// Program        : Correct end times in SRT to match start times of next subtitle in Youtube Auto CC
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2021-02-21
// Notes          : Youtube Auto Closed Captions have overlapping subtitle end times replaced here with succeeding start times.
// Dependency     : Get output Subtitle SRT file from Google2SRT for Youtube Video URL
// Location       : https://sourceforge.net/projects/google2srt/files/Google2SRT/0.7.10/google2srt-0.7.10.msi
// Other SRT URLs : https://savesubs.com/ , https://www.dvdvideosoft.com/online-youtube-subtitles-download
// Reference      : https://thinkmobiles.com/blog/how-to-download-youtube-subtitles/
*/

$a = file_get_contents('input.srt');
if(bin2hex(substr($a,0,3)) == 'efbbbf') $a = substr($a,3); // strip BOM in UTF-8 encoding
$a = str_replace("\r\n", "\n", $a); // CRLF => LF
$a = str_replace("\n\n\n", "", $a); // End of SRT
$b = explode("\n\n", $a);
$b = array_filter($b);
$b = array_reverse($b);

$start = '';
foreach ($b as $k => $c) {
	$d = '';
	$d = explode("\n", $c);
	if(!isset($d[1])) continue;
	$e = '';
	$e = explode(" ", $d[1]);
	if ($e[1] == '-->') {
		if ($start <> '') {
		$e[2] = $start;
		}
		$start = $e[0];
		$d[1] = implode(" ", $e);
	}
	$b[$k] = implode("\n", $d);
}
$b = array_reverse($b);

$a = implode("\n\n", $b);
file_put_contents("output.srt", $a);
echo "done";

