<?php
/*
// Program       : Passing Arguments into PHP from (Windows) CLI and Parsing them
// Modes         : CLI Arguments, Argument=Value Pairs, long option based getopt() parsing
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2020-02-16
//
// Alt Library   : https://github.com/getopt-php/getopt-php
// Alt Docs      : http://getopt-php.github.io/getopt-php/
*/

// Normal CLI arguments
// ..\php.exe hello.php MyArg1 MyArd2

echo "Hello World\n";

echo print_r($argv, true);

// Parameters parsed in script
// ..\php.exe -f "hello.php" a=fff b=45

if($argc>1)
  parse_str(implode('&',array_slice($argv, 1)), $_GET);

echo print_r($_GET, true);

// Using getopt() to parse them - platform agnostic
// ..\php.exe hello.php --a="fff" --b="45"


$defaultValues = array("a" => "", "b" => "");
// The variable followed by single colon is mandatory value, double colon makes it optional, else mere presence is discerned
$givenArguments = getopt("", array("a:","b::"));
$options = array_merge($defaultValues, $givenArguments);
$a = $options['a'];
$b = $options['b'];

echo '$a = ' . $a . "\n";
echo '$b = ' . $b;

/* Outputs
// ..\php.exe hello.php MyArg1 MyArd2
Hello World
Array
(
    [0] => hello.php
    [1] => MyArg1
    [2] => MyArd2
)

// ..\php.exe -f "hello.php" a=fff b=45
Array
(
    [a] => fff
    [b] => 45
)

// ..\php.exe hello.php --a="fff" --b="45"
$a = fff
$b = 45
*/

