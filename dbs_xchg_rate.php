<?php
/*
// Program       : Obtain Exchange Rate from DBS Bank in Singapore Dollars
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2015-02-23
// Example Usage : http://DOMAIN.TLD/PATH/dbs_xchg_rate.php?c=IDR
*/

$url='https://www.posb.com.sg/personal/rates-online/foreign-currency-foreign-exchange.page';
// $curr = isset($_REQUEST['c']) ? $_REQUEST['c'] : 'Indian Rupee';
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

$hundreds = Array('JPY', 'THB', 'IDR', 'CNY', 'INR', 'KRW', 'LKR', 'PHP', 'SAR', 'TWD');

$curr = (array_key_exists($currency, $currencies)) ? $currencies[$currency] : FALSE;
if ($curr === FALSE) { echo 0; exit; }

$a = <<<EOT
<!DOCTYPE html><!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html class="no-js"><![endif]--><head><META http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>Foreign Currencies - Foreign Exchange | POSB Bank Singapore</title><meta charset="utf-8"><meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible"><meta content="width=device-width, initial-scale=1.0" name="viewport"><meta name="keywords" content=""><meta name="description" content=""><meta name="vpath" content=""><meta name="page-locale-name" content=""><script type="text/javascript" src="/iwov-resources/scripts/web/jquery.min.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/cf69c6f2.modernizr.min.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/09c81293.bootstrap.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/global.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/load-desktop-or-devices.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/common_utility.js"></script><script type="text/javascript" src="/iwov-resources/js/gtm_code/sgposb_gtm.js"></script><script type="text/javascript" src="/iwov-resources/js/pweb_custom.js"></script><script type="text/javascript" src="/iwov-resources/scripts/web/url-changer.js"></script><link href="/iwov-resources/fixed-layout/default-layout-with-side-modules-and-breadcrumb.css" type="text/css" rel="stylesheet"></head><body itemtype="http://schema.org/WebPage" itemscope="itemscope" class=""><div class=" main-container container"><div class=" row-fluid"><div class=" span12"><script type="text/javascript">var language= "en";var country= "sg";var segmentName= "posb";var gsaSearchCollection= "posb&Client1=dbssg";</script><div class="header row-fluid hidden-phone" id="header">
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
<a tabindex="8" href="https://www.dbs.com.sg/personal/default.page" target="_self">DBS</a>
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
<li class="login">
<div class="dropdown">
<a class="dropdown-toggle" data-toggle="dropdown" href="javascript:void(0)">Login</a>
<div class="login-lock">
<span class="icons-lock"></span>
</div>
<ul class="dropdown-menu pull-right" id="login-dropdown">
<li class="divider">
<a href="https://internet-banking.dbs.com.sg/posb" target="_self">POSB iBanking</a>
</li>
<li class="divider">
<a href="https://www.dbsvonline.com/English/index.asp?pagetosecure=login.asp" target="_blank">DBS Vickers Online</a>
</li>
</ul>
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
<a href="#" data-target="main-navigation-container-phone" class="pull-left icn-mobile-nav-menu mobile-trigger"></a><a class="logo pull-left" href="/personal/default.page"></a><a href="#" data-target="mobile-search" class="pull-right icn-flag  mobile-trigger-searchbox"></a><a href="#" id="mobile-lang-country-section" data-target="language-country-dropdown" class="pull-right icn-mobile-nav-menu mobile-trigger"></a><a href="#" data-target="segment-dropdown" class="pull-right icn-mobile-nav-menu mobile-trigger"></a>
</div>
<div class="mobile-dropdown" id="main-navigation-container-phone">
<ul class="clearfix">
<a href="/personal/default.page">
<li class="active">Home<div class="scope-note">POSB Banking</div>
</li>
</a><a href="/personal/deposits/default.page">
<li class="">Bank<div class="scope-note">Day to Day</div>
</li>
</a><a href="/personal/cards/default.page">
<li class="">Cards<div class="scope-note">For Everyday</div>
</li>
</a><a href="/personal/investments/default.page">
<li class="">Invest<div class="scope-note">Your Wealth</div>
</li>
</a><a href="/personal/loans/default.page">
<li class="">Borrow<div class="scope-note">For Home & more</div>
</li>
</a><a href="/personal/insurance/default.page">
<li class="">Protect<div class="scope-note">You & Your Family</div>
</li>
</a><a href="/personal/retirement/default.page">
<li class="">Plan<div class="scope-note">Your Retirement</div>
</li>
</a>
</ul>
</div>
<div id="segment-dropdown" class="mobile-dropdown">
<ul class="clearfix">
<li class="mobile-login">
<a href="javascript:void(0)">Login<div class="icons-lock"></div>
</a>
</li>
<li class="divider">
<a href="https://internet-banking.dbs.com.sg/posb" target="_self">POSB iBanking</a>
</li>
<li class="divider">
<a href="https://www.dbsvonline.com/English/index.asp?pagetosecure=login.asp" target="_blank">DBS Vickers Online</a>
</li>
<li class="list-heading">
<span class="seo-span-msegmentheading">Choose Your Website</span>
</li>
<li class="list-heading">
<span class="seo-span">Personal Banking</span>
</li>
<li class="">
<a tabindex="-1" data-value=" TODO when branch structure has been decided" href="https://www.dbs.com.sg/personal/default.page">DBS</a>
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
<div id="language-country-dropdown" class="mobile-dropdown">
<ul class="clearfix">
<li class="list-heading">
<span class="seo-span">sg</span>
</li>
<li class="list-heading">
<span class="seo-span">Language</span>
</li>
<li class="mobile-language-item selected">
<a href="javascript:void(0)" tabindex="-1" data-value="en">English</a>
</li>
</ul>
</div>
<div id="mobile-search" class="mobile-dropdown-searchbox">
<ul class="clearfix">
<li class="search-item">
<div style="position: relative;" class="input-append">
<input type="text" name="searchmobile" class="gsad-search-box" id="searchmobile" placeholder="Search">
<table id="search_suggest_1" style="width: 146px; visibility: hidden;" class="ss-gac-m"></table>
<button id="hsearchbuttonmobile" class="btn btn-info" type="button">
<div class="icn-search"></div>
</button>
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
<a href="/personal/cards/default.page" target="_self">Cards<div class="scope-note">For Everyday</div>
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
<a href="/personal/retirement/default.page" target="_self">Plan<div class="scope-note">Your Retirement</div>
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
</div></div><div class=" row-fluid page-module"><div class=" span8"><div class="row-fluid">
<div class=" span12">
<div class="row-fluid">
<div class="rates">
<h1>Foreign Currencies - Foreign Exchange</h1>
<div class="fxtitle">
<h2>Foreign Exchange Rates</h2>
</div>
<div class="rates-table">
<table data-label="Currency" border="0" class="table-bordered table-condensed table-hover mobileGrid">
<thead>
<tr>
<th class="first-th" colspan="2"></th><th colspan="3">For amounts less than S$50,000</th><th colspan="3">For amounts S$50,000 to S$200,000</th>
</tr>
<tr>
<th>Currency</th><th>Unit</th><th>Selling TT/OD</th><th>Buying TT</th><th>Buying OD</th><th>Selling TT/OD</th><th>Buying TT</th><th>Buying OD</th>
</tr>
</thead>
<tbody>
<tr>
<td><img src="/iwov-resources/images/rates/flag_us.gif">&nbsp;US Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.3659</td><td data-label="
												Buying TT
												">1.3479</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.3429</td><td data-label="
												Selling TT/OD
												">1.3649</td><td data-label="
												Buying TT
												">1.3489</td><td data-label="
												Buying OD
												">1.3442</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_eu.gif">&nbsp;Euro</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.5664</td><td data-label="
												Buying TT
												">1.5323</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.5321</td><td data-label="
												Selling TT/OD
												">1.5658</td><td data-label="
												Buying TT
												">1.5329</td><td data-label="
												Buying OD
												">1.5329</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_brit.gif">&nbsp;Sterling Pound</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">2.1049</td><td data-label="
												Buying TT
												">2.0673</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">2.0573</td><td data-label="
												Selling TT/OD
												">2.1029</td><td data-label="
												Buying TT
												">2.0693</td><td data-label="
												Buying OD
												">2.0598</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_au.gif">&nbsp;Australian Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.0668</td><td data-label="
												Buying TT
												">1.0440</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.0391</td><td data-label="
												Selling TT/OD
												">1.0660</td><td data-label="
												Buying TT
												">1.0448</td><td data-label="
												Buying OD
												">1.0408</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_ca.gif">&nbsp;Canadian Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.0999</td><td data-label="
												Buying TT
												">1.0776</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.0728</td><td data-label="
												Selling TT/OD
												">1.0987</td><td data-label="
												Buying TT
												">1.0788</td><td data-label="
												Buying OD
												">1.0749</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_nz.gif">&nbsp;New Zealand Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.0310</td><td data-label="
												Buying TT
												">1.0079</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.0029</td><td data-label="
												Selling TT/OD
												">1.0298</td><td data-label="
												Buying TT
												">1.0091</td><td data-label="
												Buying OD
												">1.0050</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_denmark.gif">&nbsp;Danish Kroner</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">0.2108</td><td data-label="
												Buying TT
												">0.2054</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.2024</td><td data-label="
												Selling TT/OD
												">0.2103</td><td data-label="
												Buying TT
												">0.2059</td><td data-label="
												Buying OD
												">0.2033</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_hk.gif">&nbsp;Hong Kong Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">0.1769</td><td data-label="
												Buying TT
												">0.1729</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.1714</td><td data-label="
												Selling TT/OD
												">0.1766</td><td data-label="
												Buying TT
												">0.1732</td><td data-label="
												Buying OD
												">0.1719</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_norway.gif">&nbsp;Norwegian Kroner</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">0.1818</td><td data-label="
												Buying TT
												">0.1773</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.1743</td><td data-label="
												Selling TT/OD
												">0.1814</td><td data-label="
												Buying TT
												">0.1777</td><td data-label="
												Buying OD
												">0.1751</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_sweden.gif">&nbsp;Swedish Kroner</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">0.1641</td><td data-label="
												Buying TT
												">0.1591</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.1561</td><td data-label="
												Selling TT/OD
												">0.1634</td><td data-label="
												Buying TT
												">0.1598</td><td data-label="
												Buying OD
												">0.1572</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_switzerland.gif">&nbsp;Swiss Franc</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">1.4742</td><td data-label="
												Buying TT
												">1.4430</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.4390</td><td data-label="
												Selling TT/OD
												">1.4729</td><td data-label="
												Buying TT
												">1.4443</td><td data-label="
												Buying OD
												">1.4405</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_cn.gif">&nbsp;Chinese Renminbi(Offshore)</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">1</td><td data-label="
												selling TT/OD
												">0.2188</td><td data-label="
												Buying TT
												">0.2142</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.0000</td><td data-label="
												Selling TT/OD
												">0.2183</td><td data-label="
												Buying TT
												">0.2147</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_jp.gif">&nbsp;Japanese Yen</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">100</td><td data-label="
												selling TT/OD
												">1.1544</td><td data-label="
												Buying TT
												">1.1336</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">1.1306</td><td data-label="
												Selling TT/OD
												">1.1532</td><td data-label="
												Buying TT
												">1.1348</td><td data-label="
												Buying OD
												">1.1322</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_th.gif">&nbsp;Thai Baht</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">100</td><td data-label="
												selling TT/OD
												">4.2216</td><td data-label="
												Buying TT
												">4.1058</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">4.0258</td><td data-label="
												Selling TT/OD
												">4.2166</td><td data-label="
												Buying TT
												">4.1108</td><td data-label="
												Buying OD
												">4.0428</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_id.gif">&nbsp;Indonesian Rupiah</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts less than S$50,000
												">100</td><td data-label="
												selling TT/OD
												">0.0109</td><td data-label="
												Buying TT
												">0.0000</td><td class="group-label" data-label="
												Buying OD
												" data-group-label="
												For amounts S$50,000 to S$200,000
												">0.0000</td><td data-label="
												Selling TT/OD
												">0.0000</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
