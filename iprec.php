<?php
define('IS_DEBUG', FALSE);
define('IPSEP',    CHR(9));

// , 'LocName' => 'LocPwd'
$authloc = Array(
  'Home' => 'abcWe2541'
, 'Office'   => 'KgRe4276'
);

$p = isset($_REQUEST['b']) ? $_REQUEST['b']   : FALSE;

$loc = FALSE;

if ($p === FALSE) exit;
if (($loc = array_search($p, $authloc)) === FALSE) exit;


$ip = getip();
$ip = trim($ip);

if (IS_DEBUG) echo $ip . "\n";

// $ipmsg = '$iprecs[] = Array("' . date("Y-m-d H:i:s") . '", "' . $loc . '", "' . $ip . '");' . "\n";
$ipmsg = date("Y-m-d H:i:s") . IPSEP . $loc . IPSEP . $ip . "\n";

if (IS_DEBUG) echo $ipmsg;

$filename    = "iprecords_$loc.txt";
$filename_last_ip    = "ip_last_$loc.txt";
$c =  readlastline($filename);
$a = explode("\t", $c);
$old_ip = $a[2];

if ($ip != $old_ip) saveip($ipmsg, $filename);
file_put_contents($filename_last_ip, $ipmsg);
echo $ip;

function validip($ip) {

	if (empty($ip))
		return false;

	if ((ip2long($p) == -1) or (ip2long($p) === false))
		return false;

	$reserved_ips = array (
			array('0.0.0.0','2.255.255.255'),
			array('10.0.0.0','10.255.255.255'),
			array('127.0.0.0','127.255.255.255'),
			array('169.254.0.0','169.254.255.255'),
			array('172.16.0.0','172.31.255.255'),
			array('192.0.2.0','192.0.2.255'),
			array('192.168.0.0','192.168.255.255'),
			array('255.255.255.0','255.255.255.255')
			);

	foreach ($reserved_ips as $r) {

		$min = ip2long($r[0]);
		$max = ip2long($r[1]);
		if ((ip2long($ip) >= $min) && (ip2long($ip) <= $max)) return false;
	}

	return true;
}

function getip() {
	if (isset($_SERVER["HTTP_CLIENT_IP"]) && validip($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
			if (validip(trim($ip))) {
				return $ip;
			}
		}
	}
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && validip($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]) && validip($_SERVER["HTTP_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED"]) && validip($_SERVER["HTTP_FORWARDED"])) {
		return $_SERVER["HTTP_FORWARDED"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED"]) && validip($_SERVER["HTTP_X_FORWARDED"])) {
		return $_SERVER["HTTP_X_FORWARDED"];
	} else {
		return $_SERVER["REMOTE_ADDR"];
	}
}

function saveip($somecontent, $filename) {
// $somecontent = "Dynamic IP List with Hosts\n";

// Let's make sure the file exists and is writable first.
	if (is_writable($filename)) {

    // Opening $filename in append mode.
    // The file pointer is at the bottom of the file hence
    // that is where $somecontent will go when we fwrite() it.
		if (!$handle = fopen($filename, 'a')) {
			if (IS_DEBUG) echo "Cannot open file ($filename)\n";
			exit;
		}

    // Write $somecontent by appending to our opened file.
		if (fwrite($handle, $somecontent) === FALSE) {
			if (IS_DEBUG) echo "Cannot write to file ($filename)\n" ;
			exit;
		}

		if (IS_DEBUG) echo "Success, wrote ($somecontent) to file ($filename)\n";

		fclose($handle);

	} else {
		if (IS_DEBUG) echo "The file $filename is not writable\n";
	}

}

function readlastline($filename) {
// http://stackoverflow.com/questions/1510141/read-last-line-from-file
	$line = '';

	$f = fopen($filename, 'r');
	$cursor = -1;

	fseek($f, $cursor, SEEK_END);
	$char = fgetc($f);

/**
 * Trim trailing newline chars of the file
 */
	while ($char === "\n" || $char === "\r") {
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}

/**
 * Read until the start of file or first newline char
 */
	while ($char !== false && $char !== "\n" && $char !== "\r") {
    /**
     * Prepend the new char
     */
		$line = $char . $line;
		fseek($f, $cursor--, SEEK_END);
		$char = fgetc($f);
	}

	return $line;
}
