<?php
/*
// Program       : Obtain Exchange Rate from DBS Bank in Singapore Dollars
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.1
// Release Date  : 2015-09-27
// Notes         : html code template of source page changed on 2015-09-26
// Example Usage : http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?c=IDR
*/

$debug = false;
$savefile = false;

$url='https://www.posb.com.sg/personal/rates-online/foreign-currency-foreign-exchange.page';
$currency = isset($_REQUEST['c']) ? trim(strtoupper($_REQUEST['c'])) : 'INR';
if ($currency == 'SGD') { echo 1; exit; }

// Chinese Renminbi(Offshore) => Chinese Renminbi
$currencies = Array(
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
<select data-filtergroup="currency" class="span12 filter exchangeFilter" tabindex="1" id="selectCurrency" name="selectCurrency"><option selected value="">View All Currencies</option><option value="US Dollar">US Dollar</option><option value="Euro">Euro</option><option value="Sterling Pound">Sterling Pound</option><option value="Australian Dollar">Australian Dollar</option><option value="Canadian Dollar">Canadian Dollar</option><option value="New Zealand Dollar">New Zealand Dollar</option><option value="Danish Kroner">Danish Kroner</option><option value="Hong Kong Dollar">Hong Kong Dollar</option><option value="Norwegian Kroner">Norwegian Kroner</option><option value="Swedish Kroner">Swedish Kroner</option><option value="Swiss Franc">Swiss Franc</option><option value="Chinese Renminbi(Offshore)">Chinese Renminbi(Offshore)</option><option value="Japanese Yen">Japanese Yen</option><option value="Thai Baht">Thai Baht</option><option value="Indonesian Rupiah">Indonesian Rupiah</option><option value="Brunei Dollar" data-filterHld="otherCurrency">Brunei Dollar</option><option value="South African Rand" data-filterHld="otherCurrency">South African Rand</option><option value="Chinese Renminbi" data-filterHld="otherCurrency">Chinese Renminbi</option><option value="Indian Rupee" data-filterHld="otherCurrency">Indian Rupee</option><option value="Korean Won" data-filterHld="otherCurrency">Korean Won</option><option value="Sri Lanka Rupee" data-filterHld="otherCurrency">Sri Lanka Rupee</option><option value="Philippine Peso" data-filterHld="otherCurrency">Philippine Peso</option><option value="Saudi Rial" data-filterHld="otherCurrency">Saudi Rial</option><option value="New Taiwan Dollar" data-filterHld="otherCurrency">New Taiwan Dollar</option></select>
</div>
</div>
</div>
<div class="rates-table">
<div class="filterHld">
<p class="padding0 subtle">
               Effective Date:
              
               26/09/2015
                    &nbsp;
               
               Last Updated:
                
                11:48am</p>
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
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/usdollar_flg.gif" class="country_flag"><span>US Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.4353</td><td class="column-4 odd" data-label="Buying TT">1.4174</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.4114</th><td class="column-6" data-label="Selling TT/OD">1.4343</td><td class="column-7 odd" data-label="Buying TT">1.4184</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.4127</td>
</tr>
<tr class="odd filter_currency filter_Euro">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/euro_flg.gif" class="country_flag"><span>Euro</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.6162</td><td class="column-4 odd" data-label="Buying TT">1.5815</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.5765</th><td class="column-6" data-label="Selling TT/OD">1.6156</td><td class="column-7 odd" data-label="Buying TT">1.5821</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.5773</td>
</tr>
<tr class="even filter_currency filter_Sterling_Pound">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/sterlingpound_flg.gif" class="country_flag"><span>Sterling Pound</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">2.1867</td><td class="column-4 odd" data-label="Buying TT">2.1484</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">2.1374</th><td class="column-6" data-label="Selling TT/OD">2.1847</td><td class="column-7 odd" data-label="Buying TT">2.1504</td><td class="column-8 last-coulmn last" data-label="Buying OD">2.0799</td>
</tr>
<tr class="odd filter_currency filter_Australian_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/australiandollar_flg.gif" class="country_flag"><span>Australian Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0138</td><td class="column-4 odd" data-label="Buying TT">0.9909</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.9849</th><td class="column-6" data-label="Selling TT/OD">1.0130</td><td class="column-7 odd" data-label="Buying TT">0.9917</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.9866</td>
</tr>
<tr class="even filter_currency filter_Canadian_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/canadiandollar_flg.gif" class="country_flag"><span>Canadian Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0812</td><td class="column-4 odd" data-label="Buying TT">1.0596</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.0536</th><td class="column-6" data-label="Selling TT/OD">1.0800</td><td class="column-7 odd" data-label="Buying TT">1.0608</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.0557</td>
</tr>
<tr class="odd filter_currency filter_New_Zealand_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/newzealanddollar_flg.gif" class="country_flag"><span>New Zealand Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.9220</td><td class="column-4 odd" data-label="Buying TT">0.8990</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.8920</th><td class="column-6" data-label="Selling TT/OD">0.9208</td><td class="column-7 odd" data-label="Buying TT">0.9002</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.8951</td>
</tr>
<tr class="even filter_currency filter_Danish_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/danishkroner_flg.gif" class="country_flag"><span>Danish Kroner</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.2170</td><td class="column-4 odd" data-label="Buying TT">0.2115</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.2085</th><td class="column-6" data-label="Selling TT/OD">0.2165</td><td class="column-7 odd" data-label="Buying TT">0.2120</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.2094</td>
</tr>
<tr class="odd filter_currency filter_Hong_Kong_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/hongkongdollar_flg.gif" class="country_flag"><span>Hong Kong Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1861</td><td class="column-4 odd" data-label="Buying TT">0.1820</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1805</th><td class="column-6" data-label="Selling TT/OD">0.1858</td><td class="column-7 odd" data-label="Buying TT">0.1823</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1810</td>
</tr>
<tr class="even filter_currency filter_Norwegian_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/norwegiankroner_flg.gif" class="country_flag"><span>Norwegian Kroner</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1696</td><td class="column-4 odd" data-label="Buying TT">0.1654</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1624</th><td class="column-6" data-label="Selling TT/OD">0.1692</td><td class="column-7 odd" data-label="Buying TT">0.1658</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1632</td>
</tr>
<tr class="odd filter_currency filter_Swedish_Kroner">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/swedishkroner_flg.gif" class="country_flag"><span>Swedish Kroner</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1723</td><td class="column-4 odd" data-label="Buying TT">0.1672</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.1642</th><td class="column-6" data-label="Selling TT/OD">0.1716</td><td class="column-7 odd" data-label="Buying TT">0.1679</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.1653</td>
</tr>
<tr class="even filter_currency filter_Swiss_Franc">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/swissfranc_flg.gif" class="country_flag"><span>Swiss Franc</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">1.4732</td><td class="column-4 odd" data-label="Buying TT">1.4430</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.4390</th><td class="column-6" data-label="Selling TT/OD">1.4719</td><td class="column-7 odd" data-label="Buying TT">1.4443</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.4405</td>
</tr>
<tr class="odd filter_currency filter_Chinese_Renminbi_Offshore_">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/chineserenminbi(offshore)_flg.gif" class="country_flag"><span>Chinese Renminbi(Offshore)</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">1</th><td class="column-3" data-label="Selling TT/OD">0.2253</td><td class="column-4 odd" data-label="Buying TT">0.2206</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.0000</th><td class="column-6" data-label="Selling TT/OD">0.2248</td><td class="column-7 odd" data-label="Buying TT">0.2211</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Japanese_Yen">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/japaneseyen_flg.gif" class="country_flag"><span>Japanese Yen</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">1.1944</td><td class="column-4 odd" data-label="Buying TT">1.1733</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">1.1703</th><td class="column-6" data-label="Selling TT/OD">1.1932</td><td class="column-7 odd" data-label="Buying TT">1.1745</td><td class="column-8 last-coulmn last" data-label="Buying OD">1.1719</td>
</tr>
<tr class="odd filter_currency filter_Thai_Baht">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/thaibaht_flg.gif" class="country_flag"><span>Thai Baht</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">3.9812</td><td class="column-4 odd" data-label="Buying TT">3.8734</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">3.7934</th><td class="column-6" data-label="Selling TT/OD">3.9762</td><td class="column-7 odd" data-label="Buying TT">3.8784</td><td class="column-8 last-coulmn last" data-label="Buying OD">3.8104</td>
</tr>
<tr class="even filter_currency filter_Indonesian_Rupiah">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/indonesianrupiah_flg.gif" class="country_flag"><span>Indonesian Rupiah</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts less than S$50,000">100</th><td class="column-3" data-label="Selling TT/OD">0.0099</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><th class="column-5 mobile-no-border-red" data-label="Buying OD" data-group-label="For amounts S$50,000 to S$200,000">0.0000</th><td class="column-6" data-label="Selling TT/OD">0.0000</td><td class="column-7 odd" data-label="Buying TT">0.0000</td><td class="column-8 last-coulmn last" data-label="Buying OD">0.0000</td>
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
                 

                  26/09/2015
                   
                  Last Updated:
                  
                   11:48am</p>
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
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/bruneidollar_flg.gif" class="country_flag"><span>Brunei Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">1</th><td class="column-3" data-label="Selling TT/OD">1.0000</td><td class="column-4 odd" data-label="Buying TT">1.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.9950</td>
</tr>
<tr class="odd filter_currency filter_South_African_Rand">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/southafricanrand_flg.gif" class="country_flag"><span>South African Rand</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">1</th><td class="column-3" data-label="Selling TT/OD">0.1040</td><td class="column-4 odd" data-label="Buying TT">0.1009</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Chinese_Renminbi">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/chineserenminbi_flg.gif" class="country_flag"><span>Chinese Renminbi</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">0.0000</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_Indian_Rupee">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/indianrupee_flg.gif" class="country_flag"><span>Indian Rupee</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">2.1758</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Korean_Won">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/koreanwon_flg.gif" class="country_flag"><span>Korean Won</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">0.1212</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_Sri_Lanka_Rupee">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/srilankarupee_flg.gif" class="country_flag"><span>Sri Lanka Rupee</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">1.0284</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_Philippine_Peso">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/philippinepeso_flg.gif" class="country_flag"><span>Philippine Peso</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">3.0775</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="odd filter_currency filter_Saudi_Rial">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/saudirial_flg.gif" class="country_flag"><span>Saudi Rial</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">38.3799</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
</tr>
<tr class="even filter_currency filter_New_Taiwan_Dollar">
<th class="column-1 first no-before mobile-header"><img src="/iwov-resources/images/rates/newtaiwandollar_flg.gif" class="country_flag"><span>New Taiwan Dollar</span></th><th class="column-2 mobile-no-border-red" data-label="Unit" data-group-label="For amounts up to S$200,000">100</th><td class="column-3" data-label="Selling TT/OD">4.3706</td><td class="column-4 odd" data-label="Buying TT">0.0000</td><td class="column-5 last last-coulmn" data-label="Buying OD">0.0000</td>
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
</div></div><div class=" row-fluid"><div class=" footer-span12 span12"><form id="footervarform" action="/personal/common-disclaimer.page?submit=true&componentID=1411064652854" method="post">
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
<h3>1800 339 6666</h3>
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

// $b = explode('<tbody>', $a);
//$b = explode('</tbody>', $b[2]);
$b = explode('filter_currency filter_', $a);
array_shift($b);
$rates = Array();
foreach ($b as $key => $val) {
	$c = explode('<span>', $val);
	$c = explode('</span>', $c[1]);
	$c = $c[0]; // Currency
	$d = explode('data-label="Selling TT/OD">', $val);
	$d = explode('</th>', $d[1]); // Rate
	$d = explode('</td>', $d[0]); // Rate
	$e = array_search($c, $currencies); // CurrCode
	if (!isset($rates[$e]))
		$rates[$e] = Array('Currency' => $c, 'Rate' => $d[0]);
}
//echo print_r($rates,true);
// exit;


$rate = $rates[$currency]['Rate'];
echo (in_array($currency, $hundreds) ? $rate/100 : $rate);

?>
