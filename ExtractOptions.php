<?php
/*
Purpose: Extract an array of values and display strings from dropdown select box html string
Author : Ap.Muthu <apmuthu@usa.net>
Release: 2017-02-04
*/

function (extract_options($str, $pfx='" value="') {
	$b = explode($pfx, $str);
	$vals = array();
	foreach ($b as $c) {
		$d = explode('>',$c);
		$d = explode('<',$d[1]);
		$vals[$c+0] = $d[0];
		//  $vals[$c+0] = str_replace(' ','-',str_replace(',','',strtolower($d[0])));
	}
	$vals = array_filter($vals); // remove blank elements
	ksort($vals);
	return $vals;
}

/*
// Usage: 
$a = <<<EOFL
<div class="blockcontent">
<label for="cat">Chhaisgarh Districts</label>
<select name="cat" id="cat">
	<option value="-1">Select Category</option>
	<option class="level-0" value="5">Ambikapur,Chhattisgarh</option>
	<option class="level-0" value="26">Anjora,Chhattisgarh</option>
	<option class="level-0" value="21">Bacheli,Chhattisgarh</option>
	<option class="level-0" value="13">Baikunthpur,Chhattisgarh</option>
	<option class="level-0" value="9">Bastar,Chhattisgarh</option>
	<option class="level-0" value="16">Bhilai,Chhattisgarh</option>
	<option class="level-0" value="6">Bilaspur,Chhattisgarh</option>
	<option class="level-0" value="25">Chhattisgarh</option>
	<option class="level-0" value="23">Chhattisgarh,Dantewada</option>
	<option class="level-0" value="14">Chhattisgarh,Dhamtari</option>
	<option class="level-0" value="7">Chhattisgarh,Durg</option>
	<option class="level-0" value="4">Chhattisgarh,Jagdalpur</option>
	<option class="level-0" value="29">Chhattisgarh,Janjgir-Champa</option>
	<option class="level-0" value="15">Chhattisgarh,Jashpur</option>
	<option class="level-0" value="11">Chhattisgarh,Kanker</option>
	<option class="level-0" value="19">Chhattisgarh,Kirandul</option>
	<option class="level-0" value="12">Chhattisgarh,Korba</option>
	<option class="level-0" value="18">Chhattisgarh,Koriya</option>
	<option class="level-0" value="27">Chhattisgarh,Kunkuri</option>
	<option class="level-0" value="22">Chhattisgarh,Kusumkasa</option>
	<option class="level-0" value="305">Chhattisgarh,Mahasamund</option>
	<option class="level-0" value="17">Chhattisgarh,Neora</option>
	<option class="level-0" value="28">Chhattisgarh,Pathalgaon</option>
	<option class="level-0" value="10" selected="selected">Chhattisgarh,Raigarh</option>
	<option class="level-0" value="3">Chhattisgarh,Raipur</option>
	<option class="level-0" value="20">Chhattisgarh,Rajnandgaon</option>
	<option class="level-0" value="8">Chhattisgarh,Surguja</option>
	<option class="level-0" value="240">Raipur</option>
	<option class="level-0" value="1">Uncategorized</option>
</select>
EOFL;

$vals = extract_options($a);
echo print_r($vals, true);

// Output: 
Array
(
    [1] => Uncategorized
    [3] => Chhattisgarh,Raipur
    [4] => Chhattisgarh,Jagdalpur
    [5] => Ambikapur,Chhattisgarh
    [6] => Bilaspur,Chhattisgarh
    [7] => Chhattisgarh,Durg
    [8] => Chhattisgarh,Surguja
    [9] => Bastar,Chhattisgarh
    [10] => Chhattisgarh,Raigarh
    [11] => Chhattisgarh,Kanker
    [12] => Chhattisgarh,Korba
    [13] => Baikunthpur,Chhattisgarh
    [14] => Chhattisgarh,Dhamtari
    [15] => Chhattisgarh,Jashpur
    [16] => Bhilai,Chhattisgarh
    [17] => Chhattisgarh,Neora
    [18] => Chhattisgarh,Koriya
    [19] => Chhattisgarh,Kirandul
    [20] => Chhattisgarh,Rajnandgaon
    [21] => Bacheli,Chhattisgarh
    [22] => Chhattisgarh,Kusumkasa
    [23] => Chhattisgarh,Dantewada
    [25] => Chhattisgarh
    [26] => Anjora,Chhattisgarh
    [27] => Chhattisgarh,Kunkuri
    [28] => Chhattisgarh,Pathalgaon
    [29] => Chhattisgarh,Janjgir-Champa
    [240] => Raipur
    [305] => Chhattisgarh,Mahasamund
)
*/

?>
