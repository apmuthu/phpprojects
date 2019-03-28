<?php
// Ref: http://www.barattalo.it/php/10-php-usefull-functions-for-mysql-stuff/
define("DBHOST", "your host");
define("DBNAME", "your db name");
define("DBUSER", "your user");
define("DBPWD",  "your pwd");

if(!$conn = connectDb()) {die("err db");} else {$conn->query("SET NAMES 'utf8';");}

function connectDb() {
    // connect and set the
    // working db
    if (mysql_connect( DBHOST, DBUSER, DBPWD ) && mysql_select_db( DBNAME )) return true; else return false;
}

function fixTables($dbname) {
    // search for all the tables of
    // a db and run repair and optimize
    // note: this can take a lot of time
    // if you have big/many tables.
    $result = mysql_list_tables($dbname) or die(mysql_error());
    while ($row = mysql_fetch_row($result)) {
        mysql_query("REPAIR TABLE $row[0]");
        mysql_query("OPTIMIZE TABLE $row[0]");
    }
}

function getHtmlTable($result, $border=false, $blankempty = false) {
    // receive a record set and print
    // it into an html table
    $out = '<table';
	if ($border !== false)
		$out .= ' border='.($border+0). ' style="border-collapse: collapse;"';
	$out .= '>';
    for($i = 0; $i < mysql_num_fields($result); $i++){
        $aux = mysql_field_name($result, $i);
        $out .= "<th>".$aux."</th>";
    }
    while ($linea = mysql_fetch_array($result, MYSQL_ASSOC)) {
        $out .= "<tr>";
        foreach ($linea as $valor_col) {
		    if ($blankempty !== false && empty($valor_col)) $valor_col = '';
			$align= is_numeric($valor_col)? " align='right'" : "";
            $out .= "<td$align>".$valor_col.'</td>';
        }
        $out .= "</tr>";
    }
    $out .= "</table>";
    return $out;
}

function getCommaFields( $table, $excepts = ""){
    // get a string with the names of the fields of the $table,
    // except the onews listed in '$excepts' param
    $out = "";
    $result = mysql_query( "SHOW COLUMNS FROM `$table`" );
    while($row = mysql_fetch_array($result)) if ( !stristr(",".$row['Field']."," , $excepts) ) $out.= ($out?",":"").$row['Field'];
    return $out ;
}

function getCommaValues($sql) {
    // execute a $sql query and return
    // all the first value of the rows in
    // a comma separated string
    $out = "";
    $rs = mysql_query($sql) or die(mysql_error().$sql);
    while($r=mysql_fetch_row($rs)) $out.=($out?",":"").$r[0];
    return $out;
}

function getEnumSetValues( $table , $field ){
    // get an array of the allowed values
    // of the enum or set $field of $table
    $query = "SHOW COLUMNS FROM `$table` LIKE '$field'";
    $result = mysql_query( $query ) or die( 'error getting enum field ' . mysql_error() );
    $row = mysql_fetch_array($result);
    if(stripos(".".$row[1],"enum(") > 0) $row[1]=str_replace("enum('","",$row[1]);
        else $row[1]=str_replace("set('","",$row[1]);
    $row[1]=str_replace("','","\n",$row[1]);
    $row[1]=str_replace("')","",$row[1]);
    $ar = split("\n",$row[1]);
    for ($i=0;$i<count($ar);$i++) $arOut[str_replace("''","'",$ar[$i])]=str_replace("''","'",$ar[$i]);
    return $arOut ;
}

function getScalar($sql,$def="") {
    // execute a $sql query and return the first
    // value, or, if none, the $def value
    $rs = mysql_query($sql) or die(mysql_error().$sql);
    if (mysql_num_rows($rs)) {
        $r = mysql_fetch_row($rs);
        mysql_free_result($rs);
        return $r[0];
    }
    return $def;
}

function getRow($sql) {
    // execute a $sql query and return the first
    // row, or, if none, return an empty string
    $rs = mysql_query($sql) or die(mysql_error().$sql);
    if (mysql_num_rows($rs)) {
        $r = mysql_fetch_array($rs);
        mysql_free_result($rs);
        return $r;
    }
    mysql_free_result($rs);
    return "";
}

function duplicateRow($table,$primaryField,$primaryIDvalue) {
    // duplicate one record in a table
    // and return the id
    $fields = getCommaFields($table,$primaryField);
    $sql = "insert into $table ($fields) select $fields from $table where $primaryField='".mysql_real_escape($primaryIDvalue)."' limit 0,1";
    mysql_query($sql) or die(mysql_error().$sql);
    return mysql_insert_id();
}

function convertResult($rs, $type, $jsonmain="") {
    // receive a recordset and convert it to csv
    // or to json based on "type" parameter.
    $jsonArray = array();
    $csvString = "";
    $csvcolumns = "";
    $count = 0;
    while($r = mysql_fetch_row($rs)) {
        for($k = 0; $k < count($r); $k++) {
            $jsonArray[$count][mysql_field_name($rs, $k)] = $r[$k];
            $csvString.=",\"".$r[$k]."\"";
        }
        if (!$csvcolumns) for($k = 0; $k < count($r); $k++) $csvcolumns.=($csvcolumns?",":"").mysql_field_name($rs, $k);
        $csvString.="\n";
        $count++;
    }
    $jsondata = "{\"$jsonmain\":".json_encode($jsonArray)."}";
    $csvdata = str_replace("\n,","\n",$csvcolumns."\n".$csvString);
    return ($type=="csv"?$csvdata:$jsondata);
}

?>