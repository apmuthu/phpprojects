<?php
/*
// Program       : To dynamically get_base_url() depending on source request
                   cidr_match() checks if the given ip is within the subnet range
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-11-18
// Last Updated  : 2017-11-18
// Note          : Made for IPv4. Uses Unsigned integers for IP variables.
*/

function get_base_url() {
	// $_SERVER['SERVER_ADDR'] will provide 127.0.0.1 or LAN IP based on where the request came from
	if (cidr_match($_SERVER['REMOTE_ADDR'], '192.168.1.0/24')) 
		$base_url = 'http://192.168.1.20/projects/myapp'; // IP of server for LAN use
	elseif (cidr_match($_SERVER['REMOTE_ADDR'], '127.0.0.1/32'))
		$base_url = 'http://localhost/projects/myapp'; // IP of server for localhost use
	else
		$base_url = 'http://www.publicdomain.com/projects/myapp'; // Domain URL for WAN use
	return $base_url;
}

function cidr_match($ip, $range)
{
    list ($subnet, $bits) = explode('/', $range);
    $ip = ip2long($ip);
    $ip = sprintf("%u", $ip);
    $subnet = ip2long($subnet);
    $subnet = sprintf("%u", $subnet);
    $mask = -1 << (32 - $bits);
	$mask = sprintf("%u", $mask);
    $subnet &= $mask; # nb: in case the supplied subnet wasn't correctly aligned
    return ($ip & $mask) == $subnet;
}
?>
