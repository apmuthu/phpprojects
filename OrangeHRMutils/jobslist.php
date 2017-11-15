<?php
/*
// Program       : List OrangeHRM v3.3.3 Free Edition's Job Vacancies
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2017-08-05
//
// Example Usage :
//   Get Jobs List for a specific Manager - http://ohrm.example.com/jobslist,php?hid=1
//   Get Details of Specific Job - http://ohrm.example.com/jobslist,php?jid=2
//
// Notes:
// The standard free edition does not allow external visitors to view a Job Title's description
// Use this script in your urls to allow such access (jid).
*/

include './ohrm_dbconnect.php';

$hid = isset($_REQUEST['hid']) ? $_REQUEST['hid']+0 : false; // Manager
$jid = isset($_REQUEST['jid']) ? $_REQUEST['jid']+0 : false; // Vacancy

$url = $_SERVER['PHP_SELF'];

$page_title = 'Job Vacancy Summary';

if ($hid) {
    $sql = "SELECT 
      `emp_firstname` AS `Manager` 
    , `name` AS `Post` 
    , `no_of_positions` AS `Positions` 
    , (SELECT COALESCE(GROUP_CONCAT(DISTINCT CONCAT('<a href=\"getvattach.php?vid=',`ohrm_job_vacancy_attachment`.`id`,'\" target=\"_blank\">',`ohrm_job_vacancy_attachment`.`id`,'</a>') SEPARATOR ', '), '') AS `VAttachID` FROM `ohrm_job_vacancy_attachment` WHERE `vacancy_id` = `ohrm_job_vacancy`.`id`) AS `Documents`
    , CONCAT('<a href=\"/symfony/web/recruitmentApply/applyVacancy/id/',`ohrm_job_vacancy`.`id`,'\" target=\"_blank\">Apply</a>') AS `Links`
    , CONCAT('<a href=\"$url?jid=',`ohrm_job_vacancy`.`id`,'\" target=\"_blank\">Details</a>') AS `Details`
FROM `ohrm_job_vacancy` INNER JOIN `hs_hr_employee` ON (`hiring_manager_id` = `emp_number`) 
WHERE `status` = 1 AND `hiring_manager_id` = $hid
";
} else if ($jid) {
    $sql = "
SELECT
    `ohrm_job_vacancy`.`id`
    , `ohrm_job_vacancy`.`hiring_manager_id` AS `ManagerID`
    , GROUP_CONCAT(DISTINCT CONCAT('<a href=\"getvattach.php?vid=',`ohrm_job_vacancy_attachment`.`id`,'\" target=\"_blank\">',`ohrm_job_vacancy_attachment`.`id`,'</a>') SEPARATOR ', ') AS `Documents`
    , `hs_hr_employee`.`emp_firstname` AS `Manager`
    , `ohrm_job_title`.`job_title` AS `Job Title`
    , CONCAT(`ohrm_job_title`.`job_description`, '<br>', `ohrm_job_vacancy`.`description`) AS `Job Description`
FROM
    `ohrm_job_vacancy`
    LEFT JOIN `ohrm_job_title` 
        ON (`ohrm_job_vacancy`.`job_title_code` = `ohrm_job_title`.`id`)
    LEFT JOIN `ohrm_job_vacancy_attachment` 
        ON (`ohrm_job_vacancy_attachment`.`vacancy_id` = `ohrm_job_vacancy`.`id`)
    LEFT JOIN `hs_hr_employee` 
        ON (`ohrm_job_vacancy`.`hiring_manager_id` = `hs_hr_employee`.`emp_number`)
WHERE (`ohrm_job_title`.`is_deleted` = 0
    AND `ohrm_job_vacancy`.`id` = $jid)
";
    $page_title = 'Job Position Detail';
} else die ("No Manager or Vacancy requested");

$caption = '<h2>Job Vacancies</h2>';
$html_table = sql_to_html_table($sql, $caption);
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">

<style type="text/css">
table              { border-collapse: collapse; }
table, th, td      { border: 1px solid black; }
th, td             { padding: 5px; text-align: left; }
tr:nth-child(even) { background-color: #f2f2f2 }
tr:hover           { background-color: #ddd; }
caption            { caption-side: top; }
</style>

<!-- Addition Styling for Tooltips
<style type="text/css">
.CellWithComment{position:relative;}
.CellComment {
	visibility: hidden;
	width: auto;
	position:absolute; 
	z-index:100;
	text-align: Left;
	opacity: 0.4;
	transition: opacity 2s;
	border-radius: 6px;
	background-color: #ccc;
	padding:3px;
	top:-30px; 
	left:0px;
}   
.CellWithComment:hover span.CellComment {visibility: visible;opacity: 1;}
</style>
-->

<title><?php echo $page_title; ?></title>
</head>

<body bgcolor="#FFFFFF">

<p>&nbsp;</p>

<?php echo $html_table; ?>

</body>
</html>
