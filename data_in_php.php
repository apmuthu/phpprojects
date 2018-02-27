<?php
/*
// Program  : Access string at end of code in a php file
// Source   : PHP Manual Example <http://php.net/manual/en/function.halt-compiler.php>
// Use case : As binary data, in installers, to separate model, view and controller logic from one another
// Notes    : Any script including this file will continue execution
*/

// open this file
$fp = fopen(__FILE__, 'r');

// seek file pointer to data
fseek($fp, __COMPILER_HALT_OFFSET__);

// and output it
var_dump(stream_get_contents($fp));

// or just execute it
eval(file_get_contents(__FILE__,null,null,__COMPILER_HALT_OFFSET__));

// the end of the script execution
__halt_compiler();echo "the installation data (eg. tar, gz, PHP, etc.)";