<?php
/*
// Program       : Extract text from *.docx MS Word document
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2018-04-22
// Usage Notes   : Returns stripped out text content. array_2_csv function included.
// Reference     : https://stackoverflow.com/questions/10646445/read-word-document-in-php
*/

function read_docx($filename) {

    $stripped_content = '';
    $content = '';

    if(!$filename || !file_exists($filename)) return false;

    $zip = zip_open($filename);
    if (!$zip || is_numeric($zip)) return false;

    while ($zip_entry = zip_read($zip)) {

        if (zip_entry_open($zip, $zip_entry) == FALSE) continue;

        if (zip_entry_name($zip_entry) != "word/document.xml") continue;

        $content .= zip_entry_read($zip_entry, zip_entry_filesize($zip_entry));

        zip_entry_close($zip_entry);
    }
    zip_close($zip);      
    $content = str_replace('</w:r></w:p></w:tc><w:tc>', " ", $content);
    $content = str_replace('</w:r></w:p>', "\r\n", $content);
    $stripped_content = strip_tags($content);

    return $stripped_content;
}

function array_2_csv($array, $delim = chr(9)) {
	$csv = array();
	foreach ($array as $item=>$val) {
		$val = str_replace("\n", "|",$val);
		if (is_array($val)) { 
			$csv[] = array_2_csv($val);
			$csv[] = "\n";
		} else {
			$csv[] = $val;
		}
	}
	return implode($delim, $csv);
}
?>
