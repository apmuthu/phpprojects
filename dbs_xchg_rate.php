<?php
/*
// Program       : Obtain Exchange Rate from DBS Bank in Singapore Dollars
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 2.1
// Release Date  : 2015-09-27
// Last Updated  : 2015-11-23
// Notes         : html code template of source page changed on 2015-09-26, 2015-11-21
                   now with TSV and cross currency rates
// Example Usage : http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?c=IDR
//                 http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?c=INR&b=USD
//                 http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?b=INR
//                 http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?r=1&b=INR
// Parameters    : c => Target Currency - defaults to INR
//                 b => Single unit of base Currency - defaults to SGD
                   r => TSV output - Currency Code \t Currency Name \t Rate \n
*/

$debug = false;
$savefile = false;

$url='https://www.posb.com.sg/personal/rates-online/foreign-currency-foreign-exchange.page';
$bcurrency = isset($_REQUEST['b']) ? substr(strtoupper(trim($_REQUEST['b'])),0,3) : 'SGD';
$currency  = isset($_REQUEST['c']) ? substr(strtoupper(trim($_REQUEST['c'])),0,3) : (($bcurrency != 'SGD') ? 'SGD' :'INR');
// TSV only if target currency is not given
$tsvlist   = (isset($_REQUEST['r']) && !isset($_REQUEST['c']) && $_REQUEST['r'] != 0) ? 1 : 0;

// Chinese Renminbi(Offshore) => Chinese Renminbi
$currencies = Array(
'SGD' => 'Singapore Dollar',

'USD' => 'US Dollar',
'EUR' => 'Euro',
'GBP' => 'Sterling Pound',
'AUD' => 'Australian Dollar',
'CAD' => 'Canadian Dollar',
'NZD' => 'New Zealand Dollar',
'DKK' => 'Danish Kroner',
'HKD' => 'Hong Kong Dollar',
'NOK' => 'Norwegian Kroner',
'SEK' => 'Swedish Kroner',
'CHF' => 'Swiss Franc',
'JPY' => 'Japanese Yen',
'THB' => 'Thai Baht',
'IDR' => 'Indonesian Rupiah',

'BND' => 'Brunei Dollar',
'ZAR' => 'South African Rand',
'CNY' => 'Chinese Renminbi',
'INR' => 'Indian Rupee',
'KRW' => 'Korean Won',
'LKR' => 'Sri Lanka Rupee',
'PHP' => 'Philippine Peso',
'SAR' => 'Saudi Rial',
'TWD' => 'New Taiwan Dollar'
);

if ($currency == $bcurrency && !$tsvlist) { echo 1; exit; }
if (!array_key_exists($currency, $currencies) || !array_key_exists($bcurrency, $currencies)) exit;


// $hundreds = Array('JPY', 'THB', 'IDR', 'CNY', 'INR', 'KRW', 'LKR', 'PHP', 'SAR', 'TWD');
$hundreds = Array('JPY', 'THB', 'IDR', 'INR', 'KRW', 'LKR', 'PHP', 'SAR', 'TWD');

$curr = (array_key_exists($currency, $currencies)) ? $currencies[$currency] : FALSE; // long form
if ($curr === FALSE) { echo 0; exit; }

