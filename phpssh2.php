<?php
// PHP tunnel into a remote server and access services on it from localhost

$config['MW-DB']['host'] = '127.0.0.1';
$config['MW-DB']['user'] = 'someusername';
$config['MW-DB']['pass'] = 'somerandompassword';
$config['MW-DB']['dbname'] = 'somerandomdbname';


$config['SSH-TUN']['server'] = "hostIpAddress";
$config['SSH-TUN']['password'] = 'SSHPasswordForHost';
$config['SSH-TUN']['remote-port'] = 'SSH Port to use';
$config['SSH-TUN']['username'] = 'SSHUsernameOnHost';  

//Establish the MySQL SSH Tunnel

if(function_exists("ssh2_tunnel"))
    echo "success";
else
    echo "failure";

$connection = ssh2_connect($config['SSH-TUN']['server'], $config['SSH-TUN']['remote-port']);
if (ssh2_auth_password($connection, $config['SSH-TUN']['username'], $config['SSH-TUN']['password'])) {
    echo "Authentication Successful!\n";
} else {
    die('Authentication Failed...');
}

$tunnel = ssh2_tunnel($connection, '127.0.0.1', 3306);
 
$conn = mysql_connect($config['MW-DB']['host'], $config['MW-DB']['user'], $config['MW-DB']['pass']) or die (mysql_error());  


?>