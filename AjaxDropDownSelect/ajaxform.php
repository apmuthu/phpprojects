<?php
/*
// Program        : Cascading Drop Down Select Box using ajax script and native js only
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2019-05-05
// Usage Notes    : Browse to ajaxform.php file; ajax.php gets state and city filtered lists
// Tutorial       : http://www.iamrohit.in/countries-states-and-cities-database-of-world-in-mysql/
// Reference Data : https://github.com/hiiamrohit/Countries-States-Cities-database
*/

$link=mysqli_connect('localhost','root','');
mysqli_select_db($link, 'locations');
$query = "SELECT * FROM countries";
$result = mysqli_query($link, $query);
$country_options = '';
while ($row = mysqli_fetch_assoc($result))
	$country_options .= "<option value=$row[id]>$row[name]</option>\n";

?>
<form name='form1' action='' method='post'>
<table>
<tr>
	<td>Select Country</td>
	<td><select id='countrydd' onChange='change_country();'><option>Select Country</option><?php echo $country_options; ?></select></td>
</tr>
<tr>
	<td>Select State</td>
	<td>
		<div id='state'>
			<select id='statedd' onChange='change_state();'><option>Select State</option></select>
		</div>
	</td>
</tr>
<tr>
	<td>Select City</td>
	<td>
		<div id='city'>
			<select><option>Select City</option></select>
		</div>
	</td>
</tr>
</table>
</form>

<script type='text/javascript'>
function change_country() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open('GET','ajax.php?country='+document.getElementById('countrydd').value, false);
	xmlhttp.send(null);
//	alert(xmlhttp.responseText); // debug
	document.getElementById('state').innerHTML=xmlhttp.responseText;
	change_state(); // reset cities for new state
}

function change_state() {
	var xmlhttp=new XMLHttpRequest();
	xmlhttp.open('GET','ajax.php?state='+document.getElementById('statedd').value, false);
	xmlhttp.send(null);
//	alert(xmlhttp.responseText); // debug
	document.getElementById('city').innerHTML=xmlhttp.responseText;
}
</script>



