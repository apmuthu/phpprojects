<?php
/*
// Program       : Save a variable in a php file for inclusion in other php files
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-09-07
// Usage Storing : $contents = 'ABC'; var2file($contents, "contents", 'storedvar.php');
// Usage Restore : include 'storedvar.php';
//
// Ref: http://stackoverflow.com/questions/2995461/save-php-variables-to-a-text-file
// variable name can be taken from PHP native compact() function
*/

function var2file($var, $var_name, $filename) {
	$var_str = var_export($var, true);
	$var = "<?php\n\n\$$var_name = $var_str;\n\n?>";
	file_put_contents("$filename", $var);
}
