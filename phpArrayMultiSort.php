<?php
/*
	Purpose  : Read a TSV file into an array and sort on multiple fields
	Author   : Ap.Muthu <apmuthu@usa.net>
	Release  : 2020-03-27
	Reference: PHP Manual for array_multisort()
*/

$dataarray = array();
$fields = array();
$i = 0;
// data.tsv is a tab separated file with the first row having the field names
// For example here: "LinkID	LinkCat	DocDate	DocType	URL	ParseDT"

// Read in the TSV file into an array

foreach (file('data.tsv') as $row) {
	$row = str_replace("\n", "", $row); // remove ending line feed
	$row = str_replace("\r", "", $row); // remove ending carriage return if any
	$rec = explode("\t", $row);
	if(empty($fields)) {
		$fields = $rec;
	} else {
		foreach($rec as $k => $fld) {
			$dataarray[$i][$fields[$k]] = $fld;
		}
		$i++;
	}
}

// get a list of sort columns and their data to pass to array_multisort
$sort = array();
foreach($dataarray as $k=>$v) {
    $sort['DocDate'][$k] = $v['DocDate'];
    $sort['LinkCat'][$k] = $v['LinkCat'];
    $sort['DocType'][$k] = $v['DocType'];
}
// sort by DocDate desc, LinkCat and then DocType
array_multisort($sort['DocDate'], SORT_DESC, $sort['LinkCat'], SORT_ASC, $sort['DocType'], SORT_ASC, $dataarray);

echo print_r($dataarray, true);
