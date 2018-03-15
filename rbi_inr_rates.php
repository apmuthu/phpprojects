<?php
/*
	Purpose: Get the latest Reserve Bank of India Forex rates
	Author : Ap.Muthu <apmuthu@usa.net>
	Release: 2018-03-15
	Usage  : echo print_r(get_rbi_rates(), true);
	Output : Array([date] => 2018-03-15, [USD] => 64.9366, [EUR] => 80.5845, [GBP] => 90.8265, [YEN] => 0.6099);
	Notes  : Valid for USD, EUR, GBP, YEN to INR only
*/

function get_rbi_rates() {

	$months=Array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
	$xchg_rates = Array();
	$url = 'https://rbi.org.in/scripts/BS_DisplayReferenceRate.aspx';
	$contents = file_get_contents($url);
	$parts = explode('US Dollar is ₹ ', $contents);
	$part = explode(' ', $parts[1]);
	$date['month']=str_pad(array_search($part[2], $months)+1, 2, '0', STR_PAD_LEFT);
	$p1=explode(',',$part[3]);
	$date['day']=$p1[0];
	$p1=explode('.',$part[4]);
	$date['year']=$p1[0];

	$xchg_rates['date'] = $date['year'] . '-' . $date['month'] . '-' . $date['day'];

	$xchg_rates['USD']=$part[0];
	$parts = explode('US Dollar', $parts[1]);

	$part = explode('1 EUR</td>        <td align="center">', $parts[1]);
	$part = explode('<', $part[1]);
	$xchg_rates['EUR']=$part[0];

	$part = explode('1 GBP</td>        <td align="center">', $parts[1]);
	$part = explode('<', $part[1]);
	$xchg_rates['GBP']=$part[0];

	$part = explode('100 YEN</td>        <td align="center">', $parts[1]);
	$part = explode('<', $part[1]);
	$xchg_rates['YEN']=$part[0]/100.0;

	return $xchg_rates;
}

?>
