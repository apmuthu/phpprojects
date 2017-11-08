<?php
/*
// Program       : Download text file on the fly using session variable contents
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-11-06
//
// $fn - session variable subscript containing contents to output to file and filename for .txt download file
*/

if(!isset($_REQUEST['fn']) || !($_REQUEST['fn'] == 'missing' || $_REQUEST['fn'] == 'po_pairs')) die('No valid source provided');
$fn = $_REQUEST['fn'];

session_start();
if (!isset($_SESSION[$fn])) die ('No Valid file data available');

    header('Content-type: text/plain');
    header('Content-Disposition: attachment; filename="'.$fn.'.txt"');
    /*
    assign file content to a PHP Variable $content
    */
    echo $_SESSION[$fn];
?>