</tbody>
</table>
<span class="sourceinfo-rates"><strong>Effective Date:</strong>&nbsp;16/02/2015&nbsp;<strong>Last Updated:</strong> 7:02pm</span>
<div class="notes">
<b class="disclaimerHeading">Notes:</b>
<ul class="disclaimer">
<li>
									  Telegraphic Transfer ("TT") rates and On Demand ("OD") are rates available involving foreign exchange. 
									 </li>
<li>
									  The TT rate is applicable to funds that has already been cleared with the Bank while the OD rate is applied otherwise.
									</li>
<li>	
									The buying rate is used when foreign currency is sold to the Bank and the selling rate is used when foreign currency is bought from the Bank.
									</li>
</ul>
</div>
</div>
<div class="fxtitle">
<h2>Other Currency Types</h2>
</div>
<div class="rates-table">
<table data-label="Currency" border="0" class="table-bordered table-condensed table-hover mobileGrid">
<tbody>
<thead>
<tr>
<th class="first-th" colspan="2"></th><th colspan="3">For amounts up to S$200,000</th>
</tr>
<tr>
<th>Currency</th><th>Unit</th><th>Selling TT/OD</th><th>Buying TT</th><th>Buying OD</th>
</tr>
</thead>
<tr>
<td><img src="/iwov-resources/images/rates/flag_brunei.gif">&nbsp;Brunei Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">1</td><td data-label="
												selling TT/OD
												">1.0000</td><td data-label="
												Buying TT
												">1.0000</td><td data-label="
												Buying OD
												">0.9950</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_southafrica.gif">&nbsp;South African Rand</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">1</td><td data-label="
												selling TT/OD
												">0.1185</td><td data-label="
												Buying TT
												">0.1150</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_cn.gif">&nbsp;Chinese Renminbi</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">0.0000</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_in.gif">&nbsp;Indian Rupee</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">2.2016</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_kr.gif">&nbsp;Korean Won</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">0.1251</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_srilanka.gif">&nbsp;Sri Lanka Rupee</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">1.0376</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_ph.gif">&nbsp;Philippine Peso</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">3.0947</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_saudi.gif">&nbsp;Saudi Rial</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">36.5089</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
