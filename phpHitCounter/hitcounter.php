<?php
/*
// Program       : Implements a Hit Counter for a single page
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2016-06-24
// Last Updated  : 2016-06-24
// Example Usage : <?php include ("./hitcounter.php"); ?>
// Notes         : Can implement in an iframe as in the example.html
//                 counterlog.txt must be writeable by the web server process
//                 counterlog.txt must be pruned when it becomes large
*/

$logfile = "./counterlog.txt";
$count = 0;
if (file_exists($logfile)) {
	$count = read_file($logfile, 1);
	$count = $count[0];
}
$count=$count + 1;
$info = $count . "\t" . date('Y-m-d H:i:s') . "\t" . $_SERVER['REMOTE_ADDR'];
echo "$count hits\n";
file_put_contents($logfile,chr(10).$info,FILE_APPEND);

function read_file($file, $lines) {
    $handle = fopen($file, "r");
    $linecounter = $lines;
    $pos = -2;
    $beginning = false;
    $text = array();
    while ($linecounter > 0) {
        $t = " ";
        while ($t != "\n") {
            if(fseek($handle, $pos, SEEK_END) == -1) {
                $beginning = true; 
                break; 
            }
            $t = fgetc($handle);
            $pos --;
        }
        $linecounter --;
        if ($beginning) {
            rewind($handle);
        }
        $text[$lines-$linecounter-1] = fgets($handle);
        if ($beginning) break;
    }
    fclose ($handle);
    return array_reverse($text);
}

?>
