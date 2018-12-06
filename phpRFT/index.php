<?php
define("phpRFT", true);
include "config.php";
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
function GetTitle()
{
	document.getElementById("name").value="Loading...";
var xmlhttp;
var url;
url = document.getElementById("url").value;
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("name").value=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","gettitle.php?url="+url,true);
xmlhttp.send();
}
  </script>
</head>
<body>

<div class="container">
<center><a href="downloads.php" class="btn btn-default" style="width:100%;" target="_blank">View downloaded files</a></center>
<form action="" method="post" role="form">
    <div class="form-group">
      <label for="url">url:</label>
      <input name="url" type="url" class="form-control" id="url" placeholder="Enter url">
    </div>
	<div class="form-group" id="fn">
      <label for="name">Name:</label>
	  <div class="row">
	  <div class="col-sm-10">
      <input name="name" type="text" class="form-control" id="name" placeholder="Enter file name">
    </div>
	<div class="col-sm-2">
      <input name="gn" type="button" class="form-control btn btn-default" id="gn" value="get name" onclick="GetTitle()"/>
    </div>
    </div>
    </div>
	
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
<?php
if(!is_dir(DownloadFolder) && !is_file(DownloadFolder))
{
	mkdir(DownloadFolder);
}
if(isset($_POST["url"]))
{
ini_set(MemoryLimit, "500M");
set_time_limit(TimeLimit);
$hdrs = get_headers($_POST["url"], 1);
if($hdrs)
{
	if(isset($hdrs['Content-Type']))
	{
		if(is_array($hdrs['Content-Type']))
		{
			$cntt = end($hdrs['Content-Type']);
			echo "File type: $cntt <br />";
		}
		else
		{
			echo "File type: ".$hdrs['Content-Type']." <br />";
		}
	}
	if(isset($hdrs['Content-Length']))
	{
		global $len;
		if(is_array($hdrs['Content-Length']))
		{
			
			$len = end($hdrs['Content-Length']);
			$adi = $len;
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "KB";
			}
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "MB";
			}
			$adi = round($adi, 2);
			echo "File size: $adi $t <br />";
			global $bytmax;
			$bytmax = $len;
			
		}
		else
		{
			$adi = $hdrs['Content-Length'];
			$t = "Bytes";
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "KB";
			}
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "MB";
			}
			$adi = round($adi, 2);
			echo "File size: $adi $t <br />";
			global $bytmax;
			$bytmax = $hdrs['Content-Length'];
		}
	}
	if(isset($hdrs["location"]))
	{
		if(is_array($hdrs['location']))
		{
			$lctn = end($hdrs['location']);
			echo "Redirection: $lctn <br />";
			$_POST["url"] = $lctn;
		}
		else
		{
			echo "Redirection: ".$hdrs['location']." <br />";
			$_POST["url"] = $hdrs['location'];
		}
	}
}
function stream_notification_callback($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max) {
    switch($notification_code) {
        case STREAM_NOTIFY_RESOLVE:
        case STREAM_NOTIFY_AUTH_REQUIRED:
        case STREAM_NOTIFY_COMPLETED:
        case STREAM_NOTIFY_FAILURE:
        case STREAM_NOTIFY_AUTH_RESULT:
            var_dump($notification_code, $severity, $message, $message_code, $bytes_transferred, $bytes_max);

            break;
        case STREAM_NOTIFY_CONNECT:
            echo "<script>document.getElementById('pb').className='progress-bar progress-bar-striped progress-bar-info';document.getElementById('pb').style='width:100%';</script>";
			break;
        case STREAM_NOTIFY_PROGRESS:
		if($bytes_max)
		{
			global $pr;
			global $bm;
			$bm = "";
			$bm = $bytes_max;
			$adi = $bytes_transferred;
			$t = "Bytes";
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "KB";
			}
			if($adi > 1024)
			{
				$adi /= 1024;
				$t = "MB";
			}
				$adi2 = "";
				$adi2 = $bytes_max;
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
			$adi = round($adi, 2);
			$adi2 = round($adi2, 2);
			$pr = $bytes_transferred * 100;
				$pr = $pr / $bytes_max;
			$pr = intval($pr);	
		}
		else
		{
			$pr = "unknown";
			$adi = 0;
			$t = "Unknown";
			$t2 = "Unknown";
			$adi2 = 0;
		}
            echo "<script>document.getElementById('pb').className='progress-bar progress-bar-striped progress-bar-info active';document.getElementById('pb').style='width:$pr%';document.getElementById('pb').innerHTML='$pr%';document.getElementById('res').innerHTML='progress: $adi $t / $adi2 $t2';document.getElementById('pb').style.width = '$pr%';</script>
			";
            break;
    }
}
    echo "\n";
$ctx = stream_context_create();
stream_context_set_params($ctx, array("notification" => "stream_notification_callback"));
	$name = DownloadFolder."/".$_POST["name"];
echo "name: ".$name."<br />";
	echo '

 <div class="progress">
  <div class="progress-bar progress-bar-striped active" role="progressbar" style="width:0%" id="pb">
    <span>0% Complete</span>
  </div>
</div><div id="res"></div>';
$put = copy($_POST["url"], $name, $ctx);
if($put)
{
	$put = filesize($name);
	
	$t2 = "Bytes";
			if($put > 1024)
			{
				$put /= 1024;
				$t2 = "KB";
			}
			if($put > 1024)
			{
				$put /= 1024;
				$t2 = "MB";
			}
			$t = "Bytes";
			if(!isset($bm))
			{
				$bm = 0;
			}
			if($bm > 1024)
			{
				$bm /= 1024;
				$t = "KB";
			}
			if($bm > 1024)
			{
				$bm /= 1024;
				$t = "MB";
			}
			$put = round($put, 2);
			$bm = round($bm, 2);
		echo "<script>document.getElementById('pb').style='width:100%';document.getElementById('pb').innerHTML='100%';document.getElementById('pb').className='progress-bar progress-bar-striped progress-bar-success';document.getElementById('res').innerHTML='$put $t2/$bm $t';document.getElementById('pb').style.width = '100%';</script>
		";
}
}
?>
</div>
</body>
</html>