<tr>
<td><img src="/iwov-resources/images/rates/flag_tw.gif">&nbsp;New Taiwan Dollar</td><td class="group-label" data-label="
												Unit
												" data-group-label="
												For amounts up to S$200,000
												">100</td><td data-label="
												selling TT/OD
												">4.3700</td><td data-label="
												Buying TT
												">0.0000</td><td data-label="
												Buying OD
												">0.0000</td>
</tr>
</tbody>
</table>
<span class="sourceinfo-rates"><strong>Effective Date:</strong>&nbsp;16/02/2015&nbsp;<strong>Last Updated:</strong> 7:02pm</span>
<div class="notes">
<b class="disclaimerHeading">Notes:</b>
<ul class="disclaimer">
<li>Rates quoted are subject to change without prior notice.</li>
<li>Rates information is also available toll free on 1800-111 1111.</li>
</ul>
</div>
</div>
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
<a target="_self" href="/personal/locator.page">Locate Us</a>
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
<a href="/personal/locator.page" target="_self">
<p class="span8">Locate Us</p>
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
</div></div><div class=" row-fluid"><div class=" footer-span12 span12"><div class="row-fluid">
<div class=" footer-span12 span12">
<form id="footervarform" action="/personal/searchresults.page?submit=true&componentID=1409243817410" method="post">
<input id="country" type="hidden" value="sg"><input id="googleFooterLang" type="hidden" value="en"><input id="selectedCountry" type="hidden" value="sg"><input id="googleLanguage" type="hidden" value="en">
</form>
<script src="/iwov-resources/scripts/web/footer-on-demand.js" type="text/javascript"></script>
<div class="page-module footer">
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
<div class="span3 ">
<div>
</div>
<ul class="square"></ul>
</div>
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
</div>
</div>
<div class="page-module transparent global-footer">
<div class="row-fluid">
<div id="footer-content" class="span12 clearfix">
<div class="left-section">
<ul>
<li>
<a href="http://www.dbs.com/terms/Pages/default.aspx" target="_self">Terms & Conditions</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com/privacy/Pages/default.aspx" target="_self">Privacy Policy</a><span>|</span>
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
</div><script src="/iwov-resources/scripts/s_code.js"  language="JavaScript"></script>

