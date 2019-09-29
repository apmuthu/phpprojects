<?php
/*
// Program         : Obtain Exchange Rate from x-rates.com
// Author          : Ap.Muthu <apmuthu@usa.net>
// Version         : 1.0
// Release Date    : 2019-09-28
// Example Usage 1 : xrates.php => download TSV listing of date and rates;
// Example Usage 2 : x-rates.php?sql=1 => displays insert sqls;
*/

/*
CREATE TABLE `xrates` (
  `RateDT` datetime NOT NULL,
  `Currency` char(4) NOT NULL,
  `Rate` float(15,6) DEFAULT NULL,
  PRIMARY KEY (`RateDT`,`Currency`)
) ENGINE=MyISAM;
*/

// Gets the Forex Rates for 1 USD from x-rates.com - needs TLS capability on server
$sqltable = 'xrates';
$url      = 'https://www.x-rates.com/table/?from=USD&amount=1';
/*
$arrContextOptions=array(
      "ssl"=>array(
            "verify_peer"=>false,
            "verify_peer_name"=>false,
        ),
    );  
$content = file_get_contents($url, false, stream_context_create($arrContextOptions));
*/

$content = file_get_contents($url);
$a = explode ('<span class="ratesTimestamp">', $content);
$b = explode('</span>', $a[2]);
$ratedate = strtotime($b[0]);
$date = date('Y-m-d H:i:s', $ratedate);
$fdate = date('YmdHis', $ratedate);
$c = explode('tbody>', $a[2]);
$d = explode('<td>',$c[1]);
array_shift($d);
//$rates = array();
$sql = "INSERT INTO $sqltable VALUES ";
$rates_tsv="";
foreach($d as $row) {
	$e = explode('http://www.x-rates.com/graph/?from=USD&amp;to=', $row);
	$f = explode("'>", $e[1]);
	$toCur = $f[0];
	$g = explode('</a>', $f[1]);
	$val = $g[0];
//	$rates[$toCur] = $val;
	$sql .= "\n('" . $date . "','". $toCur . "','" . $val . "'),";
	$rates_tsv .= "$date\t$toCur\t$val\n";
}

if (isset($_REQUEST['sql'])) {
	$sql = substr($sql,0,strlen($sql)-1) . ";\n";
	echo $sql;
} else {
	$filename = 'xrates_'.$fdate.'.tsv';
	header('Content-Type: application/x-csv'); // adjust according to the server platform
	header('Content-Length: '.strlen( $rates_tsv ));
	header('Content-disposition: inline; filename="' . $filename . '"');
	header('Cache-Control: public, must-revalidate, max-age=0');
	header('Pragma: public');
	header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	echo $rates_tsv;
}