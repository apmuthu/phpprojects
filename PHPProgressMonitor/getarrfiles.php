<?php
set_time_limit(0);
ini_set('default_socket_timeout', 300); // 300 Seconds = 5 Minutes

$brlf = "<BR>" . chr(10);

$outfile_pfx = "output/TNEA2014_Col_";
$base_url = "http://www.annauniv.edu/tnea2014/coll_details14/colpdf/";
$padlen = 0;
$ext = ".PDF";
$stdigit = 0;
$padstr = "0";
$IdxArray = Array(
  1
, 2
, 3
, 4
, 1013
, 1014
, 1015
, 1026
, 1101
, 1102
);
$numfiles = count($IdxArray);

// comment out next line if $IdxArray has elements
// $numfiles = 32;

ob_start();
header('Content-Type: text/html; charset=utf-8');
while (ob_get_level()) ob_end_flush();
ob_implicit_flush(true);
echo "This page acquires Sequential files from Array" . $brlf;

for ($i = 0; $i < $numfiles; $i++) {
	$idx = (count($IdxArray) > 0) ? $IdxArray[$i] : $i+$stdigit;
	$file_idx = ($padlen == 0) ? $idx : str_pad($idx, $padlen, $padstr, STR_PAD_LEFT);
	$filenum = $i+1;
	$filename = $base_url . $file_idx . $ext;
	$outfile = $outfile_pfx . $file_idx . $ext;
//	echo "<a href='" . $filename . "'>Page " . $filenum . "</a>" . $brlf;

	ob_flush();
	flush();

	if (!file_exists($outfile)) {
		$a = @file_get_contents("$filename");
		if ($a === FALSE) {
			echo "File" . $filenum . " not on server" . $brlf;
		} else {
			file_put_contents($outfile, $a);
			echo "Processed File" . $filenum  . $brlf;
		}
	} else {
		echo "Skipped File" . $filenum . " since it already exists" . $brlf;
	}
}

ob_flush();
flush();
ob_end_clean();

echo "Done!";

?>
