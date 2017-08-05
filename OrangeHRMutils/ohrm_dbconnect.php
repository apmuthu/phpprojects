<?php
include './lib/confs/Conf.php';
$conf = new Conf();
/*
    [smtphost] => 
    [dbhost] => localhost
    [dbport] => 3306
    [dbname] => orangehrm_mysql
    [dbuser] => orangehrm
    [version] => 3.3.3
    [dbpass] => MyWebPwd123
    [emailConfiguration] => /var/www/webroot/lib/confs/mailConf.php
    [errorLog] => /var/www/webroot/lib/logs/
*/


$link = mysqli_connect($conf->dbhost, $conf->dbuser, $conf->dbpass, $conf->dbname);

// Ref: https://stackoverflow.com/questions/11943479/create-html-table-from-sql-table

function sql_to_html_table($sql, $caption='', $delim="\n") {

	global $link;

	$sql = trim($sql);
	if (strtoupper(substr($sql,0,6)) <> 'SELECT') return '';

	$sqlresult =  mysqli_query($link, $sql);

	// starting table
	$htmltable = "<table>" . $delim ;
	$counter   = 0 ;
	if ($caption <> '') $htmltable .= "<caption>$caption</caption>" . $delim ;
	// putting in lines
	while( $row = mysqli_fetch_assoc($sqlresult) ) {
		if ( $counter===0 ) {
		// table header
			$htmltable .= "<tr>" . $delim;
			foreach ( $row as $key => $value ) {
				$htmltable .= "<th>" . $key . "</th>" . $delim ;
			}
			$htmltable .= "</tr>" . $delim ; 
			$counter = 22;
		} 
		// table body
		$htmltable .= "<tr>" . $delim ;
		foreach ( $row as $key => $value ) {
			$htmltable .= "<td>" . $value . "</td>" . $delim ;
		}
		$htmltable .= "</tr>" . $delim ;
	}
	// closing table
	$htmltable .= "</table>" . $delim ; 
	// return
	return $htmltable; 
}

function onerec($sql) {
	global $link;

	$sql = trim($sql);
	if (strtoupper(substr($sql,0,6)) <> 'SELECT') return array();

	$sqlresult =  mysqli_query($link, $sql);
	return mysqli_fetch_assoc($sqlresult);
}


