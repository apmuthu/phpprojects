<?php
/*
// Program         : Obtain Exchange Rate from XE
// Author          : Ap.Muthu <apmuthu@usa.net>
// Version         : 1.0
// Release Date    : 2015-07-28
// Example Usage 1 : echo print_r(get_xe_rates(), true);
// Example Usage 2 : echo print_r(get_xe_rates('SGD', '2015-07-01'), true);
*/

function get_xe_rates($req_curr='USD', $req_date='') {
//$filename = 'xe_28.html';
//$filename = 'http://www.xe.com/currencytables/?from=USD&date=2015-07-28';
if(empty($req_date)) $req_date = date("Y-m-d");
$filename = "http://www.xe.com/currencytables/?from=$req_curr&date=$req_date";

$content = file_get_contents($filename);

$html = str_replace('</header>', '', $content);
$html = str_replace('<header>', '', $html);
$html = str_replace('<!-- ***** FOR INFORMATION ON PARSING THIS DATA, REFER TO: http://www.xe.com/currencytables/parsehelp.htm ***** -->', '', $html);
$html = str_replace('<!-- WARNING: Automated extraction of rates is prohibited under the Terms of Use. -->', '', $html);


$html = strip_tag_content($html, 'nav');
$html = strip_tag_content($html, 'script', 1);
$html = strip_tag_content($html, 'noscript', true);
$html = strip_tag_content($html, 'svg', true);
$html = strip_tag_content($html, 'g:plusone', true);
$html = strip_tag_content($html, 'footer');

//echo $html;
//exit;

// a new dom object
$dom = new domDocument; 

// load the html into the object
$dom->loadHTML($html); 

// discard white space
$dom->preserveWhiteSpace = false;

$ratedate = '';
$ratetime = '';
$ratetz = '';
// Iterate over all the <p> tags
foreach($dom->getElementsByTagName('p') as $para) {
        if ($para->getAttribute('class') == "ICTTableDate") {
			$time = trim(preg_replace('/[\s\t\n\r\s]+/', ' ', $para->nodeValue));
			$time = str_replace('Mid-market rates as of ', '', $time);
			list($ratedate, $ratetime, $ratetz) = explode(' ', $time);
			break;
		}
}

$inhtml = get_inner_html($dom->getElementById('historicalRateTbl'));

$dom->loadHTML($inhtml);
 
//Searches for all elements with the "td" tag name
$rates = $dom->getElementsByTagName( "td" );

//Returns the first element found having the tag name "td"
$i=0;
while($rate = $rates->item($i)->nodeValue) {
	if (!($i%4)) {
		$ratelist[$rate] = Array(
		$rates->item($i+1)->nodeValue,
		$rates->item($i+2)->nodeValue,
		$rates->item($i+3)->nodeValue
		);
    }
	$i += 4;
}

return Array(
	"RateDate" => $ratedate, 
	"RateTime" => $ratetime, 
	"RateTZ" => $ratetz, 
	"BaseCurr" => $req_curr, 
	"RateList" => $ratelist);
}

function strip_tag_content($str, $tag, $every=false) {
	$sttag = "<$tag";
	$cltag = "</$tag>";
	while (strpos($str, $sttag) && strpos($str, $cltag)) {
		$strpos = strpos($str, $sttag);
		$html = substr($str, 0, $strpos);
		$strpos = strpos($str, $cltag)+strlen($cltag);
		$html .= substr($str, $strpos);
		if (!$every) break;
		$str = $html;
	}
	return $html;
}

function get_inner_html( $node ) 
{
    $innerHTML= '';
    $children = $node->childNodes;
     
    foreach ($children as $child)
    {
        $innerHTML .= $child->ownerDocument->saveXML( $child );
    }
     
    return $innerHTML;
}

?>
