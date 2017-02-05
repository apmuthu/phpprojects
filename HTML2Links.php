<?php
/*
// Program       : Get array of unique filtered URLs and display strings from XML / HTML content
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-02-05
// Usage Notes   : Returned array is UTF8 converted to Latin1 for "&" by default
//
// Example Usage :

$urlContent = file_get_contents('http://www.mysite.com');
$endings = Array('.mysite.com', '.mygroupsite.com');
$excludes = Array(
  'http://news.mysite.com'
, 'http://css.mygroupsite.com'
, 'http://jap.mysite.com'
);
$vals = html2links($urlContent, $endings, $excludes);
echo print_r($vals, true);

*/

function html2links($urlContent, $endings = false, $excludes = false) {
	$dom = new DOMDocument();
	@$dom->loadHTML($urlContent);
	$xpath = new DOMXPath($dom);
	$hrefs = $xpath->evaluate("/html/body//a");

	$chk_endings = (is_array($endings) && count($endings) > 0);
	$chk_excludes = (is_array($excludes) && count($excludes) > 0);
	$vals = array();

	for($i = 0; $i < $hrefs->length; $i++){
		$href = $hrefs->item($i);
		$url = $href->getAttribute('href');
		$txt = $href->nodeValue;
		$url = filter_var($url, FILTER_SANITIZE_URL);
		// validate url
		if(!filter_var($url, FILTER_VALIDATE_URL) === false){
			$url = trim($url);
			if (substr($url,-1) == '/')
				$url = substr($url,0,strlen($url)-1); // remove trailing slash in URLs
			$valid_ending = false;
			if ($chk_endings) {
				foreach ($endings as $ending) {
					// cannot use empty as 0 and "0" are valid endings
					if(substr($url, strpos($url, $ending)) == $ending) {
						$valid_ending = true;
						break;
					}
				}
			} else {
				$valid_ending = true;
			}
			if ($valid_ending) {
				if (!((array_key_exists($url, $vals)) || ($chk_excludes && in_array($url, $excludes))))
					$vals[$url] = $txt; // take only the first instance of the URL
			}
		}
	}
	$vals = array_filter($vals); // remove blanks
	// $vals = array_unique($vals); // remove duplicate URLs - is redundant here
	ksort($vals);
	$rvals = array();
	foreach ($vals as $key => $val) {
		// $val = utf8_decode($val);
		$val = str_replace('Ã¢Â€Â“','&', $val);
		$rvals[] = Array('url' => trim($key), 'txt' => trim($val));
	}
	return $rvals;
}
?>
