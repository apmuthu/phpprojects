<?php
set_time_limit(0);
ini_set('default_socket_timeout', 300); // 300 Seconds = 5 Minutes
ini_set('error_reporting',E_ALL & ~E_DEPRECATED & ~E_WARNING & ~E_NOTICE);

$content = '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html lang="en">
<head>
    <title>Progress Bar</title>
</head>
<body>
<!-- Progress bar holder -->
<div id="progress" style="width:500px;border:1px solid #ccc;"></div>
<!-- Progress information -->
<div id="information" style="width"></div>
';
echo $content;
$clen = strlen($content);
// This is for the buffer achieve the minimum size in order to flush data
if ($clen < 1024) echo str_repeat(' ', (1024 - $clen));

// Total processes
$total = 10;

// Loop through process
for($i=1; $i<=$total; $i++){
//	looper($i);
    // Calculate the percentation
    $percent = intval($i/$total * 100)."%";

    // Javascript for updating the progress bar and information
	$content = '<script language="javascript">
    document.getElementById("progress").innerHTML="<div style=\"width:'.$percent.';background-color:#ddd;\">&nbsp;</div>";
    document.getElementById("information").innerHTML="'.$i.' row(s) processed.";
    </script>';
    echo $content;

// Send output to browser immediately
    flush();

// Sleep one second so we can see the delay
    sleep(1);
}

// Tell user that the process is completed
echo '<script language="javascript">document.getElementById("information").innerHTML="Process completed"</script>';
echo '</body>';
echo '</html>';

// function looper($i, $str) { }

?>

