<?php
	$max = (isset($_REQUEST['max']) && $_REQUEST['max'] > 0) ? $_REQUEST['max']+0 : 20;
	echo mt_rand(0,$max);
?>