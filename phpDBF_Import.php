<?php
/*
// Program       : Import Schema/Structure and Data from DBF file into MySQL
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2020-06-04
// Usage Notes   : php-xbase extension handles Memo fields better
//                 enable php_gmp.dll before php_dbase.dll in php.ini under extensions
// Reference     : https://stackoverflow.com/questions/14270236/php-script-to-convert-dbf-files-to-mysql
// Reference     : https://github.com/luads/php-xbase
// Reference     : https://www.ostalks.com/2009/12/31/import-dbf-files-to-mysql-using-php/
//
// Extension Downloads
// https://windows.php.net/downloads/pecl/releases/dbase/
// https://windows.php.net/downloads/pecl/releases/dbase/5.1.1/php_dbase-5.1.1-5.4-ts-vc9-x86.zip - php 5.4.45
// https://windows.php.net/downloads/pecl/releases/dbase/5.1.0/php_dbase-5.1.0-5.3-ts-vc9-x86.zip - php 5.3.27
// https://web.archive.org/web/20111007102547if_/http://downloads.php.net/pierre/php_dbase-5.3-svn-20101022-vc9-x86.zip - php 5.3.4
*/


define('DBF_DEBUG', TRUE);
header('Content-Type: text/html; charset=utf-8');

$tbl       = "imported_table"; // name of MySQL table to import into
$db_host   = "localhost";
$db_uname  = 'root';
$db_passwd = '';
$db        = 'my_mysql_db';

$dbf_path  = "/path/dbaseFileName.dbf"; // Path to dbase file

$conn = new mysqli($db_host, $db_uname, $db_passwd, $db);
if ($conn->connect_errno) {
    echo "Failed to connect to MySQL: (" . $conn->connect_errno . ") " . $conn->connect_error;
}


// Open dbase file
$dbh = dbase_open($dbf_path, 0)
or die("Error! Could not open dbase database file '$dbf_path'.");

// Get column information
$column_info = dbase_get_header_info($dbh);

// echo print_r($column_info, true);

$line = array();

foreach($column_info as $col) {
	switch($col['type']) {

		case 'character':
			$line[]= "`$col[name]` VARCHAR( $col[length] )";
			break;
	
		case 'number':
			$line[]= "`$col[name]` FLOAT";
			break;

		case 'boolean':
			$line[]= "`$col[name]` BOOL";
			break;

		case 'date':
			$line[]= "`$col[name]` DATE";
			break;

		case 'memo':
			$line[]= "`$col[name]` TEXT";
			break;
	}
}

$str = implode(",\n",$line);
$sql = "CREATE TABLE `$db`.`$tbl` ( \n$str \n);";

$conn->select_db($db);

if (DBF_DEBUG)
	echo $sql. "\n\n"; // for debug
else
	$conn->query($sql); // for non debug

set_time_limit(0); // I added unlimited time limit here, because the records I imported were in the hundreds of thousands.

// This is part 2 of the code

import_dbf($db, $tbl, $dbf_path);

function import_dbf($db, $table, $dbf_file) {
	global $conn;
	if (!$dbf = dbase_open ($dbf_file, 0)) { die("Could not open $dbf_file for import."); }
	$num_rec = dbase_numrecords($dbf);
	$num_fields = dbase_numfields($dbf);
	$fields = array();

	for ($i=1; $i<=$num_rec; $i++) {
		$row = @dbase_get_record_with_names($dbf,$i);
		$q = "INSERT INTO `$db`.`$table` VALUES (";
		foreach ($row as $key => $val) {
			if ($key == 'deleted') { continue; }
			$q .= "'" . addslashes(trim($val)) . "',"; // Code modified to trim out whitespaces
		}
		if (isset($extra_col_val)) { $q .= "'$extra_col_val',"; }
		$q = substr($q, 0, -1);
		$q .= ')';
		if (DBF_DEBUG) echo $q . "\n";
		else {
			//if the query failed - go ahead and print a bunch of debug info
			if (!$result = mysqli_query($q, $conn)) {
				print (mysqli_error() . " SQL: $q
				\n");
				print (substr_count($q, ',') + 1) . " Fields total.

				";
				$problem_q = explode(',', $q);
				$q1 = "desc $db.$table";
				$result1 = mysqli_query($q1, $conn);
				$columns = array();
				$i = 1;
				while ($row1 = mysqli_fetch_assoc($result1)) {
					$columns[$i] = $row1['Field'];
					$i++;
				}
				$i = 1;
				foreach ($problem_q as $pq) {
					print "$i column: {$columns[$i]} data: $pq
					\n";
					$i++;
				}
				die();
			}
		}
	}
}

