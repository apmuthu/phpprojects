<?php
/*
// Program       : Lookup owner ISP of IP from https://IPinfo.io - 1000 lookups free per IP per day
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2019-08-08
// Usage Notes   : Returned array is viewable as UTF8 in the browser by setting the Text Encoding
                   $IPs array (can obtain from querying a DB) contains the list of IPs to be looked up
// DB Schema for storage of output:
CREATE TABLE ip2isp (
  IP varchar(16) NOT NULL,
  City varchar(255) DEFAULT NULL,
  region varchar(100) DEFAULT NULL,
  country varchar(50) DEFAULT NULL,
  loc varchar(100) DEFAULT NULL,
  hostname varchar(100) DEFAULT NULL,
  postal varchar(10) DEFAULT NULL,
  org varchar(255) DEFAULT NULL,
  readme varchar(255) DEFAULT NULL,
  PRIMARY KEY (IP)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
*/

define ('TAB', chr(9));
define ('LF', chr(10));
define ('CRLF', chr(13).LF);

$IPs = Array(
'1.23.26.210',
'1.6.22.117',
'101.127.7.65',
'98.215.215.251'
);

foreach ($IPs as $i => $IP) {
	$a = file_get_contents("https://ipinfo.io/".$IP);
	$b = json_decode($a, true); // convert json to array
	echo      $b['ip']
	     .TAB.$b['city']
	     .TAB.$b['region']
	     .TAB.$b['country']
	     .TAB.$b['loc']
	     .TAB.$b['hostname']
	     .TAB.$b['postal']
	     .TAB.$b['org']
	     .TAB.$b['readme']
		 .LF;
}

