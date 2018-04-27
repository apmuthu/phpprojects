<?php
/*
	Purpose  : Check if PHP script is called from CLI, obtain local server IP
	Author   : Ap.Muthu <apmuthu@usa.net>
	Release  : 2018-04-27
	Reference: https://stackoverflow.com/questions/933367/php-how-to-best-determine-if-the-current-invocation-is-from-cli-or-web-server
*/


function is_cli() {
    if ( defined('STDIN') ) return true;
    if ( php_sapi_name() === 'cli' ) return true;
    if ( array_key_exists('SHELL', $_ENV) ) return true;
    if ( empty($_SERVER['REMOTE_ADDR']) && 
	     !isset($_SERVER['HTTP_USER_AGENT']) && 
		 count($_SERVER['argv']) > 0
	   ) return true;
    if ( !array_key_exists('REQUEST_METHOD', $_SERVER) ) return true;
    return false;
}

function local_ip() {
	if (is_cli())
		return getHostByName(getHostName());
	else
		return getHostByName(getHostName($_SERVER['SERVER_ADDR']));
}
