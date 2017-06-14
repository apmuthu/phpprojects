<?php
/*
Program       : Bridge to use LimeSurvey PDO Database Connection
Author        : Ap.Muthu <apmuthu@usa.net>
Version       : 1.0
Release Date  : 2016-08-13
Example Usage : include in target file
Usage Notes   : LimeSurvey Database PDO connection is $conn
Has Function  : get_max_ls_db_values() provides summary info on existing surveys in the database
*/

/*
Settings: Array
(
    [components] => Array
        (
            [db] => Array
                (
                    [connectionString] => mysql:host=localhost;port=3306;dbname=limesurvey;
                    [emulatePrepare] => 1
                    [username] => root
                    [password] => 
                    [charset] => utf8
                    [tablePrefix] => lime_
                )

        )

)
*/

// Map inside LimeSurvey webroot

$system_path = "framework";
if (realpath($system_path) !== FALSE) $system_path = realpath($system_path).'/';
$system_path = rtrim($system_path, '/').'/';
if (!is_dir($system_path)) exit("Your system folder path does not appear to be set correctly. Please open the following file and correct this: ".pathinfo(__FILE__, PATHINFO_BASENAME));
define('BASEPATH', str_replace("\\", "/", $system_path));

$aSettings= Array();
$cfgfile = "application/config/config.php";
if (file_exists($cfgfile))
	$aSettings= include( $cfgfile );
else
	die ("No valid LimeSurvey config file");

$tblpfx = $aSettings['components']['db']['tablePrefix'];
$conn = new PDO($aSettings['components']['db']['connectionString']
			  , $aSettings['components']['db']['username']
			  , $aSettings['components']['db']['password']);

function get_max_ls_db_values() {
	global $conn, $tblpfx;
	$sql = "
SELECT @a:=LEAST ( 
    IF (LOCATE('0',`title`) >0,LOCATE('0',`title`),999),
    IF (LOCATE('1',`title`) >0,LOCATE('1',`title`),999),
    IF (LOCATE('2',`title`) >0,LOCATE('2',`title`),999),
    IF (LOCATE('3',`title`) >0,LOCATE('3',`title`),999),
    IF (LOCATE('4',`title`) >0,LOCATE('4',`title`),999),
    IF (LOCATE('5',`title`) >0,LOCATE('5',`title`),999),
    IF (LOCATE('6',`title`) >0,LOCATE('6',`title`),999),
    IF (LOCATE('7',`title`) >0,LOCATE('7',`title`),999),
    IF (LOCATE('8',`title`) >0,LOCATE('8',`title`),999),
    IF (LOCATE('9',`title`) >0,LOCATE('9',`title`),999)
  ) AS SfxStart,
  SUBSTR(`title`, 1, @a-1) AS QPfx,
  LENGTH(SUBSTR(`title`, @a)) AS QSfxLen,
  SUBSTR(MIN(`title`), @a)+0 AS QSfxMin,
  SUBSTR(MAX(`title`), @a)+0 AS QSfxMax
FROM $tblpfx"."questions, (SELECT @a) AS a GROUP BY SfxStart, QPfx, QSfxLen;";
	$results = Array();
	foreach ($conn->query($sql) as $row) {
		$results[] = $row;
	}
	return $results;
}

?>