<?
echo getip();

function getip() {
	if (isset($_SERVER["HTTP_CLIENT_IP"]) && validip($_SERVER["HTTP_CLIENT_IP"])) {
		return $_SERVER["HTTP_CLIENT_IP"];
	}
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		foreach (explode(",",$_SERVER["HTTP_X_FORWARDED_FOR"]) as $ip) {
			if (validip(trim($ip))) {
				return $ip;
			}
		}
	}
	if (isset($_SERVER["HTTP_X_FORWARDED_FOR"]) && validip($_SERVER["HTTP_X_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_X_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED_FOR"]) && validip($_SERVER["HTTP_FORWARDED_FOR"])) {
		return $_SERVER["HTTP_FORWARDED_FOR"];
	} elseif (isset($_SERVER["HTTP_FORWARDED"]) && validip($_SERVER["HTTP_FORWARDED"])) {
		return $_SERVER["HTTP_FORWARDED"];
	} elseif (isset($_SERVER["HTTP_X_FORWARDED"]) && validip($_SERVER["HTTP_X_FORWARDED"])) {
		return $_SERVER["HTTP_X_FORWARDED"];
	} else {
		return $_SERVER["REMOTE_ADDR"];
	}
}
?>