if ($debug) {
$a = <<<EOT
<!DOCTYPE html><!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html class="no-js"><![endif]--><head><META http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>Foreign Currencies - Foreign Exchange | POSB Bank Singapore</title><meta charset="utf-8"><meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta name="keywords" content=""><meta name="description" content=""><meta name="vpath" content=""><meta name="page-locale-name" content=""><script type="text/javascript" src="/iwov-resources/scripts/web/jquery.min.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/cf69c6f2.modernizr.min.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/09c81293.bootstrap.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/global.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/load-desktop-or-devices.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/common_utility.js"></script><script type="text/javascript" src="/iwov-resources/js/gtm_code/sgposb_gtm.js"></script><script type="text/javascript" src="/iwov-resources/js/pweb_custom.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/url-changer.js"></script><script type="text/javascript" src="/iwov-resources/scripts/gsa/gsa-auto-complete.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/banner_cookie.js"></script><script type="text/javascript" src="//assets.adobedtm.com/71d06aac4e562e3a2278bf493855202cacdacaa2/satelliteLib-4ab03b68669b8ad64b4f3ccd8af6d95a83002f1c.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/sgrates.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/jquery.selectbox-1.0.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/orientation.js"></script><link href="/iwov-resources/fixed-layout/default-layout-with-side-modules-and-breadcrumb.css" type="text/css" rel="stylesheet"></head><body itemtype="http://schema.org/WebPage" itemscope="itemscope" class=""><div class=" main-container container"><div class=" row-fluid"><div class=" span12"><script type="text/javascript">var language= "en";var country= "sg";var segmentName= "posb";var gsaSearchCollection= "posb&Client1=dbssg";</script><div class="header row-fluid hidden-phone" id="header">
<div class="span12">
<div class="header-container">
<a class="logo" target="_self" href="/personal/default.page"><img src="/iwov-resources/images/logos/POSBlogo.png" alt="POSB Banking" title="POSB Banking"></a>
<ul class="header-menu">
<li class="divider">
<div class="dropdown highlightable">
<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)" accesskey="U">Choose Your Website<img src="/iwov-resources/images/git-arrow-down.png"></a>
<ul class="dropdown-menu" id="bu-dropdown">
<li class="list-heading">
<span class="seo-span">Personal Banking</span>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/personal/default.page" target="_self">DBS</a>
</li>
<li class="business-segment selected">
<a tabindex="8" href="http://www.posb.com.sg/personal/default.page" target="_self">POSB</a>
</li>
<li class="list-heading">
<span class="seo-span">Wealth Management</span>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/treasures/default.page" target="_self">DBS Treasures</a>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/treasures-private-client/default.page" target="_self">DBS Treasures Private Client</a>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/private-banking/default.page" target="_self">DBS Private Bank</a>
</li>
<li class="list-heading">
<span class="seo-span">DBS Vickers Securities</span>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbsvonline.com" target="_blank">DBS Vickers Online</a>
</li>
<li class="list-heading">
<span class="seo-span">Business Banking</span>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/sme/default.page" target="_self">SME Banking</a>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com.sg/corporate/default.page" target="_self">Corporate Banking</a>
</li>
<li class="list-heading">
<span class="seo-span">DBS Group</span>
</li>
<li class="business-segment">
<a tabindex="8" href="http://www.dbs.com/default.page" target="_self">About DBS</a>
</li>
</ul>
</div>
</li>
<input id="unSelectedLanguage" name="unSelectedLanguage" type="hidden" value="en">
<li class="login">
<div class="dropdown">
<a href="https://internet-banking.dbs.com.sg/posb" target="_blank">Login</a>
<div class="login-lock">
<span class="icons-lock"></span>
</div>
</div>
</li>
<li class="search">
<input id="searchurl" type="hidden" value="/personal/searchresults.page"><input id="issearchnewwindow" value="false" type="hidden">
<div class="dropdown highlightable">
<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">
<div class="icons-search"></div>
</a>
<ul class="dropdown-menu pull-right" id="search-dropdown">
<li class="search-item">
<div class="input-append" style="position: relative">
<input type="text" id="search" class="gsa-search-box" name="search" placeholder="Search">
<table id="search_suggest_0" style="width: 146px; visibility: hidden;" class="ss-gac-m"></table>
<button id="hsearchbutton" class="btn btn-info" type="button"><span class="icn-arrow-red"></span></button>
</div>
</li>
</ul>
</div>
</li>
</ul>
</div>
</div>
</div>
<div id="header-mobile" class="row-fluid visible-phone">
<div class="span12">
<div class="main-navigation-phone">
<div class="visible-phone nav-bar-mobile clearfix">
<a href="#" data-target="main-navigation-container-phone" class="pull-left icn-mobile-nav-menu mobile-trigger"></a><a class="logo pull-left" href="/personal/default.page"></a><a href="#" data-target="mobile-search" class="pull-right icn-flag  mobile-trigger-searchbox"></a><a id="mobile-login-dropdown-section" href="#" data-target="login-dropdown-mobile" class="pull-right icn-mobile-nav-menu mobile-trigger"></a><a href="#" id="mobile-lang-country-section" data-target="language-country-dropdown" class="pull-right icn-mobile-nav-menu mobile-trigger"></a><a id="mobile-segment-dropdown-section" href="#" data-target="segment-dropdown" class="pull-right icn-mobile-nav-menu mobile-trigger"></a>
</div>
<div class="mobile-dropdown" id="main-navigation-container-phone">
<ul class="clearfix">
<a href="/personal/default.page" target="_self">
<li class="active">Home<div class="scope-note">POSB Banking</div>
</li>
</a><a href="/personal/deposits/default.page" target="_self">
<li class="">Bank<div class="scope-note">Day to Day</div>
</li>
</a><a href="/personal/cards/default.page" target="_self">
<li class="">Cards<div class="scope-note">Rewards & Offers</div>
</li>
</a><a href="/personal/investments/default.page" target="_self">
<li class="">Invest<div class="scope-note">Your Wealth</div>
</li>
</a><a href="/personal/loans/default.page" target="_self">
<li class="">Borrow<div class="scope-note">For Home & more</div>
</li>
</a><a href="/personal/insurance/default.page" target="_self">
<li class="">Protect<div class="scope-note">You & Your Family</div>
</li>
</a><a href="/personal/retirement/default.page" target="_self">
<li class="">Retirement<div class="scope-note">Plan Ahead</div>
</li>
</a>
</ul>
</div>
<div id="segment-dropdown" class="mobile-dropdown">
<ul class="clearfix">
<li class="list-heading">
<span class="seo-span-msegmentheading">Choose Your Website</span>
</li>
<li class="list-heading">
<span class="seo-span">Personal Banking</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/personal/default.page">DBS</a>
</li>
<li class="divider selected">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.posb.com.sg/personal/default.page">POSB</a>
</li>
<li class="list-heading">
<span class="seo-span">Wealth Management</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/treasures/default.page">DBS Treasures</a>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/treasures-private-client/default.page">DBS Treasures Private Client</a>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/private-banking/default.page">DBS Private Bank</a>
</li>
<li class="list-heading">
<span class="seo-span">DBS Vickers Securities</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbsvonline.com">DBS Vickers Online</a>
</li>
<li class="list-heading">
<span class="seo-span">Business Banking</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/sme/default.page">SME Banking</a>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com.sg/corporate/default.page">Corporate Banking</a>
</li>
<li class="list-heading">
<span class="seo-span">DBS Group</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="http://www.dbs.com/default.page">About DBS</a>
</li>
</ul>
</div>
<div id="login-dropdown-mobile" class="mobile-dropdown">
<ul class="clearfix">
<li class="mobile-login">
<a href="javascript:void(0)">Login<div class="icons-lock"></div>
</a>
</li>
<li class="divider">
<a href="https://internet-banking.dbs.com.sg/posb" target="_blank">POSB iBanking</a>
</li>
</ul>
</div>
<div id="language-country-dropdown" class="mobile-dropdown">
<ul class="clearfix">
<li class="list-heading">
<span class="seo-span">sg</span>
</li>
<input id="unSelectedLanguage" name="unSelectedLanguage" type="hidden" value="en">
</ul>
</div>
<div id="mobile-search" class="mobile-dropdown-searchbox">
<ul class="clearfix">
<li class="search-item">
<div style="position: relative;" class="input-append">
<button id="hsearchbuttonmobile" class="btn btn-info" type="button"><span class="icn-search"></span></button><input type="text" name="searchmobile" class="gsad-search-box" id="searchmobile" placeholder="Search">
<table id="search_suggest_1" style="width: 146px; visibility: hidden;" class="ss-gac-m"></table>
</div>
</li>
</ul>
</div>
</div>
</div>
</div>
</div></div><div class=" row-fluid"><div class=" navigation-area span12"><div class="navigation-area span12">
<div class="main-navigation " tooltip="true" data-tooltiptimer="10" data-tooltipdescription="Have a look here" data-tooltiptitle="Results saved to Your DBS">
<div class="main-navigation-container">
<ul class="clearfix">
<li style="width:14.285714285714286%" class="active">
<a href="/personal/default.page" target="_self">Home<div class="scope-note">POSB Banking</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/deposits/default.page" target="_self">Bank<div class="scope-note">Day to Day</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/cards/default.page" target="_self">Cards<div class="scope-note">Rewards & Offers</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/investments/default.page" target="_self">Invest<div class="scope-note">Your Wealth</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/loans/default.page" target="_self">Borrow<div class="scope-note">For Home & more</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/insurance/default.page" target="_self">Protect<div class="scope-note">You & Your Family</div>
</a>
</li>
<li style="width:14.285714285714286%">
<a href="/personal/retirement/default.page" target="_self">Retirement<div class="scope-note">Plan Ahead</div>
</a>
</li>
</ul>
</div>
</div>
</div>
</div></div><div class=" row-fluid"><div class=" breadcrumb-area span12"><div itemprop="breadcrumb" class="row-fluid dbs-breadcrumb">
<div class="span12">
<ul class="breadcrumb">
<li>
<a href="/personal/default.page">Home</a><span class="divider">&gt;</span>
</li>
<li>
<a href="/personal/rates-online/default.page">Rates Online</a><span class="divider">&gt;</span>
</li>
<li class="active">Foreign Exchange</li>
</ul>
</div>
</div>
</div></div><div class=" row-fluid page-module"><div class=" span8"><h1 class="paddingBottom margin-change">Foreign Currencies - Foreign Exchange</h1><div class="row-fluid">
<div class="span12">
<div class="visible-mobile RatesSelect">
<div class="span7  marginBot20">
<label><strong>Select Currency</strong></label>
<div class="customDropdown customDropdownLarge">
<select data-filtergroup="currency" class="span12 filter exchangeFilter" tabindex="1" id="selectCurrency" name="selectCurrency"><option selected value="">View All Currencies</option><option value="US Dollar">US Dollar</option><option value="Euro">Euro</option><option value="Sterling Pound">Sterling Pound</option><option value="Australian Dollar">Australian Dollar</option><option value="Canadian Dollar">Canadian Dollar</option><option value="New Zealand Dollar">New Zealand Dollar</option><option value="Danish Kroner">Danish Kroner</option><option value="Hong Kong Dollar">Hong Kong Dollar</option><option value="Norwegian Kroner">Norwegian Kroner</option><option value="Swedish Kroner">Swedish Kroner</option><option value="Swiss Franc">Swiss Franc</option><option value="Chinese Renminbi(Offshore)">Chinese Renminbi(Offshore)</option><option value="Japanese Yen">Japanese Yen</option><option value="Thai Baht">Thai Baht</option><option value="Indonesian Rupiah">Indonesian Rupiah</option><option value="Brunei Dollar" data-filterHld="otherCurrency">Brunei Dollar</option><option value="South African Rand" data-filterHld="otherCurrency">South African Rand</option><option value="Chinese Renminbi" data-filterHld="otherCurrency">Chinese Renminbi</option><option value="Indian Rupee" data-filterHld="otherCurrency">Indian Rupee</option><option value="Korean Won" data-filterHld="otherCurrency">Korean Won</option><option value="Sri Lanka Rupee" data-filterHld="otherCurrency">Sri Lanka Rupee</option><option value="Philippine Peso" data-filterHld="otherCurrency">Philippine Peso</option><option value="New Taiwan Dollar" data-filterHld="otherCurrency">New Taiwan Dollar</option><option value="Saudi Rial" data-filterHld="otherCurrency">Saudi Rial</option></select>
</div>
</div>
</div>
<div class="rates-table">
<div class="filterHld">
<p class="padding0 subtle">
               Effective Date:
              
               21/11/2015
                    &nbsp;
               
               Last Updated:
                
                5:19pm</p>
