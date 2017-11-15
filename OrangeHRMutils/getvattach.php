<?php
/*
// Program       : Public download from the OrangeHRM v3.3.3 Free Edition's Job Vacancy Attachment table
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-08-05
//
// Example Usage :
//   http://ohrm.example.com/getvattach,php?vid=2
//
// Notes:
// The standard free edition does not allow external visitors to download job vacancy attachments
// Use this script in your urls to allow such access
*/

include './ohrm_dbconnect.php';

// "vid" is the url parameter which matches the "id" of the Job Vacancy Attachments table
$vid = isset($_REQUEST['vid']) ? $_REQUEST['vid']+0 : false; // VAttachID 

if ($vid) {
$sql = "SELECT * FROM `ohrm_job_vacancy_attachment` WHERE id = $vid";
} else die ("No Vacancy Attachment ID provided");

//echo $sql;
//exit;

extract(onerec($sql));

/*
$arr = get_defined_vars();
echo print_r($arr, true);

    [vid] => 1
    [sql] => SELECT * FROM `ohrm_job_vacancy_attachment` WHERE id = 1
    [id] => 1
    [vacancy_id] => 2
    [file_name] => Concorde FS.docx
    [file_type] => application/vnd.openxmlformats-officedocument.wordprocessingml.document
    [file_size] => 9914
    [file_content] =>
	[attachment_type] => 
    [comment] => C FS 001
*/

$file_name = str_replace(array("\t", "\n", "\r", '"', "'", "`", '/'), '', $file_name);
header("Cache-Control: no-cache, must-revalidate");
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
header("Content-length: $file_size");
header("Content-type: $file_type");
header("Content-Disposition: attachment; filename=\"$file_name\"");
ob_clean();
flush();
echo $file_content;

?>