<script language="JavaScript">
<!--
/* You may give each page an identifying name, server, and channel on
the next lines. */
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
var s_code=s.t();if(s_code)document.write(s_code)//-->
</script>
<script language="JavaScript">
<!--
if(navigator.appVersion.indexOf('MSIE')>=0)document.write(unescape('%3C')+'!-'+'-')
//-->
</script>


<noscript> <a href="http://www.omniture.com" title="Web Analytics"><img src="http://dbs.112.2o7.net/b/ss/dbswebsitedev/1/H.13--NS/0" height="1" width="1" border="0" alt="" /></a> </noscript>
</div>
</div>
</div>
<div></div>
</div></div></div></body><!--</html>-->
EOT;


$a = file_get_contents($url);
$b = explode("<tr", $a);
/*
$c='';
foreach ($b as $stanza) {
if (!(stristr($stanza, 'Indian Rupee'))) continue;
$c = $stanza;
break;
}

$d = explode('</td><td data-label="', $stanza);
echo print_r($d, true);
*/

$searchword = $curr;
$matches = array_filter($b, function($var) use ($searchword) { return preg_match("/\b$searchword\b/i", $var); });
$c = array_pop($matches);
if (count($matches) > 0) $c = array_pop($matches);
$c = str_replace(CHR(13),'',$c);
$c = str_replace(CHR(10),'',$c);
// echo $c;

$d = explode('</td><td data-label="', $c);
$e = explode('>', $d[1]);
echo (in_array($currency, $hundreds) ? $e[1]/100 : $e[1]);

?>
