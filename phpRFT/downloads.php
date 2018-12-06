<?php
define("phpRFT", true);
include "config.php";
function get_type($name)
{
	$add2 = 'http://' . $_SERVER[ 'HTTP_HOST'] . $_SERVER[ 'PHP_SELF'];
	$add = substr($add2,0,-13) . $name;
$head = get_headers($add, 1);
if(isset($head["Content-Type"]))
{
	return $head["Content-Type"];
}
else
{
	return false;
}
}
function get_size($name)
{
	$add2 = 'http://' . $_SERVER[ 'HTTP_HOST'] . $_SERVER[ 'PHP_SELF'];
	$add = substr($add2,0,-13) . $name;
$head = get_headers($add, 1);
if(isset($head["Content-Length"]))
{
	$adi2 = $head["Content-Length"];
	$t2 = "Bytes";
			if($adi2 > 1024)
			{
				$adi2 /= 1024;
				$t2 = "KB";
			}
			if($adi2 > 1024)
			{
				$adi2 /= 1024;
				$t2 = "MB";
			}
			$adi2 = round($adi2, 2);
			return "$adi2 $t2";
}
else
{
	return false;
}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>phpRFT</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
  <link rel="icon" href="favicon.ico" type="image/x-icon">
  <script src="bootstrap/js/bootstrap.min.js"></script>
  <script>
   document.getElementById("fn").style.visibility = "hidden";
  function hids()
  {
	  if(document.getElementById('cb').checked == false)
	  {
		  document.getElementById('fn').style.visibility = "visible";
	  }
	  else
	  {
		  document.getElementById('fn').style.visibility = "hidden";
	  }
  }
  </script>
</head>
<body>

<div class="container">
<table class="table table-striped table-bordered table-hover">
<thead>
      <tr>
        <th>File</th>
        <th>Type</th>
        <th>Size</th>
      </tr>
    </thead>
    <tbody>
<?php
$dir = scandir(DownloadFolder);
foreach($dir as $file)
{
	$file2 = DownloadFolder."/$file";
	if(is_dir($file2)) continue;
	echo " \n";
	$type = get_type($file2);
	$size = get_size($file2);
	if($type)
	{
		$tr = $type;
	}
	else
	{
		$tr = "Unknown";
	}
	if($size)
	{
		$sr = $size;
	}
	else
	{
		$sr = "Unknown";
	}
	echo "<tr><td><a href=\"$file2\">$file</a></td><td>$tr</td><td>$sr</td></tr> \n";
	$type = "";
}
?>
</tbody>
</table>
</div>
</body>
</html>