<table class="table table-eight-colm forex-rates margin-table">
<thead class="mobile-hidden">
<tr>
<th>
                              &nbsp;
                           </th><th>
                              &nbsp;
                           </th><th class="align-right" colspan="3">
<h3>For amounts less than S$50,000</h3>
</th><th class="align-right" colspan="3">
<h3>For amounts S$50,000 to S$200,000</h3>
</th>
</tr>
<tr class="desktop-no-border-red subheader">
<th class="column-1 first no-before mobile-header">
<h3>Currency</h3>
</th><th class="column-2 mobile-no-border-red">
<h3>Unit</h3>
</th><th class="column-3">
<h3 class="align-right">Selling TT/OD</h3>
</th><th class="column-4">
<h3 class="align-right">Buying TT</h3>
</th><th class="column-5">
<h3 class="align-right">Buying OD</h3>
</th><th class="column-6">
<h3 class="align-right">Selling TT/OD</h3>
</th><th class="column-7">
<h3 class="align-right">Buying TT</h3>
</th><th class="column-8 last-coulmn last">
<h3 class="align-right">Buying OD</h3>
</th>
</tr>
</thead>
<tbody>
<tr class="even filter_currency filter_US_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_us.gif">US Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.4222</td><td class="column-4 odd" data-label="Buying TT">1.4043</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.3983</th><td class="column-6" data-label="Selling TT/OD">1.4212</td><td class="column-7 odd" data-label="Buying TT">1.4053</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.3996</td>
</tr>
<tr class="odd filter_currency filter_Euro">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_eu.gif">Euro</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.5222</td><td class="column-4 odd" data-label="Buying TT">1.4883</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.4833</th><td class="column-6" data-label="Selling TT/OD">1.5216</td><td class="column-7 odd" data-label="Buying TT">1.4889</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.4841</td>
</tr>
<tr class="even filter_currency filter_Sterling_Pound">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_brit.gif">Sterling Pound</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">2.1661</td><td class="column-4 odd" data-label="Buying TT">2.1283</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">2.1173</th><td class="column-6" data-label="Selling TT/OD">2.1641</td><td class="column-7 odd" data-label="Buying TT">2.1303</td><td class="column-8 last-coulmn last" data-label="Buying OD">2.0598</td>
</tr>
<tr class="odd filter_currency filter_Australian_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_au.gif">Australian Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0343</td><td class="column-4 odd" data-label="Buying TT">1.0117</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.0057</th><td class="column-6" data-label="Selling TT/OD">1.0335</td><td class="column-7 odd" data-label="Buying TT">1.0125</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.0074</td>
</tr>
<tr class="even filter_currency filter_Canadian_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_ca.gif">Canadian Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0692</td><td class="column-4 odd" data-label="Buying TT">1.0479</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.0419</th><td class="column-6" data-label="Selling TT/OD">1.0680</td><td class="column-7 odd" data-label="Buying TT">1.0491</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.0440</td>
</tr>
<tr class="odd filter_currency filter_New_Zealand_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_nz.gif">New Zealand Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.9393</td><td class="column-4 odd" data-label="Buying TT">0.9165</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.9095</th><td class="column-6" data-label="Selling TT/OD">0.9381</td><td class="column-7 odd" data-label="Buying TT">0.9177</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.9126</td>
</tr>
<tr class="even filter_currency filter_Danish_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_denmark.gif">Danish Kroner</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.2043</td><td class="column-4 odd" data-label="Buying TT">0.1990</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1960</th><td class="column-6" data-label="Selling TT/OD">0.2038</td><td class="column-7 odd" data-label="Buying TT">0.1995</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1969</td>
</tr>
<tr class="odd filter_currency filter_Hong_Kong_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_hk.gif">Hong Kong Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1844</td><td class="column-4 odd" data-label="Buying TT">0.1803</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1788</th><td class="column-6" data-label="Selling TT/OD">0.1841</td><td class="column-7 odd" data-label="Buying TT">0.1806</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1793</td>
</tr>
<tr class="even filter_currency filter_Norwegian_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_norway.gif">Norwegian Kroner</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1657</td><td class="column-4 odd" data-label="Buying TT">0.1616</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1586</th><td class="column-6" data-label="Selling TT/OD">0.1653</td><td class="column-7 odd" data-label="Buying TT">0.1620</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1594</td>
</tr>
<tr class="odd filter_currency filter_Swedish_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_sweden.gif">Swedish Kroner</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1646</td><td class="column-4 odd" data-label="Buying TT">0.1597</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1567</th><td class="column-6" data-label="Selling TT/OD">0.1639</td><td class="column-7 odd" data-label="Buying TT">0.1604</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1578</td>
</tr>
<tr class="even filter_currency filter_Swiss_Franc">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_switzerland.gif">Swiss Franc</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.4023</td><td class="column-4 odd" data-label="Buying TT">1.3739</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.3699</th><td class="column-6" data-label="Selling TT/OD">1.4010</td><td class="column-7 odd" data-label="Buying TT">1.3752</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.3714</td>
</tr>
<tr class="odd filter_currency filter_Chinese_Renminbi_Offshore_">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_cn.gif">Chinese Renminbi(Offshore)</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.2226</td><td class="column-4 odd" data-label="Buying TT">0.2174</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.0000</th><td class="column-6" data-label="Selling TT/OD">0.2221</td><td class="column-7 odd" data-label="Buying TT">0.2179</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Japanese_Yen">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_jp.gif">Japanese Yen</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">1.1606</td><td class="column-4 odd" data-label="Buying TT">1.1402</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.1372</th><td class="column-6" data-label="Selling TT/OD">1.1594</td><td class="column-7 odd" data-label="Buying TT">1.1414</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.1388</td>
</tr>
<tr class="odd filter_currency filter_Thai_Baht">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_th.gif">Thai Baht</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">4.0024</td><td class="column-4 odd" data-label="Buying TT">3.8937</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">3.8137</th><td class="column-6" data-label="Selling TT/OD">3.9974</td><td class="column-7 odd" data-label="Buying TT">3.8987</td><td class="column-8 last-coulmn last" data-label="Buying OD">3.8307</td>
</tr>
<tr class="even filter_currency filter_Indonesian_Rupiah">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_id.gif">Indonesian Rupiah</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">0.0106</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.0000</th><td class="column-6" data-label="Selling TT/OD">0.0000</td><td class="column-7 odd" data-label="Buying TT">0.0000</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.0000</td>
</tr>
</tbody>
</table>
<div class="notes">
<b class="disclaimerHeading">Notes:</b>
<ul class="disclaimer paddRight">
<li>Telegraphic Transfer ("TT") rates and On Demand ("OD") are rates available involving foreign exchange.</li>
<li>The TT rate is applicable to funds that has already been cleared with the Bank while the OD rate is applied otherwise.</li>
<li>The buying rate is used when foreign currency is sold to the Bank and the selling rate is used when foreign currency is bought from the Bank.</li>
</ul>
</div>
</div>
</div>
<div class="filterHld otherCurrency rates-table">
<div class="fxtitle">
<h2>Other Currency Types</h2>
<p class="padding0 subtle span12">
                  Effective Date:
                 

                  21/11/2015
                   
                  Last Updated:
                  
                   5:19pm</p>
