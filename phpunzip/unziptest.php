<?php 
$filename='abc.zip';
require_once('pclzip.lib.php');
$archive = new PclZip($filename);

// extract archive
if ($archive->extract() == 0) {
    die("Error : ".$archive->errorInfo(true));
	}

?>
