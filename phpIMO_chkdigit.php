<?php
/*
	Purpose   : Generate and append IMO check digit
	Author    : Ap.Muthu <apmuthu@usa.net>
	Release   : 2021-03-13
	Algorithm : For IMO 9074729, compute (9×7) + (0×6) + (7×5) + (4×4) + (7×3) + (2×2) = 139.
				The last digit of the sum is the check digit.
	Reference : https://en.wikipedia.org/wiki/IMO_number#Structure
				https://www.imo.org/en/OurWork/MSAS/Pages/IMO-identification-number-scheme.aspx
	Usage :
		$st   = 100227; // first 6 characters of the IMO number. The last one is a check digit
		$st   = substr($st, 0, 6); // truncate to first 6 digits if more
		$n    = 25; // number of IMOs to generate
		$nd   = $st + $n; // Next batch starting IMO to generate from
		$imos = array();
		for ($imo = $st; $imo < $nd; $imo++) {
			$imos[] = get_imo_checkdigit($imo);
		}
		echo implode(",",$imos);
*/

function get_imo_checkdigit($imo) {
    $cal = str_split ( $imo);
    $sum  = 0;
    for ($i=6; $i>0; $i--) {
        $sumx = ($cal[6-$i] * ($i+1));
        $sum += $sumx;
    }
    $parts = str_split($sum);
    $imo_str = $imo.end($parts);
    return $imo_str;
}
?>
