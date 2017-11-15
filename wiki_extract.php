<?php
/*
// Program       : Extract Links of file resources uploaded to MediaWiki based Wikis
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-10-10
*/

// Extract Wiki Files from File List Page: http://DOMAIN.TLD/PATH/Special:ListFiles
// use "view source" to save the file urls and download using "wget -i filename.txt"
$num_files=500;

$site_url = 'http://wiki.nerd.nu';
$img_path = '/images/';
$page_url = "http://wiki.nerd.nu/index.php?limit=$num_files&title=Special%3AListFiles";

/*
$site_url = 'http://pve.proxmox.com';
$img_path = '/mediawiki/images/';
// $page_url = 'wiki_file_list_page.txt'; // extract from saved page
$page_url = "http://pve.proxmox.com/mediawiki/index.php?limit=$num_files&title=Special%3AListFiles";
*/

$content = file_get_contents($page_url);
$links = explode('<a href="'.$img_path, $content);
$list = '';
array_shift($links);
foreach ($links as $link) {
	$a = explode('">file</a>', $link);
	if (!empty($a[0]))
		$list .= "\n".$site_url.$img_path.$a[0];
}
echo $list;
