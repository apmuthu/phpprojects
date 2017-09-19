<?php
/*
// Program       : Show NetGear ADSL Router WAN IP
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-09-19
// Tested on     : NetGear DG834G
// Example Usage : php.exe grab_router_ip.php
*/

// Router credentials

$rt_user = "admin";
$rt_pass = "MySecretRouterPassword";
$baseurl='192.168.0.1'; // router management interface LAN IP
// $baseurl='www.routerlogin.com';

$url = "http://".$rt_user.":".$rt_pass."@".$baseurl."/setup.cgi?next_file=s_status.htm";
$a = file_get_contents($url);
sleep(2); // seconds

$b = explode('<td width="50%"><b>IP Address </b></td>', $a);
$IP = get_inner_str($b[1]);
echo $IP;

function get_inner_str($str) {
	$strip_str = array('<strong>', '</strong>', "\t", "\r", "\n");
	$str = str_replace($strip_str, '', $str);
	$x = explode('>', $str);
	$y = explode('<', $x[1]);
	return trim($y[0]);	
}

?>