</div>
<table class="table table-eight-colm forex-rates">
<thead class="mobile-hidden">
<tr class="">
<th>
                           &nbsp;
                        </th><th>
                           &nbsp;
                        </th><th class="align-right" colspan="4">
<h3>For amounts less than S$200,000</h3>
</th>
</tr>
<tr class="desktop-no-border-red subheader">
<th class="column-1 first no-before mobile-header">
<h3>Currency</h3>
</th><th class="column-2 mobile-no-border-red">
<h3>Unit</h3>
</th><th class="column-3">
<h3 class="align-right">Selling TT/OD</h3>
</th><th class="column-4 ">
<h3 class="align-right">Buying TT</h3>
</th><th class="column-5 last last-coulmn">
<h3 class="align-right">Buying OD</h3>
</th>
</tr>
</thead>
<tbody>
<tr class="even filter_currency filter_Brunei_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_brunei.gif">Brunei Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0000</td><td class="column-4 odd" data-label="Buying TT">1.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.9950</td>
</tr>
<tr class="odd filter_currency filter_South_African_Rand">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_southafrica.gif">South African Rand</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1027</td><td class="column-4 odd" data-label="Buying TT">0.0996</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Chinese_Renminbi">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_cn.gif">Chinese Renminbi</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">1</th><td class="column-3" data-label="Selling TT/OD">0.0000</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_Indian_Rupee">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_in.gif">Indian Rupee</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">2.1595</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Korean_Won">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_kr.gif">Korean Won</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">0.1240</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_Sri_Lanka_Rupee">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_srilanka.gif">Sri Lanka Rupee</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">1.0105</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Philippine_Peso">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_ph.gif">Philippine Peso</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">3.0357</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_New_Taiwan_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_tw.gif">New Taiwan Dollar</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">4.3861</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Saudi_Rial">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/flag_saudi.gif">Saudi Rial</th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">38.0296</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
</tbody>
</table>
<div class="notes">
<b class="disclaimerHeading boldFont">Notes:</b>
<ul class="disclaimer marginBot">
<li>Rates quoted are subject to change without prior notice.</li>
<li>Rates information is also available toll free on 1800-111 1111.</li>
</ul>
</div>
</div>
</div>
</div>
</div><div class=" span4"><div data-interval="0000" class="GIT-container hidden-phone staticGIT">
<div class="col4-module get-in-touch">
<div class="git-inner-container row">
<ul class="unstyled">
<li class="clearfix first">
<p class="span8">
<a target="_self" href="https://internet-banking.dbs.com.sg/posb">Login to iBanking</a>
</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-login.png"></span>
</li>
<li class="clearfix">
<p class="span8">
<a target="_self" href="/personal/contact-us.page">Contact Us</a>
</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-contactus.png"></span>
</li>
<li class="clearfix">
<p class="span8">
<a target="_blank" href="/personal/locator.page">Branches and ATMs</a>
</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-locateus.png"></span>
</li>
<li class="clearfix">
<p class="span8">
<a target="_self" href="/personal/rates-online/foreign-currency-foreign-exchange.page">Foreign Exchange Rates</a>
</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-rates.png"></span>
</li>
<li class="clearfix">
<div class="span8">
<a class="btn btn-small btn-icon" href="https://www.facebook.com/POSB" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-facebook.png"></a><a class="btn btn-small btn-icon" href="https://twitter.com/posb" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-twitter.png"></a><a class="btn btn-small btn-icon" href="https://www.youtube.com/user/POSBSingapore" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-youtube.png"></a>
</div>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-social.png"></span>
</li>
</ul>
</div>
</div>
</div><div class="GIT-container-phone visible-phone" data-interval="0000">
<div class="col4-module get-in-touch-git-container">
<div class="git-inner-container row">
<ul class="unstyled">
<li class="clearfix first">
<a href="https://internet-banking.dbs.com.sg/posb" target="_self">
<p class="span8">Login to iBanking</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-login.png"></span></a>
</li>
<li class="clearfix">
<a href="/personal/contact-us.page" target="_self">
<p class="span8">Contact Us</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-contactus.png"></span></a>
</li>
<li class="clearfix">
<a href="/personal/locator.page" target="_blank">
<p class="span8">Branches and ATMs</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-locateus.png"></span></a>
</li>
<li class="clearfix">
<a href="/personal/rates-online/foreign-currency-foreign-exchange.page" target="_self">
<p class="span8">Foreign Exchange Rates</p>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-rates.png"></span></a>
</li>
<li class="clearfix">
<div class="span8">
<a class="btn btn-small btn-icon" href="https://www.facebook.com/POSB" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-facebook.png"></a><a class="btn btn-small btn-icon" href="https://twitter.com/posb" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-twitter.png"></a><a class="btn btn-small btn-icon" href="https://www.youtube.com/user/POSBSingapore" target="_blank"><img src="/iwov-resources/images/get-in-touch-social-media/social-icons-youtube.png"></a>
</div>
<span class="pull-right"><img src="/iwov-resources/images/get-in-touch-social-media/git-social.png"></span>
</li>
</ul>
</div>
</div>
</div>
</div></div><div class=" row-fluid"><div class=" footer-span12 span12"><form id="footervarform" action="/personal/rates-online/foreign-currency-foreign-exchange.page?submit=true&componentID=1411057701894" method="post">
<input id="country" type="hidden" value="sg"><input id="googleFooterLang" type="hidden" value="en"><input id="selectedCountry" type="hidden" value="sg"><input id="googleLanguage" type="hidden" value="en">
</form><script src="/iwov-resources/scripts/web/footer-on-demand.js" type="text/javascript"></script><div class="page-module footer">
<div class="row-fluid">
<div class="span3 clearfix">
<div>Useful Links</div>
<ul class="square">
<li>
<a class="title" target="_self" href="/personal/deposits/terms-conditions-electronic-services.page">Terms and Conditions Governing Electronic Services</a>
</li>
<li>
<a class="title" target="_self" href="/personal/rates-online/default.page">Rates</a>
</li>
<li>
<a class="title" target="_self" href="/personal/deposits/update-address.page">Update of Address</a>
</li>
<li>
<a class="title" target="_blank" href="http://www.dbs.com.sg/personal/deposits/maintenance-schedule.page">Notices and Maintenance</a>
</li>
</ul>
<div class="back-to-top">
<div class="icn-back-to-top"></div>
<div class="label-back-to-top">Back to Top</div>
</div>
</div>
<div class="span3 ">
<div>Others</div>
<ul class="square">
<li>
<a class="title" target="_self" href="/personal/forms/default.page">Forms</a>
</li>
<li>
<a class="title" target="_self" href="/personal/calculators/default.page">Tools</a>
</li>
<li>
<a class="title" target="_blank" href="http://www.dbs.com.sg/personal/deposits/security-and-you/default.page">Security & you</a>
</li>
</ul>
</div>
<div id="footer-rightSection" class="span3">
<div>
</div>
<ul class="square"></ul>
</div>
<div id="manageYourProfile" class="span3"></div>
<div class="offset3 span3 block-4">
<div><p><strong>Talk to a POSB Expert</strong></p>
<h3><a style="color: #ffffff; font-size: 18px;" href="tel:18003396666">1800 339 6666</a></h3>
<p>Or have someone <a href="/personal/contact-us.page"><strong>contact you</strong></a></p></div>
<br>
<div>Find a branch near you</div>
<div class="input-append">
<input id="geocodeInputFooter" type="text" placeholder="Enter location"><button target="_blank" id="goBranchfinder" class="btn btn-info" type="button" href="/personal/locator.page"><span class="icn-map-marker"></span></button></input>
</div>
</br>
</div>
</div>
</div>
<div class="page-module transparent global-footer">
<div class="row-fluid">
<div id="footer-content" class="span12 clearfix">
<div class="left-section">
<ul>
<li>
<a href="http://www.dbs.com/terms/default.page" target="_self">Terms & Conditions</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com/privacy/default.page" target="_self">Privacy Policy</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com/fairdealing/default.page" target="_self">Fair Dealing Commitment</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com.sg/personal/compliance-tax-requirements/index.html" target="_self">Compliance with Tax Requirements</a><span>|</span>
</li>
<li>©2013 DBS Bank Ltd<span>|</span>
</li>
<li>Co. Reg. No. 196800306E</li>
</ul>
</div>
<div class="right-section">
<ul>
<li>
<a class="icn-facebook" href="https://www.facebook.com/POSB" target="_blank"></a>
</li>
<li>
<a class="icn-twitter" href="https://twitter.com/posb" target="_blank"></a>
</li>
<li>
<a class="icn-youtube" href="https://www.youtube.com/user/POSBSingapore" target="_blank"></a>
</li>
</ul>
<div class="title">Social Media</div>
</div>
<script language="JavaScript">
<!--
/* You may give each page an identifying name, server, and channel on
the next lines. */

