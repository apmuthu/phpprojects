<?php 
/*
URL Parameters
 - d = start data (yyyy-mm-dd)
 - n - optional number of days
 - registrar is hardcoded at line 27
 - if saved files are stored in the same folder, then they are taken
 - example: http://localhost/domain_lister.php?d=2014-08-10&n=2
 
Source of data from URLs like:
 - http://www.dailychanges.com/net4india.com/2014-08-24/
 - Such data are available only from 2014-08-06 onwards as a single csv for each date

CREATE TABLE `domainlist` (
  `registrar` varchar(100) NOT NULL,
  `chdate` date NOT NULL,
  `domainname` varchar(200) NOT NULL,
  `chtype` varchar(10) NOT NULL,
  `svrname` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`registrar`,`chdate`,`domainname`,`chtype`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

*/

$sql = '';
// $domain = 'net4india.com';
$domain = 'worldnic.com';
$sdate = new DateTime($_REQUEST['d']);
$tpfx = $sdate->format("Y-m-");
$edate = new DateTime($_REQUEST['d']);
if (isset($_REQUEST['n'])) {
	$DI = "P" . ($_REQUEST['n'] - 1) . "D";
	$edate = date_add($edate, new DateInterval($DI));
}
$d_start = $sdate->format("d")+0;
$tilldays = $edate->format("d")+0;
// echo $d_start . ' - ' . $tilldays . ' == ' . $DI;
// exit;

for ($d=$d_start; $d <= $tilldays; $d++) {

	$date = $tpfx . str_pad($d, 2, '0', STR_PAD_LEFT);

	$base_url = "http://www.dailychanges.com/export/$domain/$date/";
	$data_url = $base_url . 'export.csv';
	$filename = $domain . '-' . str_replace('-','',$date) . '.csv';

	$variablee = ( file_exists($filename) ? file_get_contents($filename) : get_data($data_url, $base_url) );

	$a = explode("\r\n", $variablee);
	$c = Array();
	$i = 0;
	foreach ($a as $b) {
		if (!(substr($b, 0,1) == '#' || 
			substr($b,0,20) == 'domain,change,server' || 
			$b == '')) {
			$c[$i] = explode(",", $b);
			$sql .= "INSERT IGNORE INTO domainlist (registrar, chdate, domainname, chtype, svrname) VALUES ('$domain', '$date', '" . $c[$i][0] . "', '" . $c[$i][1] . "', '" . $c[$i][2] . "');\n"; 
			$i++;
		}
	}
}
// echo print_r($c, true);
echo $sql;


// Functions 

function get_data($url, $refurl='') {
  $ch = curl_init();
  $timeout = 5;
  curl_setopt($ch, CURLOPT_URL, $url);
  //curl_setopt($ch, CURLOPT_POST, TRUE);             // Use POST method
  //curl_setopt($ch, CURLOPT_POSTFIELDS, "var1=1&var2=2&var3=3");  // Define POST values
  curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 6.0)");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  if (strlen($base_url) > 0) curl_setopt($ch, CURLOPT_REFERER, $refurl);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,false);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER,false);
  curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
  $data = curl_exec($ch);
  curl_close($ch);
  return $data;
}
?>
