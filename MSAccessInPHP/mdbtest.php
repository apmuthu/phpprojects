<?php
/*
// Program       : Connect to MDB (MS Access) tables and queries from PHP on Windows
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-09-30
// Reference     : http://stdioe.blogspot.in/2012/06/php-and-microsoft-access-database.html
*/

$conn = new COM("ADODB.Connection") or die("ADODB Oops!");
$mdblocation = str_replace(']','/',dirname(__FILE__)) . '/'  . 'mdbtest.mdb';
$conn->Open("DRIVER={Microsoft Access Driver (*.mdb)};DBQ=$mdblocation");

$data = $conn->Execute("SELECT * FROM categories ORDER BY Category ASC");

// $data = $conn->Execute("SELECT * FROM cats"); // cats is a query with the same sql as above

print "
<table border='1'>
	<tr><td align='center' colspan='2'><b>DATA</b></td></tr>
	<tr>
		<td><b>CatID</b></td>
		<td><b>Category</b></td>
	</tr>
";

while (!$data->EOF) {
	print "
	<tr>
		<td>" . $data->Fields[0]->value . "</td>
		<td>" . $data->Fields[1]->value . "</td>
	</tr>
";
	$data->MoveNext();
}
print "</table>";
?>