//Added for DTM Tracking – Start
var s = {};
//Added for DTM Tracking – End

s.pageName=""
s.server=""
s.channel=""
s.pageType=""
s.prop1=""
s.prop2=""
s.prop3=""
s.prop4=""
s.prop5=""
/* Conversion Variables */
s.campaign=""
s.state=""
s.zip=""
s.events=""
s.products=""
s.purchaseID=""
s.eVar1=""
s.eVar2=""
s.eVar3=""
s.eVar4=""
s.eVar5=""
/* Hierarchy Variables */
s.hier1=""
/************* DO NOT ALTER ANYTHING BELOW THIS LINE ! **************/
-->
</script>
<script language="JavaScript">
<!--
if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'\!-'+'-')
//-->
</script>


<noscript> <a href="http://www.omniture.com" title="Web Analytics"><img src="http://dbs.112.2o7.net/b/ss/dbswebsitedev/1/H.13--NS/0" height="1" width="1" border="0" alt="" /></a> </noscript>


<script type="text/javascript">_satellite.pageBottom();</script>

</div>
</div>
</div>
<div></div>
</div></div></div></body><!--</html>-->
EOT;

} else {

	$a = file_get_contents($url);

	if ($savefile) {
		$handle = fopen('page.txt', 'a');
		fwrite($handle, $a);
		fclose($handle);
	}
}

