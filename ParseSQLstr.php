<?php
/*
// Program        : Parse SQL string into an array of SELECT column names
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2019-09-01
// Ref: PHP 5.3.2 : https://github.com/greenlion/PHP-SQL-Parser
// Ref: PHP 5.3.0 : https://code.google.com/archive/p/php-sql-parser/downloads
// Usage          : ParseSQLstr("SELECT Alpha, Beta as BeTTa FROM myTable WHERE IsEnabled = 1");
// Sample Output  : 'Alpha','BeTTa'
// Deploy case    : Get column names without connecting to DB - no * in SELECT statement
*/

function add_quotes($str) {
    return sprintf("'%s'", $str);
}

function ParseSQLstr($sql) {
	require_once('./PHP-SQL-Parser/PHPSQLParser.php');

	$fieldslist = array();
	$parser = new PHPSQLParser($sql);
	$alp = $parser->parsed;

	foreach($alp['SELECT'] as $fields) {
		$fieldslist[] = (empty($fields['alias']) ? $fields['base_expr'] : $fields['alias'][name]);
	}
	// $csv = "'".implode("','", $fieldslist)."'";
	$csv =  implode(',', array_map('add_quotes', $fieldslist));
	return $csv;
}
?>