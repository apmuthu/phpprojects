<?php
/*
Purpose: To obtain an array of Forex rates from Bloomberg
         This method will not get the instantaneous rate
         It will possibly be correct to a few minutes ago
  	 As on date 190 currency rates to USD are available
Author :  Ap.Muthu <apmuthu@usa.net>
Release: 2013-06-07
*/

function get_bloomberg_rates() {
	$contents = file_get_contents("http://www.bloomberg.com/jscommon/calculators/currdata.js");
/*
	$filename='currdata.js';
	$handle =  fopen($filename, "r");
	$contents = '';
	while (!feof($handle)) {
		$contents .= fread($handle, 8192);
	}
	fclose($handle);
*/

	$lines= explode(chr(10), $contents);

	$price = Array();

	foreach ($lines as $line) {
		$line = trim($line);
		if (empty($line)) continue;
		if (substr($line,0,1) == 'v') continue;
		$line = str_replace(':CUR', '', $line);
		// St Helena Pound exception
		$line = str_replace('SHPUSD', 'SHP', $line);
		eval("$".$line);
	}
	return $price;
}

/*
// Example Usage
$rates = get_bloomberg_rates();
echo 'Exchange rates: ' . print_r($rates, true);
echo 'No. of Rates: ' . count($rates);
*/

/*
Sample Output for example usage above:
Exchange rates: Array
(
    [AFN] => 55.78
    [ALL] => 106.345
    [DZD] => 78.9543
    [XAL] => -99
    [ADP] => 125.521
    [AOA] => 96.2
    [XCD] => 2.7
    [ARS] => 5.29878
    [AMD] => 412.625
    [AWG] => 1.79
    [AUD] => 1.0503208730267
    [ATS] => 10.3807
    [AZN] => 0.78425
    [BSD] => 1
    [BHD] => 0.377
    [BDT] => 77.755
    [BBD] => 2
    [BYR] => 8715
    [BEF] => 30.4322
    [BZD] => 2.02
    [XOF] => 496.995
    [BMD] => 1
    [BTN] => 57.065
    [BOB] => 6.91
    [BAM] => 1.47525
    [BWP] => 8.5594453479415
    [BRL] => 2.14415
    [GBP] => 0.64200923209276
    [BND] => 1.2436
    [BGN] => 1.47515
    [BIF] => 1554.5
    [KHR] => 4065
    [XAF] => 496.08
    [CAD] => 1.02324
    [EUR] => 0.75424451098557
    [CVE] => 83.5
    [KYD] => 0.82000147600266
    [CLP] => 504.695
    [CNY] => 6.1332
    [COP] => 1904.58
    [KMF] => 371.086
    [CDF] => 920.05
    [NZD] => 1.2562182804884
    [CRC] => 499.91
    [HRK] => 5.67835
    [CUP] => 1
    [CYP] => 0.44145
    [CZK] => 19.284
    [DKK] => 5.6235
    [DJF] => 177.72
    [DOP] => 41.315
    [USD] => 1
    [ECS] => 25000
    [EGP] => 6.9893
    [SVC] => 8.7447
    [ERN] => 15.2513
    [EEK] => 11.8037
    [ETB] => 18.6785
    [FKP] => 0.64214527894791
    [FJD] => 1.8348623853211
    [FIM] => 4.48543
    [FRF] => 4.94851
    [XPF] => 90.0107
    [GMD] => 36.51
    [GEL] => 1.674
    [DEM] => 1.47547
    [GHS] => 2.0015
    [GIP] => 0.64214527894791
    [XAU] => 0.00070886140554457
    [GRD] => 257.06
    [GTQ] => 7.82
    [GNF] => 7022.65
    [GYD] => 210.799
    [HTG] => 43.1834
    [HNL] => 20.28
    [HKD] => 7.76225
    [HUF] => 223.043
    [ISK] => 120.45
    [INR] => 57.065
    [IDR] => 9885.5
    [IRR] => 12273.95
    [IQD] => 1162.065
    [XRI] => -99
    [IEP] => 0.59413470221969
    [ILS] => 3.6149
    [ITL] => 1460.713
    [JMD] => 99.175
    [JPY] => 95.6425
    [JEP] => 0.64214527894791
    [JOD] => 0.7082
    [KZT] => 151.435
    [KES] => 84.8025
    [KWD] => 0.2843
    [KGS] => 48.6017
    [LAK] => 7692.15
    [LVL] => 0.52939
    [LBP] => 1513
    [LSL] => 9.98588
    [LRD] => 75.015
    [LYD] => 1.278
    [CHF] => 0.92596
    [LTL] => 2.60435
    [LUF] => 30.4322
    [MOP] => 7.9945
    [MKD] => 46.602
    [MGA] => 2182.64
    [MWK] => 326
    [MYR] => 3.095
    [MVR] => 15.3499
    [MTL] => 0.32380483634904
    [MRO] => 293.375
    [MUR] => 30.95
    [MXN] => 12.865
    [MDL] => 12.45
    [MNT] => 1429
    [MAD] => 8.42495
    [MZN] => 29.7
    [MMK] => 943.66
    [NAD] => 9.98588
    [NPR] => 91.32
    [NLG] => 1.66247
    [ANG] => 1.79
    [SDG] => 4.415
    [NIO] => 24.2185
    [NGN] => 159.5
    [KPW] => -99
    [NOK] => 5.7561
    [CNH] => 6.13975
    [OMR] => 0.38505
    [PKR] => 98.475
    [XPD] => 0.0013172193499523
    [PAB] => 1
    [PGK] => 2.1413276231263
    [PYG] => 4385
    [PEN] => 2.738
    [PHP] => 42.295
    [XPT] => 0.00065412919051513
    [PLN] => 3.2478
    [PTE] => 151.243
    [QAR] => 3.6405
    [XRH] => -99
    [RON] => 3.43236
    [RUB] => 32.3355
    [XRU] => -99
    [RWF] => 650.5
    [STD] => 18478
    [SAR] => 3.7503
    [RSD] => 86.2293
    [SCR] => 11.8216
    [SLL] => 4317.5
    [XAG] => 0.044247787610619
    [SGD] => 1.24279
    [SKK] => 22.7269
    [SIT] => 180.783
    [SBD] => 7.1761750986724
    [SOS] => 1437.4
    [ZAR] => 9.986
    [KRW] => 1116.787
    [ESP] => 125.521
    [LKR] => 126.35
    [SHP] => 0.64214527894791
    [SDD] => 441.5
    [SRD] => 3.3
    [SZL] => 9.98588
    [SEK] => 6.55469
    [SYP] => 99.553
    [TWD] => 29.761
    [TJS] => 4.7558
    [TZS] => 1634
    [THB] => 30.5915
    [THO] => 30.588
    [TOP] => 1.7950098725543
    [TTD] => 6.42
    [TND] => 1.62085
    [TRY] => 1.88375
    [TRL] => 1883735.25
    [TMT] => 2.85
    [AED] => 3.67285
    [UGX] => 2593
    [UAH] => 8.1505
    [UYU] => 20.5295
    [UZS] => 2084.95
    [VUV] => 97.17
    [VEE] => 2.59675
    [VEF] => 6.2921
    [VND] => 21015.5
    [WST] => 2.3299161230196
    [YER] => 215.025
    [ZMW] => 5.365
    [ZWL] => 322.355
)
No. of Rates: 190
*/
?>
