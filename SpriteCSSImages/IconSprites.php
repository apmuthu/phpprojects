<?php
/*
// Program       : Demonstration of multiple images display from a sprite image in CSS
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2016-06-24
// Last Updated  : 2016-06-25
// Usage         : Adapt this Example file for use in a page hit counter
*/

$a = mt_rand(1000000,9999999);
$ln = strlen($a)-1;
$b = '<span class="icon d#"></span>';
$v = '<div class="icon d#"></div>';
$spc = '&nbsp;';
$c = str_split($a);
$hit = '';
$vhit = '';
foreach ($c as $k => $digit) {
	$ht = str_replace('#', $digit, $b) . "\n";
	$hit .= $ht;
	$vht = str_replace('#', $digit, $v) . "\n";
	$vhit .= $vht;
}

?>
<html>
<head>
<title>Sprite Images with CSS</title>
<style>
span {padding-right: 16px;}
.icon {
	background-image: url('./blue-emboss-digits.png');
	background-repeat: no-repeat;
	height: 22px;
	overflow: hidden;
	padding-bottom: 1px;
}

.d1 {background-position:  2px 0px; width: 15px;}
.d2 {background-position: -14px 0px; width: 16px;}
.d3 {background-position: -31px 0px; width: 16px;}
.d4 {background-position: -48px 0px; width: 17px;}
.d5 {background-position: -66px 0px; width: 17px;}
.d6 {background-position: -84px 0px; width: 16px;}
.d7 {background-position: -101px 0px; width: 16px;}
.d8 {background-position: -118px 0px; width: 16px;}
.d9 {background-position: -135px 0px; width: 17px;}
.d0 {background-position: -153px 0px; width: 16px;}
</style>
</head>
<body>
<h2>Sprite Images with CSS</h2>
<h3> Source Image </h3>

<img src="./blue-emboss-digits.png"><br>
The size of the image used above is 169 x 22px.<br>
The enlarged image with the coordinates marked is <a href="./sprite_image_coods.png" target="_blank">here</a>.<br>

<h3>Horizontal</h3>

<!--
<span class="icon d1"></span>
<span class="icon d2"></span>
<span class="icon d3"></span>
<span class="icon d4"></span>
<span class="icon d5"></span>
<span class="icon d6"></span>
<span class="icon d7"></span>
<span class="icon d8"></span>
<span class="icon d9"></span>
<span class="icon d0"></span>
-->

<?php echo $hit; ?>
<br>
<b>SPAN</b> is used where no line break is desired.<br>
Firefox needs the SPAN <b>width</b> to be explicity specified.<br>


<h3>Vertical</h3>

<!--
<div class="icon d1"></div>
<div class="icon d2"></div>
<div class="icon d3"></div>
<div class="icon d4"></div>
<div class="icon d5"></div>
<div class="icon d6"></div>
<div class="icon d7"></div>
<div class="icon d8"></div>
<div class="icon d9"></div>
<div class="icon d0"></div>
-->

<?php echo $vhit; ?>
<br>
<b>DIV</b> is used for block lines where a line break occurs on closing the tag.<br>
<br>

<p>
    <b><u>References:</u></b><br>
    <a href="http://www.webdesigndev.com/display-icons-using-a-single-image-and-css-sprites" target="_blank">Display Icons using a single consolidated image and CSS Sprites</a><br>
    <a href="https://css-tricks.com/css-sprites" target="_blank">CSS Tricks - Generate CSS Sprites</a>
</p>

</body>
</html>
