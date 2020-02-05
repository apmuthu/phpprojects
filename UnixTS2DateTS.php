<?php
/*
	Purpose : Example to convert a Unix Timestamp into a readable Date with Time Zone in PHP
	Author  : Ap.Muthu <apmuthu@usa.net>
	Version : 1.0
	Release : 2020-02-05
	Ref     : https://phpzag.com/demo/convert-unix-timestamp-to-date-php/
	Notes   : Current Epoch UnixTimestamp is of 10 digits with appended 3 more digits denoting milliseconds
*/
//$unix_timestamp = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp']+0 : 1580909280; // 05-02-2020 13:28:00 (GMT) - Feb 5th, 2020
$unix_timestamp = isset($_REQUEST['timestamp']) ? $_REQUEST['timestamp']+0 : strtotime(date('Y-m-d H:i:s')); // current date and time
$time_zone_to=isset($_REQUEST['timezones']) ? $_REQUEST['timezones'] : 'Asia/Kolkata';
$time_zone_from="UTC";
$datetime = new DateTime("@$unix_timestamp");
// Display GMT datetime
// echo $datetime->format('d-m-Y H:i:s');
$date_time_format = $datetime->format('Y-m-d H:i:s');
$tz_choices = Array(
	'Asia/Kolkata',
	'Asia/Karachi',
	'Asia/Singapore',
	'Africa/Harare',
	'Australia/Sydney',
	'Australia/Brisbane',
	'Europe/London',
	'Europe/Moscow',
	'America/New_York'
);
$display_date = new DateTime($date_time_format, new DateTimeZone($time_zone_from));
// Date time with specific timezone
$display_date->setTimezone(new DateTimeZone($time_zone_to));
$tz_date = $display_date->format('d-m-Y H:i:s')
?>
<h2>Example: Convert Unix Timestamp To Readable Date Time in PHP</h2>	
<br>
<br>
<br><br>
<form method="post" action="<?php echo $_SERVER["PHP_SELF"]; ?>"> 		
	<div class="form-group">
	<label>Unix Timestamp</label>	
		<input type="text" placeholder="Unix Timestamp" name="timestamp" id="timestamp" value="<?php echo $unix_timestamp; ?>" />			
		&nbsp;<label>Timezones</label>
		<select name="timezones">
<?php
	foreach($tz_choices as $tz) {
		echo "\n			<option value=\"$tz\"" . (($tz == $time_zone_to) ? ' selected="1"' : '') . ">$tz</option>";
	}
?>
		</select>
		&nbsp;&nbsp;<input type="submit" name="convert" class="btn btn-default" value="Convert">				
	</div>			
</form>	
<br><strong>Date/Time:</strong> <?php echo $date_time_format; ?> <strong>(GMT)</strong>
<br><strong>DateTime with Timezone:</strong> <?php echo $tz_date; ?> <strong>(<?php echo $time_zone_to; ?>)</strong>				
