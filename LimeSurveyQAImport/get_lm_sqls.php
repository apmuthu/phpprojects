<?php

include 'ls_link.php';

/*
if ($_FILES['QAFile']['error'] > 0) {
  echo 'Error: ' . $_FILES['QAFile']['error'] . '<br />';
} else {
  echo 'Upload: ' . $_FILES['QAFile']['name'] . '<br />';
  echo 'Type: ' . $_FILES['QAFile']['type'] . '<br />';
  echo 'Size: ' . ($_FILES['QAFile']['size'] / 1024) . ' Kb<br />';
  echo 'Stored in: ' . $_FILES['QAFile']['tmp_name'];
}

Upload: sample2_questions.txt
Type: text/plain
Size: 4.9462890625 Kb
Stored in: D:\WebServers\XAMPP\tmp\php5A.tmpno valid Question and Answer File
*/

/*
echo print_r($_POST, true);
Array
(
    [QTPfx] => INS
    [QTSfx] => 3
    [QLMbutton] => Get LM SQLs
)
echo print_r($_FILES, true);
//    [QAFile] => sample2_questions.txt
exit;
*/

if (!isset($_POST['QLMbutton']) || $_POST['QLMbutton'] <> 'Get LM SQLs') die ('no valid Submission');
if (!isset($_POST['QTPfx']) || strlen($_POST['QTPfx']) < 2) die ('no valid Question Title Prefix');
if (!isset($_POST['QTSfx']) || ($_POST['QTSfx']+0) < 2) die ('no valid Question Title Suffix Length');
if (!isset($_FILES['QAFile']['name']) || strlen($_FILES['QAFile']['name']) < 6) die ('no valid Question and Answer File');
if (!isset($_FILES['QAFile']['type']) || $_FILES['QAFile']['type'] <> 'text/plain') die ('no valid Question and Answer File Type');
if (!isset($_FILES['QAFile']['size']) || $_FILES['QAFile']['size'] <= 10) die ('empty Question and Answer File');

$a = file_get_contents($_FILES['QAFile']['tmp_name']);
unlink($_FILES['QAFile']['tmp_name']);

// Inputs

// $qfile = 'sample2_questions.txt';
// $a = file_get_contents( $qfile );
// $QCodePfx = 'CMP';
// $QSfxSize = 3;
$QTRand = (isset($_POST['QTRand']) && ($_POST['QTRand'])+0 == 1);
$QCodePfx = trim($_POST['QTPfx']);
$QSfxSize = $_POST['QTSfx']+0;
$QSfxPad = '0';

// Constants

$lf = chr(10);
$lflf = $lf.$lf;
$cr = chr(13);
$crlf = $cr.$lf;
$brlf = '<br>' . $lf;
$t1 = chr(9);
$t2 = str_repeat($t1, 2);
$t3 = str_repeat($t1, 3);


// Variables

$QCPfxLen = strlen($QCodePfx);
while (strpos($a, $crlf) !== false) $a = str_replace($crlf, $lf, $a);
while (strpos($a, $lflf) !== false) $a = str_replace($lflf, $lf, $a);
$a = str_replace("'", "", $a); // remove single quotes
$a = str_replace('"', '', $a); // remove double quotes
$a = str_replace(';', '.', $a); // remove semicolons

$a = explode($lf, $a);
$b = Array();
$sid=0;
$slang='en';
$gid=0;

$QSfxStart = 0; // last question title numbering
$sql = "SELECT COALESCE(MAX(MID(`title`,1+$QCPfxLen,$QSfxSize)+0),0) AS QSfxStart FROM $tblpfx"."questions WHERE MID(`title`,1,$QCPfxLen) = '$QCodePfx'";
foreach ($conn->query($sql) as $row) {
	$QSfxStart = $row['QSfxStart'];
}


$qid = 0; // last question id

$sql = "SELECT MAX(qid) AS maxqid FROM $tblpfx".'questions';
foreach ($conn->query($sql) as $row) {
	$qid = $row['maxqid'];
}

