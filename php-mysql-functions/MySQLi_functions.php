<?
// Ref: http://www.barattalo.it/php/10-php-usefull-functions-for-mysqli-improved-stuff/
define("WEBDOMAIN",   "your host");
define("DEFDBNAME",   "your db name");
define("DEFUSERNAME", "your user");
define("DEFDBPWD",    "your pwd");

if(!$conn = connectDb()) {die("err db");} else {$conn->query("SET NAMES 'utf8';");}

function connectDb() {
    if ($conn = @new mysqli(WEBDOMAIN, DEFUSERNAME, DEFDBPWD, DEFDBNAME)) return $conn; else return false;
}

function fixTables($conn,$dbname) {
    // search for all the tables of
    // a db and run repair and optimize
    // note: this can take a lot of time
    // if you have big/many tables.
    global $conn;
    if ( $rs = $conn->query("SHOW TABLES FROM $dbname") ) {
        while ( $r = $rs->fetch_array() ) {
            $conn->query("REPAIR TABLE {$r[0]}");
            $conn->query("OPTIMIZE TABLE {$r[0]}");
        }
        $rs->free();
    }
}

function getHtmlTable($rs, $border=false, $blankempty = false, $skip_cols=array()) {
    // receive a record set and print
    // it into an html table
    $out = '<table';
	if ($border !== false)
		$out .= ' border='.($border+0). ' style="border-collapse: collapse;"';
	$out .= '>';
    while ($field = $rs->fetch_field()) {
		if (!in_array($field->name, $skip_cols))
			$out .= "<th>".$field->name."</th>";
	}
    while ($linea = $rs->fetch_assoc()) {
        $out .= "<tr>";
        foreach ($linea as $f => $valor_col) {
		    if ($blankempty !== false && empty($valor_col)) $valor_col = '';
			$align= is_numeric($valor_col)? " align='right'" : "";
			if (!in_array($f, $skip_cols))
				$out .= "<td$align>".$valor_col.'</td>';
        }
        $out .= "</tr>";
    }
    $out .= "</table>";
    return $out;
}

function getCommaFields($conn, $table, $excepts = ""){
    // get a string with the names of the fields of the $table,
    // except the onews listed in '$excepts' param
    $out = "";
    if ($rs = $conn->query( "SHOW COLUMNS FROM `$table`" )) {
        while($r = $rs->fetch_array()) if ( !stristr(",".$r['Field']."," ,  $excepts) ) $out.= ($out?",":"").$r['Field'];
    } else die($conn->error);
    return $out ;
}

function getCommaValues($conn,$sql) {
    // execute a $sql query and return
    // all the first value of the rows in
    // a comma separated string
    $out = "";
    if ($rs = $conn->query($sql)) while($r=$rs->fetch_row()) $out.=($out?",":"").$r[0];
        else die($conn->error);
    return $out;
}

function getScalar($conn,$sql,$def="") {
    if ( $rs = $conn->query($sql) ) {
        $r = $rs->fetch_array();
        $rs->free();
        return $r[0];
    }
    return $def;
}

function getRow($conn,$sql) {
    if ( $rs = $conn->query($sql) ) {
        $r = $rs->fetch_array();
        $rs->free();
        return $r;
    }
    return "";
}

function getRowAssoc($conn,$sql) {
    if ( $rs = $conn->query($sql) ) {
        $r = $rs->fetch_array(MYSQLI_ASSOC);
        $rs->free();
        return $r;
    }
    return "";
}

function duplicateRow($conn, $table,$primaryField,$primaryIDvalue) {
    // duplicate one record in a table
    // and return the id
    $fields = getCommaFields($conn, $table,$primaryField);
    $sql = "insert into $table ($fields) select $fields from $table where $primaryField='".$conn->escape_string($primaryIDvalue)."' limit 0,1";
    if (!$conn->query($sql)) die($conn->error().$sql);
    return $conn->insert_id;
}

function convertResult($rs, $type, $jsonmain="") {
    // receive a recordset and convert it to csv
    // or to json based on "type" parameter.
    $jsonArray = array();
    $csvString = "";
    $csvcolumns = "";
    $count = 0;
    while($r = $rs->fetch_row()) {
        for($k = 0; $k < count($r); $k++) {
            $rs->field_seek($k);
            $finfo = $rs->fetch_field();
            $jsonArray[$count][$finfo->name] = $r[$k];
            $csvString.=",\"".$r[$k]."\"";
            if (!$count) $csvcolumns.=($csvcolumns?",":"").$finfo->name;
        }
        $csvString.="\n";
        $count++;
    }
    $jsondata = "{\"$jsonmain\":".json_encode($jsonArray)."}";
    $csvdata = str_replace("\n,","\n",$csvcolumns."\n".$csvString);
    return ($type=="csv"?$csvdata:$jsondata);
}

?>