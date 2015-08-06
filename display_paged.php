<?php
/*
// Program       : Display a paged list of records from a MySQL table
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-08-06
// Example Usage : http://DOMAIN.TLD/PATH/display_paged.php
// Form POST var : recid
// Usage Notes   : $encstr is used for pseudo salting the GET filter recid value
*/

// References:
// http://www.phpjabbers.com/php--mysql-select-data-and-split-on-pages-php25.html
// http://www.w3schools.com/css/tryit.asp?filename=trycss_table_fancy

/*
// Sample table schema:
CREATE TABLE `mytable` (
  `id` INT(11) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `datefield` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Entry TimeStamp',
  `txtfield1` VARCHAR(15) DEFAULT NULL COMMENT 'Field 1',
  `txtfield2` TEXT COMMENT 'Field 2',
  PRIMARY KEY  (`id`)
) ENGINE=MYISAM COMMENT='My Table';

*/

// constants

$db_host = 'localhost';
$db_user = 'dbuser';
$db_pass = 'secret123';
$db_name = 'mydb';

$limit = 20;
$encstr = "abc";

// Incoming and Computed variables

//$_POST["recid"] = '1';

$idval = '';
if (isset($_POST["recid"])) {
	$recidsize = strlen($_POST['recid']);
	if ($recidsize > 0 && $recid+0 > 0) $idval = $_POST[recid];
	else exit;
}
elseif (isset($_GET["recid"])) $idval  = substr(base64_decode($_GET["recid"], true), strlen($encstr));
else exit;
$m = base64_encode($encstr . $idval);

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; };
$start_from = ($page-1) * $limit;

$sql = "SELECT id, datefield, txtfield1, txtfield2 FROM mytable 
        WHERE id = '$idval')
        ORDER BY datefield DESC 
        LIMIT $start_from, $limit";

$sql_total = "SELECT COUNT(*) AS recs FROM mytable WHERE id = '$idval'"; 

// db connection

$link = mysql_connect($db_host, $db_user, $db_pass);
if (!$link)        { die('Could not connect: '	  . mysql_error()); }
// use db
$db_selected = mysql_select_db($db_name, $link);
if (!$db_selected) { die ("Can't use $db_name : " . mysql_error()); }

// get records to display

$rs_result = mysql_query ($sql, $link); 
?>
<style>
#records {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    width: 100%;
    border-collapse: collapse;
}

#records td, #records th {
    font-size: 1em;
    border: 1px solid #98bf21;
    padding: 3px 7px 2px 7px;
}

#records th {
    font-size: 1.1em;
    text-align: left;
    padding-top: 5px;
    padding-bottom: 4px;
    background-color: #A7C942;
    color: #ffffff;
}

#records tr.alt td {
    color: #000000;
    background-color: #EAF2D3;
}
</style>
<table>
<tr align="center"><td><b><u>Records for: <?php echo $idval; ?></u></b></td></tr>
<tr align="center"><td>
<table id="records">
<tr>
	<th>ID</th>
	<th>Entry TimeStamp</th>
	<th>Field 1</th>
	<th>Field 2</th>
</tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) {
	if ($i%2) echo '<tr class="alt">';
	else echo '<tr>';
?> 
		<td><?php echo $row['id'];  ?></td>
		<td><?php echo $row['datefield']; ?></td>
		<td><?php echo $row['txtfield1'];    ?></td>
		<td><?php echo $row['txtfield2'];    ?></td>
	</tr>
<?php
	$i++;
}; 
?> 
</table>
<?php 

// pagination

$rs_result = mysql_query($sql_total, $link); 
$row = mysql_fetch_row($rs_result); 
$total_records = $row[0]; 
$total_pages = ceil($total_records / $limit); 
$pagename = $_SERVER['PHP_SELF'];

for ($i=1; $i<=$total_pages; $i++) {
	if ($total_pages > 1) {
		if ($page == $i) echo "<b>".$i."</b> "; 
		else echo "<a href='$pagename?recid=$m&page=".$i."'>".$i."</a> ";
	}
}
?>
</td></tr>
</table>
