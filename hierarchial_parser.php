<?php
/*
  Program       : Parse formatted text file into categories, sub-categories and Items
  Author        : Ap.Muthu <apmuthu@usa.net>
  Version       : 1.0
  Release Date  : 2020-09-20
  Documentation : hierarchial_parser_doc_popup.html
  Format        : Category begins with 2 line feeds after name
                  Sub-Category name has one line feed after the last sub-category ends
                  Items immediately follow the sub-category name
  Input format  : Category1\n
                  \n\n
                  SubCategory1\n
                  Item1\n
                  \n
                  SubCategory2\n
                  Item2\n
                  Item3\n
                  \n\n
                  Category2\n
                  \n\n
                  SubCategory3\n
                  Item4\n
                  Item5\n
                  Item6\n
  Output Format : Category1\tSubCategory1\tItem1\n
                  Category1\tSubCategory2\tItem2\n
                  Category1\tSubCategory2\tItem3\n
                  Category2\tSubCategory3\tItem4\n
                  Category2\tSubCategory3\tItem5\n
                  Category2\tSubCategory3\tItem6\n
  Use Case      : Gem Portal Categories file at https://admin.gem.gov.in/resources/upload/all_categories/all_category_name_desc.pdf
                : Convert PDF to Excel using https://smallpdf.com/pdf-to-excel
				: Extract text into input parser format as above after manual corrections for unacceptable characters like ";'`\
                : Feed this formatted text file into this script as INPUT_FILE in the define
*/

if (!isset($_POST['submit'])) {
?>
<h2>Hierarchial Parser</h2>
<p><a href="hierarchial_parser_doc_popup.html" target="_blank">Input Format Documentation</a><p>
<form method="POST" action="" enctype="multipart/form-data">
<label for="fileupload"> Select a input text file to parse</label>
<input type="file" name="fileupload" value="fileupload" id="fileupload">
<input type="submit" name="submit" value="Process File">
</form>
<?php
exit;
}

$input_file = $_FILES["fileupload"]["name"];

if (!(pathinfo(basename($input_file),PATHINFO_EXTENSION) == "txt")) die ("Only text files allowed");
if (!($_FILES["fileupload"]["size"] > 10)) die ("Poor file size");

$a = file_get_contents($_FILES["fileupload"]["tmp_name"]);
$lines = explode("\n", $a);
$cat = '';
$subcat = '';

$max_lines = count($lines);

for ($n=0; $n < $max_lines; $n++) {

//	if ($n > 78) exit; // debug
	$line = $lines[$n];
	if ($line == '') continue;
	if ($n == 0 || (($n+2 < $max_lines && $lines[$n+1] == '' && $lines[$n+2] == '') && $lines[$n-1] == '' && $lines[$n-2] == '')) {
		// get new cat
		$cat = $line;
	} elseif ($lines[$n-1] == '' && $line <> '') {
		// get new subcat
		$subcat = $line;
	} else {
		$catline = $cat . "\t" . $subcat . "\t" . $line . "\n";
		echo $catline;
	}
}

?>
