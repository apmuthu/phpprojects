<?php
set_time_limit(0);
ini_set('default_socket_timeout', 300); // 300 Seconds = 5 Minutes

$brlf = "<BR>" . chr(10);

$outfile_pfx = "output/Treasure-Island_";
$base_url = "http://pyaretoons.pyaretoonsforum.com//ComicPages/928/Desktop/Treasure-Island-Walt-Disney-%5BEnglish%5D_PyareToons_Page_";
$padlen = 3;
$ext = ".jpg";
$stdigit = 0;
$padstr = "0";
$numfiles = 30;

ob_start();
header('Content-Type: text/html; charset=utf-8');
while (ob_get_level()) ob_end_flush();
ob_implicit_flush(true);
echo "This page acquires Sequential files" . $brlf;

for ($i = $stdigit; $i < $numfiles; $i++) {
	$file_idx = str_pad($i, $padlen, $padstr, STR_PAD_LEFT);
	$filenum = $i+1;
	$filename = $base_url . $file_idx . $ext;
	$outfile = $outfile_pfx . $file_idx . $ext;
//	echo "<a href='" . $filename . "'>Page " . $filenum . "</a>" . $brlf;

	ob_flush();
	flush();

	if (!file_exists($outfile)) {
		$a = file_get_contents("$filename");
		file_put_contents($outfile, $a);
		echo "Processed File" . $filenum  . $brlf;
	} else {
		echo "Skipped File" . $filenum . " since it already exists" . $brlf;
	}
}

ob_flush();
flush();
ob_end_clean();

echo "Done!";

?>
