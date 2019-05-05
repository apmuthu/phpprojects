<?php
$link=mysqli_connect('localhost','root','');
mysqli_select_db($link, 'locations');

$country=$_GET['country']+0;
$state_options = '';
if ($country > 0) {
	$query = "SELECT * FROM states WHERE country_id=$country";
	$result = mysqli_query($link, $query);
	$state_options .= "<select id='statedd' onChange='change_state();'>\n";
	while ($row = mysqli_fetch_assoc($result))
		$state_options .= "<option value=$row[id]>$row[name]</option>\n";
	$state_options .= "</select>\n";
	echo $state_options;
}

$state=$_GET['state']+0;
$city_options = '';
if ($state > 0) {
	$query = "SELECT * FROM cities WHERE state_id=$state";
	$result = mysqli_query($link, $query);
	$city_options .= "<select>\n";
	while ($row = mysqli_fetch_assoc($result))
		$city_options .= "<option value=$row[id]>$row[name]</option>\n";
	$city_options .= "</select>\n";
	echo $city_options;
}
