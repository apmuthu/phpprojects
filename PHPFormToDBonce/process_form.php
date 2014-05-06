<?php
/*
	Program      : To update a record only once using a random hash field value
	Author       : Ap.Muthu <apmuthu@usa.net>
	Version      : 1.0
	Release Date : 2014-05-06
	ID Parameter : Send ID of record to update through parameter 'f' in url
	Notes        : The table to be updated must already be populated with the Primary Key and Hash values
	               for record updation which is allowed to occur only once. 
				   Reset NoEdit field to edit again.
				   Use header.html and footer.html optionally
*/

/*
CREATE TABLE `mytable` (
  `ID`      int(11) NOT NULL,
  `EntryDT` datetime DEFAULT NULL,
  `FromIP`  varchar(15) DEFAULT NULL,
  `NoEdit`  tinyint(1) NOT NULL DEFAULT '0',
  `RecHash` varchar(64) NOT NULL,
  `Field1`  varchar(20) DEFAULT NULL,
  `Field2`  varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

# Populates, ID and 26 to 31 chars RecHash in mytable
INSERT INTO mytable (`ID`, `RecHash`) SELECT `ID` AS `ID`, LEFT(MD5(RAND()), 31-RAND()*6) AS `RecHash` from `maintable`;
*/

define ('SC_DEBUG',        TRUE);

define ('ID_LEN',             6);
define ('SC_DBHOST', 'localhost');
define ('SC_DBUSER',      'root');
define ('SC_DBPASS',          '');
define ('SC_DB',          'mydb');
define ('SC_DBTABLE',  'mytable');
define ('SC_DBTPKEY',       'ID');

$FldArray = Array(
  'Field1'
, 'Field2'
);

$sc_link = dbconnect();

if (file_exists('header.html')) include("header.html");

// Receiving variables
$sc_ip     = $_SERVER['REMOTE_ADDR'];
$ID        = mysql_real_escape_string($_GET['f']); // Primary Key of record to update
$RecHash   = mysql_real_escape_string($_POST['RecHash']); // Random Hash Value from field in record to update

// Validation
if (strlen($ID)   != ID_LEN) errmsg("Please enter a valid ID</font></p>");
if (strlen($RecHash)   < 28) errmsg("Please enter a valid RecHash</font></p>");
if (strlen($RecHash)   > 34) errmsg("Please enter a valid RecHash</font></p>");

//saving record to MySQL database

//changing date formats

$sc_strQuery = "UPDATE `" . SC_DBTABLE . "` SET 
    `EntryDT` = NOW()
  , `FromIP` = \"$sc_ip\"
  , `NoEdit` = 1 ";
foreach ($FldArray AS $FldNum => $Field) {
	$FieldVal = mysql_real_escape_string($_POST[$Field]);
	$sc_strQuery .= ", `$Field` = \"$FieldVal\"";
}
$sc_strQuery .= " WHERE 
       `" . SC_DBTPKEY . "` = \"$ID\"
   AND `RecHash`   = \"$RecHash\"
   AND NOT `NoEdit`
";

// update record
$sc_result = mysql_query($sc_strQuery);
if (!$sc_result) errmsg('Invalid query: ' . $sc_strQuery . chr(10) . '<br>' . mysql_error());
if (mysql_affected_rows($sc_link) == 0) errmsg('Already Updated / Update Locked.' . mysql_error());

mysql_close($sc_link);

showmsg('You have successfully submitted the form.');;

if (file_exists('footer.html')) include("footer.html");




// Functions

function errmsg($msg) {
	if (SC_DEBUG) die("<p align='center'><font face='Arial' size='2' color='#FF0000'>$msg</font></p>");
	else exit;
}

function showmsg($msg) {
	 echo "<p align='center'><font face='Arial' size='2' color='#000000'>$msg</font></p>";
}

function dbconnect() {
	$link = mysql_connect(SC_DBHOST, SC_DBUSER, SC_DBPASS);
	if (!$link) errmsg('Could not connect: ' . mysql_error());
	$db_selected = mysql_select_db(SC_DB, $link);
	if (!$db_selected) errmsg('Can not use ' . SC_DB . ' : ' . mysql_error());
	return ($link);
}
?>
