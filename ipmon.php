<?php
/*
// Program        : To obtain the status of various devices in a network using PING
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2020-11-06
// Dependency     : Each monitored machine must allow ICMP Protocol for Ping to be enabled
// Documentation  : https://www.geeksforgeeks.org/difference-between-icmp-and-igmp/
*/

/*
// Create a file IPs.txt with tab separated values of IPs and hostnames like:

# Tab Separated Values
192.168.1.1	Router
192.168.1.2	WiFi AP
192.168.1.10	Dave Laptop
# 192.168.1.15 Self XAMPP

*/

// Sample Output
/*
2020-11-06 22:15:57 Fine 192.168.1.1 Router
2020-11-06 22:15:57 Fine 192.168.1.2 WiFi AP
2020-11-06 22:15:57 Down 192.168.1.10 Dave Laptop
*/

function ping($ip) {
	// arp -a is also another way to check live hosts - quicker
	// In Linux, nmap and arp -n are other ways
	$ping =  shell_exec('ping -n 1 '. $ip);
	$state = (strpos($ping, 'Request timed out.') > 0) ? 'Down' : 'Fine';
	return $state;
}

$filename = "IPs.txt";
$contents = file_get_contents($filename);
$contents = str_replace("\r", "", $contents); // remove CRs
$IPs = explode("\n",$contents);
$output = '';
foreach ($IPs as $k => $v) {
	$v = trim($v);
	if (strlen($v) == 0) continue; // skip blank lines
	if (substr($v,0,1) == "#") continue; // skip comments
	list($IP, $Machine) = explode("\t",$v);
	$output .= date('Y-m-d H:i:s') . ' '  . ping($IP) . ' ' . $IP . ' ' . $Machine . "\n";
}
echo "<pre>$output</pre>";

// Can place in a log file or take into database

/*
C:\Prompt>ping 192.168.1.1

Pinging 192.168.1.1 with 32 bytes of data:

Reply from 192.168.1.1: bytes=32 time<1ms TTL=255
Reply from 192.168.1.1: bytes=32 time<1ms TTL=255
Reply from 192.168.1.1: bytes=32 time<1ms TTL=255
Reply from 192.168.1.1: bytes=32 time<1ms TTL=255

Ping statistics for 192.168.1.1:
    Packets: Sent = 4, Received = 4, Lost = 0 (0% loss),
Approximate round trip times in milli-seconds:
    Minimum = 0ms, Maximum = 0ms, Average = 0ms

C:\Prompt>ping -help
Bad option -help.


Usage: ping [-t] [-a] [-n count] [-l size] [-f] [-i TTL] [-v TOS]
            [-r count] [-s count] [[-j host-list] | [-k host-list]]
            [-w timeout] target_name

Options:
    -t             Ping the specified host until stopped.
                   To see statistics and continue - type Control-Break;
                   To stop - type Control-C.
    -a             Resolve addresses to hostnames.
    -n count       Number of echo requests to send.
    -l size        Send buffer size.
    -f             Set Don't Fragment flag in packet.
    -i TTL         Time To Live.
    -v TOS         Type Of Service.
    -r count       Record route for count hops.
    -s count       Timestamp for count hops.
    -j host-list   Loose source route along host-list.
    -k host-list   Strict source route along host-list.
    -w timeout     Timeout in milliseconds to wait for each reply.
*/

?>