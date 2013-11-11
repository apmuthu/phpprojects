<?php
/*
The Luhn Algorithm is used to generate check digits 
for Credit card numbers among others.
Ref:
  http://stackoverflow.com/questions/1418964/generating-luhn-checksums
  https://github.com/xi-project/xi-algorithm
  http://en.wikipedia.org/wiki/Luhn_algorithm
*/

function Luhn($number) { 

$stack = 0;
$number = str_split(strrev($number));

foreach ($number as $key => $value)
{
    if ($key % 2 == 0)
    {
        $value = array_sum(str_split($value * 2));
    }
    $stack += $value;
}
$stack %= 10;

if ($stack != 0)
{
    $stack -= 10;     $stack = abs($stack);
}


$number = implode('', array_reverse($number));
$number = $number . strval($stack);

return $number; }

?>
