<?php
/*
Purpose  : To mask the actual URL of a file allowed to be downloaded only through a php script
Reference: https://www.kavoir.com/2009/05/php-hide-the-real-file-url-and-provide-download-via-a-php-script.html
*/

$path = '/home/someuser/products/data.tar.gz'; // the file made available for download via this PHP file
$mm_type="application/octet-stream"; // modify accordingly to the file type of $path, but mostly do not bother

header("Pragma: public");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("Cache-Control: public");
header("Content-Description: File Transfer");
header("Content-Type: " . $mm_type);
header("Content-Length: " .(string)(filesize($path)) );
header('Content-Disposition: attachment; filename="'.basename($path).'"');
header("Content-Transfer-Encoding: binary\n");

readfile($path); // outputs the content of the file

exit();
?>