<?php
/*
// Program       : Submit the base64 encoded value of a form field using JS
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2020-07-27
// Variations    : Use for encryption during submission of form contents and for Unicode too
// Notes         : Uncode must first be converted to 8 bit and then used here as in the reference
// Reference     : https://attacomsian.com/blog/javascript-base64-encode-decode
*/

if (isset($_POST['B1'])) {
	echo print_r($_POST, true);
	exit;
}
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>JS Test Form</title>

</head>

<body bgcolor="#FFFFFF">

<form method="POST">
    <p>
		<input type="text" size="20" id='txtstr' name="T1">
<!--		<input type="hidden" id='str64' name="T2"> -->
		<input type="submit" name="B1" id='btnencode64' value="Submit">
	</p>
</form>
<script type="text/javascript">
// register onclick events for encode button
document.getElementById('btnencode64').onclick = function() {
  var txt_string = document.getElementById('txtstr').value;      // gets data from textarea

  // encode data and adds it in #str64 element
//  document.getElementById('str64').value = btoa(txt_string);
  document.getElementById('txtstr').value = btoa(txt_string);
  return true;
}
</script>
</body>
</html>
