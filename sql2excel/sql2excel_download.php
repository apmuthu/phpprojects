<?php

// Get previous month in Yr-mon format
$yrmon = (isset($_REQUEST['ym']) ? trim($_REQUEST['ym']) : date('Y-m', strtotime('-1 month', time())));
$PBXName = "MyPBX";
$filepfx = $PBXName . '_CDRs_' . $yrmon;
$filepfx = str_replace('-','',$filepfx);

/*
// custom/ntf overlaps calls
// Other lastapp: PlayBack, Wait, Set, SayAlpha, AGI
// Other disposition: BUSY
// Other lastdata: DAHD, ss-n, __NO

	SUM(IF(
	(
	(disposition IN ('NO ANSWER','ANSWERED') AND lastdata LIKE 'SIP/%')
	OR
	(lastdata LIKE 'custom/ntf%')
	OR
	(lastapp NOT IN ('Hangup','BackGround','Dial'))
	)
	, 1, 0)
	) AS TCalls,

*/

$query="
	SELECT calldate, src AS clid, duration AS sec
	FROM cdr 
	WHERE calldate LIKE '$yrmon%' 
		AND lastdata LIKE 'SIP/%' 
		AND  disposition='ANSWERED'
	ORDER BY calldate ASC
";
$query1=base64_encode($query);

$query="
SELECT DATE_FORMAT(calldate, '%d-%b-%Y') AS CallDate,
	SUM(IF((disposition='ANSWERED'), IF((lastdata LIKE 'SIP/%'), 1, 0), 0)) AS OpAns, 
	SUM(IF((disposition='NO ANSWER'), IF((lastdata LIKE 'SIP/%'), 1, 0), 0)) AS OpNotAns, 
	SUM(IF((lastdata LIKE 'custom/ntf%'), 1, 0)) AS NTF,
	SUM(IF((lastapp NOT IN ('Hangup','BackGround','Dial')), 1, 0)) AS Others, 
	COUNT(*) AS AllCalls 
FROM cdr
WHERE DATE_FORMAT(CallDate, '%Y-%m') = '$yrmon'
GROUP BY DATE_FORMAT(calldate, '%Y-%m-%d')
";
$query2=base64_encode($query);


$query="
SELECT DATE_FORMAT(calldate, '%d-%b-%Y') AS CallDate, 
	DATE_FORMAT(calldate, '%H') AS CallHour,
	SUM(IF((disposition='ANSWERED'), IF((lastdata LIKE 'SIP/%'), 1, 0), 0)) AS OpAns,
	SUM(IF((disposition='NO ANSWER'), IF((lastdata LIKE 'SIP/%'), 1, 0), 0)) AS OpNotAns,
	SUM(IF((lastdata LIKE 'custom/ntf%'), 1, 0)) AS NTFTryAgain,
	SUM(IF((lastapp NOT IN ('Hangup','BackGround','Dial')), 1, 0)) AS Others, 
	COUNT(*) AS Calls 
FROM cdr
WHERE DATE_FORMAT(CallDate, '%Y-%m') = '$yrmon'
GROUP BY DATE_FORMAT(calldate, '%Y-%m-%d %H')
";
$query3=base64_encode($query);

?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title><?php echo $PBXName; ?> Call Log Sheets</title>
</head>

<body bgcolor="#FFFFFF">

<h2><?php echo $PBXName; ?> Call Log Sheets</h2>

<p>Download logs in Excel Format for <?php echo $yrmon; ?></p>

<ul>
    <li><a href="./sql2excel_cdr.php?query=<?php echo $query1; ?>&f=<?php echo $filepfx; ?>_Calls">Call Records</a></li>
    <li><a href="./sql2excel_cdr.php?query=<?php echo $query2; ?>&f=<?php echo $filepfx; ?>_Daily">Daily Call Summary</a></li>
    <li><a href="./sql2excel_cdr.php?query=<?php echo $query3; ?>&f=<?php echo $filepfx; ?>_Hourly">Hourly Call Summary</a></li>
</ul>

<p>Powered by Ap.Muthu's modified SQL2Excel</p>
<p>&nbsp;</p>
</body>
</html>