$ans = '1'; // redundant if properly formatted input file
$outsqls = '';

foreach ($a as $line) { 
	$d = trim($line); 
	$e = strlen($d);
	if ($e != 0) {
		if (substr($line,0,3) == $t3) { 
			$b[$sid][$gid][$qid]['A'.$ans] = $d; 
			$aval = 0;
			// Generate Default Answer SQLs
			if ($ans == 1) {
				$aval = 1;
//				$outsqls .= "INSERT INTO $tblpfx".'defaultvalues (`qid`,`scale_id`,`sqid`,`language`,`specialtype`,`defaultvalue`) VALUES (';
//				$outsqls .= $qid . ", 0, 0, '$slang', '', 'A$ans');" . $lf;
			}
			// Generate Answer SQLs
			$outsqls .= "INSERT INTO $tblpfx".'answers (`qid`,`code`,`answer`,`sortorder`,`assessment_value`,`language`,`scale_id`) VALUES (';
			$outsqls .= $qid . ", 'A$ans', '$d', $ans, $aval, '$slang', 0);" . $lf;

			$ans++; 
		} elseif (substr($line,0,2) == $t2) { 
			$QSfxStart++;
			$qid++;
			$b[$sid][$gid][$qid]['Q'] = $d;
			// Generate Question Attribute SQLs;
			$outsqls .= $lf;
			$outsqls .= "INSERT INTO $tblpfx".'question_attributes (`qaid`,`qid`,`attribute`,`value`,`language`) VALUES ';
			if ($QTRand)
				$outsqls .= "(NULL, " . $qid . ", 'random_order', '1', NULL), (NULL, " . $qid . ", 'random_group', '1', NULL);" . $lf;
			else
				$outsqls .= "(NULL, " . $qid . ", 'random_order', '1', NULL);" . $lf;
			// Generate Question SQLs
			$QCode = $QCodePfx . str_pad($QSfxStart, $QSfxSize, $QSfxPad, STR_PAD_LEFT);  
			$outsqls .= "INSERT INTO $tblpfx".'questions (`qid`,`parent_qid`,`sid`,`gid`,`type`,`title`,`question`,`preg`,`help`,`other`,`mandatory`,`question_order`,`language`,`scale_id`,`same_default`,`relevance`) VALUES (';
			if ($QTRand)
				$outsqls .= $qid . ", 0, $sid, $gid, 'L', '$QCode', '$d', '', '', 'N', 'N', 1,'$slang', 0, 0, '1');" . $lf; // Randomisation
			else
				$outsqls .= $qid . ", 0, $sid, $gid, 'L', '$QCode', '$d', '', '', 'N', 'N', $qid,'$slang', 0, 0, '1');" . $lf; // Non Randomisation

			$ans = 1;
		} elseif (substr($line,0,1) == $t1) { 
			$sql = "SELECT gid FROM $tblpfx"."groups WHERE group_name='$d' AND sid=$sid AND language='$slang' LIMIT 0,1";
			foreach ($conn->query($sql) as $row) {
				$gid = $row['gid'];
				$b[$sid][$gid]['QGroup'] = $d;
				$ans = 1;
			}
		} else {
			$sql = "SELECT surveyls_survey_id AS sid, surveyls_language AS slang FROM $tblpfx"."surveys_languagesettings WHERE surveyls_title='$d' LIMIT 0,1";
			foreach ($conn->query($sql) as $row) {
				$sid = $row['sid'];
				$slang = $row['slang'];
				$b[$sid]['QBankSet'] = $d;
				$b[$sid]['Language'] = $slang;
				$ans = 1;
			}
		}
	}
}
// close PDO
$conn = null;

$ymd = date('YmdHis');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=LMsqls_s$sid"."_$slang"."_g$gid"."_$ymd.sql");
header("Pragma: no-cache");
header("Expires: 0");

//echo print_r($b, true);
echo $outsqls;