$a = str_replace('Chinese Renminbi(Offshore)','Chinese Renminbi',$a);

$b = explode('filter_currency filter_', $a);
array_shift($b);
$rates['SGD'] = Array('Currency' => 'Singapore Dollar', 'Rate' => 1);
foreach ($b as $key => $val) {
	$c = explode('.gif">', $val);
	$c = explode('</th>', $c[1]);
	$c = $c[0]; // Currency
	$d = explode('data-label="Selling TT/OD">', $val);
	$d = explode('</th>', $d[1]); // Rate
	$d = explode('</td>', $d[0]); // Rate
	$e = array_search($c, $currencies); // CurrCode
	if (!isset($rates[$e])) {
		$rate = $d[0];
		if (in_array($e, $hundreds)) $rate /= 100;
		$rates[$e] = Array('Currency' => $c, 'Rate' => $rate);
	}
}

// echo print_r($rates,true);
// exit;

if ($tsvlist) {
	$tsv = '';
	foreach ($rates as $key => $val) {
		$rate = $rates[$key]['Rate'];
		if ($bcurrency != 'SGD') $rate /= $rates[$bcurrency]['Rate'];
// Ref: http://stackoverflow.com/questions/10916675/display-float-value-w-o-scientific-notation
		$tsv .= $key . "\t" . $currencies[$key] . "\t" . rtrim(sprintf('%.10F', $rate), '0') . "\n";
	}
	echo $tsv;
} else {
	$rate = $rates[$currency]['Rate'];
	if ($bcurrency != 'SGD') $rate /= $rates[$bcurrency]['Rate'];
	echo $rate;
}

?>
