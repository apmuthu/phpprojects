<?php
$id = isset($_GET['f']) ? $_GET['f']+0 : FALSE;

if ($id === FALSE) exit;

?>
<html>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>SC OTP Form</title>
</head>

<body>

<p>Generic One Time Update Form</p>

<form action="process_form.php?f=<?php echo $id; ?>" method="POST" name="OTPForm">
    <table border="0">
        <tr>
            <td>Update Hash </td>
            <td><input type="text" size="64" name="RecHash"></td>
        </tr>
        <tr>
            <td>Field1</td>
            <td><input type="text" size="20" name="Field1"></td>
        </tr>
        <tr>
            <td>Field2</td>
            <td><input type="text" size="20" name="Field2"></td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td><input type="submit" name="Submit_sc_form" value="Submit"></td>
        </tr>
    </table>
</form>
</body>
</html>
