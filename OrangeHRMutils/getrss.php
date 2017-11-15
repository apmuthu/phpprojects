<?php
/*
// Program       : Parse the OrangeHRM v3.3.3 Free Edition's RSS feed into an array
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-08-05
//
// Example Usage :
//   $jobs = jobs2array($feed_url);
//   echo print_r($jobs['head'], true);
//   echo print_r($jobs['items'], true);
*/

# define OrangeHRM server url with webroot path
define ('OHRM_URL', 'http://www.example.com/ohrm/');
// $rssfeed_url = 'OHRM_URL' . 'symfony/web/index.php/recruitmentApply/jobs.rss'; // without mod_rewrite pretty urls
$rssfeed_url = 'OHRM_URL' . 'symfony/web/recruitmentApply/jobs.rss'; // with mod_rewrite pretty urls

function jobs2array($rssfeed_url) {
    $feed = implode(file($rssfeed_url));
    //$feed = str_replace(array('<![CDATA[', ']]>', '<pre>', '</pre>'), '', $feed);
    $xml  = simplexml_load_string($feed, 'SimpleXMLElement', LIBXML_NOCDATA);
    $json = json_encode($xml);
    $data = json_decode($json,TRUE);

    $items = $data['channel']['item'];
    unset($data['channel']['item']);
    $head = $data['channel'];
    unset($data);
    $head['link'] = str_replace('/index.php', '', $head['link']);

    $mod_rewrite_used = ( strpos(rssfeed_url, '/index.php') === false );

    # 'title' field for the 'item' is in the format "<position> - <manager>"
    #  parse them into separate elements
    foreach ($items as $key => $item) {
    //	list($position, $manager) = explode(' - ', $item['title']);
	    list($items[$key]['position'],  $items[$key]['manager']) = explode(' - ', $item['title']);
		if ($mod_rewrite_used)
	        $items[$key]['link'] = str_replace('/index.php', '', $item['link']); // executed only for mod_rewrite pretty urls
	    unset($items[$key]['title']);
    }
	$jobs = Array('head' => $head, 'items' => $items);
	return $jobs;
}
