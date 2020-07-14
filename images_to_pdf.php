<?php
/*
// Program        : Join Images in a folder into a single PDF
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2020-07-14
// Dependency     : FPDF Library - http://www.fpdf.org - Tested with FPDF v1.8.2
// Paper Sizes    : https://papersizes.io/a/a4 - A4: 210 x 297
// Functions      : is_dir_empty($dir), get_dir_url()
*/

// Download and unzip the FPDF Library using:
// wget "http://www.fpdf.org/en/dl.php?v=182&f=zip" -O fpdf.zip
// unzip fpdf.zip -d ../../libraries/fpdf/
//
// Example to acquire links from a saved web page and then get the images from from it.
// grep "_hr.jpg" webpage.html | grep "edid" | awk -F\" '{ print $1 }' > links.txt
// wget -c -w 2 --no-check-certificate -i links.txt // wait 2 secs will ensure different creation times 

// path relative to script must exist with webserver process writeable permissions
define('LOCALPAGES', 'images');
// Get from remote URLs is false or no image files exist in the images folder
define('LOCALFILES', true);define('DOCPREFIX', 'Document Name');
define('DOCEDITION', 'Place');
define('FPDFPATH', '../../libraries/fpdf/');

set_time_limit(0); // for long execution times

$date = date('Y-m-d');
//$date = '2020-07-04';
$filename = DOCPREFIX.'_'.DOCEDITION.'_'.$date.'.pdf';

require(FPDFPATH.'fpdf.php');
$pdf = new FPDF();
$filelist = array();
foreach(glob(LOCALPAGES."/*.jpg") as $file){
	// use filemtime for modified time instead of file creation time here
	$filelist[$file] = filectime($file);
}
asort($filelist); // sort by created time

foreach ($filelist as $imgfilename => $mtime) {
	$pdf->AddPage();
	$pdf->Image($imgfilename,0,0,210,297);
}
$pdf->Output('D', $filename);



// Functions to use when taking files from a database or acquiring the images in the code

// Ref: https://stackoverflow.com/questions/7497733/how-can-i-use-php-to-check-if-a-directory-is-empty
function is_dir_empty($dir) {
  $handle = opendir($dir);
  while (false !== ($entry = readdir($handle))) {
    if ($entry != "." && $entry != "..") {
      return FALSE;
    }
  }
  return TRUE;
}
/*
// this needs to read all files first
function is_dirempty($dir) {
  if (!is_readable($dir)) return NULL; 
  return (count(scandir($dir)) == 2); // glob does not see hidden files
}
*/

// https://wp-mix.com/php-absolute-path-document-root-base-url/
function get_dir_url() {
	// base directory
	$base_dir = __DIR__;

	// server protocol
	$protocol = empty($_SERVER['HTTPS']) ? 'http' : 'https';

	// domain name
	$domain = $_SERVER['SERVER_NAME'];

	// base url
	$base_url = preg_replace("!^${doc_root}!", '', $base_dir);

	// server port
	$port = $_SERVER['SERVER_PORT'];
	$disp_port = ($protocol == 'http' && $port == 80 || $protocol == 'https' && $port == 443) ? '' : ":$port";

	// put em all together to get the complete base URL
	$url = "${protocol}://${domain}${disp_port}${base_url}";

	return $url; // http://example.com/path/directory
}
?>