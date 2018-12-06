<?php
$url = $_GET["url"];
$hdrs = get_headers($url, 1);
if(substr($url, -1) == "/")
		{
			$url = substr($url, 0, -1);
		}
		$name = rawurldecode(end(explode("/", $url)));
		if(isset($hdrs["content-disposition"]))
		{
			$a = $hdrs["content-disposition"];
			$a = strstr($a, 'filename="');
			$a = str_replace('filename="', "", $a);
			$a = strstr($a, '"', 1);
			if($a)
			{
				$name = $a;
			}
		}
		echo $name;

?>