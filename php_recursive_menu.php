<?php
/*
// Program       : Generate Menu Array on recursive self lookup of single query of menu table
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2020-11-12
// Usage Notes   : Returned array can be used to generate a PHP/CSS based menu

// Ref: https://web.archive.org/web/20160310023810/http://www.jugbit.com/php/php-recursive-menu-with-1-query
        https://www.youtube.com/watch?v=Ol63V4R-TdI
        https://orgmode.org/worg/org-tutorials/org-publish-layersmenu.html

// DB Schema for storage of output:
CREATE TABLE `menu` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` smallint(5) unsigned DEFAULT NULL,
  `title` varchar(40) NOT NULL,
  `link_url` varchar(255) DEFAULT NULL,
  `disabled` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB CHARSET=utf8 COLLATE=utf8_unicode_ci;

// Usage
$conn = mysqli_connect("localhost", "my_user", "my_password", "my_db");
$sql = "SELECT id, parent_id, `title`, link_url FROM menu WHERE NOT disabled";
$menu_list = mysqli_query($conn, $sql); // appropriate DB query function
$menu_array = 
$result = formatTree($menu_list, 0);
$menu_array = Array();
foreach($row = mysqli_fetch_array($result, MYSQLI_ASSOC) $menu_list[] = $row;
echo print_r($menu_array, true);
*/

//$tree - menu data array
//$parent - 0
function formatTree($tree, $parent) {
    $tree2 = array();
	foreach($tree as $i => $item) {
		if($item['parent_id'] == $parent) {
			$tree2[$item['id']] = $item;
			$tree2[$item['id']]['submenu'] = formatTree($tree, $item['id']);
		}
	}

	return $tree2;
}

/* Sample Input Array, other fields are faithfully retained in the resultant array like target URL Link
Array
(
    [0] => Array
        (
            [id] => 73
            [parent_id] => 0
            [title] => MENU_73
        )

    [1] => Array
        (
            [id] => 74
            [parent_id] => 73
            [title] => MENU_73_74
        )

    [2] => Array
        (
            [id] => 75
            [parent_id] => 74
            [title] => MENU_73_74_75
        )

    [3] => Array
        (
            [id] => 76
            [parent_id] => 74
            [title] => MENU_73_74_76
        )
)
*/

