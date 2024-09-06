<?php
/*
// Program       : Obtain Exchange Rate from DBS Bank in Singapore Dollars
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 2.50
// Release Date  : 2015-09-27
// Last Updated  : 2017-11-07
// Notes         : html code template of source page changed on 2015-09-26, 2015-11-21/27, 2017-10-xx
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

//$url='https://www.posb.com.sg/personal/rates-online/foreign-currency-foreign-exchange.page';
$url='https://www.dbs.com.sg/personal/rates-online/foreign-currency-foreign-exchange.page';
$bcurrency = isset($_REQUEST['b']) ? substr(strtoupper(trim($_REQUEST['b'])),0,3) : 'SGD';
$currency  = isset($_REQUEST['c']) ? substr(strtoupper(trim($_REQUEST['c'])),0,3) : (($bcurrency != 'SGD') ? 'SGD' :'INR');
// TSV only if target currency is not given
$tsvlist   = (isset($_REQUEST['r']) && !isset($_REQUEST['c']) && $_REQUEST['r'] != 0);

// Chinese Renminbi(Offshore) => Chinese Renminbi
// TRL, RUB, MXN are zeroes for now
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
'AED' => 'UAE Dirham',
'TRL' => 'Turkish Lira',
'JPY' => 'Japanese Yen',
'THB' => 'Thai Baht',
'IDR' => 'Indonesian Rupiah',
'RUB' => 'Russian Ruble',
'MXN' => 'Mexican Peso',

'BND' => 'Brunei Dollar',
'ZAR' => 'South African Rand',
'CNY' => 'Chinese Renminbi',
'INR' => 'Indian Rupee',
'KRW' => 'Korean Won',
'LKR' => 'Sri Lanka Rupee',
'PHP' => 'Philippine Peso',
'TWD' => 'New Taiwan Dollar',
'SAR' => 'Saudi Rial'
);

if ($currency == $bcurrency && !$tsvlist) { echo 1; exit; }
if (!array_key_exists($currency, $currencies) || !array_key_exists($bcurrency, $currencies)) exit;


// $hundreds = Array('JPY', 'THB', 'IDR', 'CNY', 'INR', 'KRW', 'LKR', 'PHP', 'SAR', 'TWD');
$hundreds = Array('JPY', 'THB', 'IDR', 'INR', 'KRW', 'LKR', 'PHP', 'SAR', 'TWD');

$curr = (array_key_exists($currency, $currencies)) ? $currencies[$currency] : FALSE; // long form
if ($curr === FALSE) { echo 0; exit; }

if ($debug) {
$a = <<<EOT
<!DOCTYPE html>
<!DOCTYPE html><!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]--><!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"><![endif]--><!--[if IE 8]><html class="no-js lt-ie9"><![endif]--><!--[if gt IE 8]><html class="no-js"><![endif]--><head>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>Foreign Currencies, Foreign Exchange Rates | DBS Singapore</title>
<meta charset="utf-8">
<meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
<meta content="IE=EmulateIE7; IE=EmulateIE8" http-equiv="X-UA-Compatible">
<meta content="width=device-width, initial-scale=1.0" name="viewport">
<meta name="keywords" content="">
<meta name="description" content="">
<meta name="vpath" content="">
<meta name="page-locale-name" content="">
<link type="text/css" href="/iwov-resources/flp/css/vendor/bootstrap.min.css" rel="stylesheet">
<link type="text/css" href="/iwov-resources/flp/css/component.css" rel="stylesheet">
<link type="text/css" href="/iwov-resources/flp/css/flp.css" rel="stylesheet">
<script type="text/javascript" src="/iwov-resources/flp/js/vendor/html5shiv.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/vendor/jquery-min.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/vendor/bootstrap.min.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/script.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/flp.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/mbchat.js"></script><script type="text/javascript" src="//assets.adobedtm.com/71d06aac4e562e3a2278bf493855202cacdacaa2/satelliteLib-3145f6b319cc00978cdb815fdbdf4a767b992f1f.js"></script><script type="text/javascript" src="/iwov-resources/flp/js/sgpersonal_gtm.js"></script>
<link href="/iwov-resources/fixed-layout/flp-freehtml-detail-three-areas.css" type="text/css" rel="stylesheet"><meta name='chat.enabled' content='true' /> <meta name="Product" content="Foreign Currencies - Foreign Exchange, dbs, singapore, deposits"/><meta name='page.destinationURL' content='www.dbs.com.sg//i-bank/rates-online/foreign-currency-foreign-exchange.page' /><meta name='page.pageType' content='section - home' /><meta name='page.site' content='pweb' /><meta name='page.primaryCat' content='dbs' /><meta name='page.language' content='en' /><meta name='page.country' content='sg' /><meta name='page.brand' content='dbs' /><meta name='form.primaryCat' content=''  /></head><body class="">
<div class=" read-freehtml prodDetail">
<div class="" id="main-wrapper">
<div class="" id="header-section"><!--component-1489849583265--><div class="mobile-slideleft hidden-lg" id="mobileSlideMenu">
<div class="search-group">
<div class="search-box open">
<input autocomplete="off" class="mm-searchbox" placeholder="Search" type="text"><button class="btn-search" data-url="/personal/searchresults.page" data-target="_blank" id="btnMainMobSearch" type="button"><span class="icon ico-search"></span></button><a class="btn-close hide" href="javascript:void(0);"><span class="icon ico-cancel4"></span></a>
</div>
<div id="search_suggest_m_0" class="ss-gac-m">
<div data-max="5" class="search-section"></div>
</div>
</div>
<div class="clearfix"></div>
<ul class="mega-panel" id="megaMenuParent">
<li class="separator-hr"></li>
<li class="panel">
<a href="/personal/deposits/default.page" data-node="j7nnjyme">Bank</a>
</li>
<li class="panel">
<a href="/personal/cards/default.page" data-node="j7nnjymf">Cards</a>
</li>
<li class="panel">
<a href="/personal/insurance/default.page" data-node="j7nnjymg">Insure</a>
</li>
<li class="panel">
<a href="/personal/loans/default.page" data-node="j7nnjymh">Borrow</a>
</li>
<li class="panel">
<a href="/personal/investments/default.page" data-node="j7nnjymi">Invest</a>
</li>
<li class="panel">
<a href="/personal/learn/default.page" data-node="j7nnjymj">Learn</a>
</li>
<li class="panel">
<a href="/personal/marketplace/default.page" data-node="j7nnjymk">Marketplace</a>
</li>
<li class="separator-hr"></li>
<li class="panel txt-small">
<a target="_blank" href="/index/locator.page?pid=sg-dbs-pweb-header-default-atm-branch-textlink">ATM & Branch</a>
</li>
<li class="panel txt-small">
<a href="#LinkN10018" data-parent="#megaMenuParent" data-toggle="collapse" class="collapsed"><i class="icon ico-play icon-animate-tri"></i>You are in Personal Banking</a>
<ul class="last-menu panel-group collapse" id="LinkN10018">
<li class="panel-header">
<label>Personal Banking</label>
</li>
<li class="active">
<a target="_blank" href="http://www.dbs.com.sg/personal/default.page">DBS</a>
</li>
<li>
<a target="_blank" href="http://www.posb.com.sg/personal/default.page">POSB</a>
</li>
<li class="spacer"></li>
<li class="panel-header">
<label>Wealth Management</label>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/treasures/default.page">DBS Treasures</a>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/treasures-private-client/default.page">DBS Treasures Private Client</a>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/private-banking/default.page">DBS Private Bank</a>
</li>
<li class="spacer"></li>
<li class="panel-header">
<label>DBS Vickers Securities</label>
</li>
<li>
<a target="_blank" href="http://www.dbsvonline.com">DBS Vickers Online</a>
</li>
<li class="spacer"></li>
<li class="panel-header">
<label>Business Banking</label>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/sme/default.page">SME Banking</a>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/corporate/default.page">Corporate Banking</a>
</li>
<li>
<a target="_blank" href="http://www.dbs.com.sg/institutional-investors/index.html">Institutional Investors</a>
</li>
<li class="spacer"></li>
<li class="panel-header">
<label>DBS Group</label>
</li>
<li>
<a target="_blank" href="http://www.dbs.com/default.page">About DBS</a>
</li>
</ul>
</li>
</ul>
<div class="clearfix"></div>
</div><div data-locale="en" class="header-placeholder flp-type" id="flpHeader">
<div class="mini-navbar hidden-xs">
<div class="mini-navbar-body">
<ul>
<li>
<a class="menu-link" href="javascript:void(0);">You are in Personal Banking<i class="icon ico-play"></i></a>
<dl class="navbar-list long">
<dt>
<label>Personal Banking</label>
</dt>
<dd class="active">
<a target="_blank" href="http://www.dbs.com.sg/personal/default.page">DBS</a>
</dd>
<dd>
<a target="_blank" href="http://www.posb.com.sg/personal/default.page">POSB</a>
</dd>
<dt>
<label>Wealth Management</label>
</dt>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/treasures/default.page">DBS Treasures</a>
</dd>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/treasures-private-client/default.page">DBS Treasures Private Client</a>
</dd>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/private-banking/default.page">DBS Private Bank</a>
</dd>
<dt>
<label>DBS Vickers Securities</label>
</dt>
<dd>
<a target="_blank" href="http://www.dbsvonline.com">DBS Vickers Online</a>
</dd>
<dt>
<label>Business Banking</label>
</dt>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/sme/default.page">SME Banking</a>
</dd>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/corporate/default.page">Corporate Banking</a>
</dd>
<dd>
<a target="_blank" href="http://www.dbs.com.sg/institutional-investors/index.html">Institutional Investors</a>
</dd>
<dt>
<label>DBS Group</label>
</dt>
<dd>
<a target="_blank" href="http://www.dbs.com/default.page">About DBS</a>
</dd>
</dl>
</li>
<li>
<a target="_blank" href="/index/locator.page?pid=sg-dbs-pweb-header-default-atm-branch-textlink">ATM & Branch</a>
</li>
<li>
<a target="_blank" href="/personal/support/home.html?pid=sg-dbs-pweb-header-default-help-support-textlink">Help & Support</a>
</li>
</ul>
</div>
</div>
<header class="navbar mega-menu">
<div class="navbar-inner">
<a class="img-logo bg-none hidden-xs" target="_self" href="/personal/default.page"><img alt="DBS logo" src="/iwov-resources/flp/images/dbs_logo.svg"></a>
<div class="navbar-header  hidden-sm hidden-md hidden-lg">
<div class="pull-left">
<div class="mobile-box">
<a data-target="#mobileSlideMenu" id="mobileSlideId" class="mobile-menu" href="javascript:void(0);">
<div class="hamburger-menu" id="btnHamburger">
<span></span><span></span>
</div>
</a>
</div>
<a class="navbar-brand" target="_self" href="/personal/default.page"><img alt="DBS logo" src="/iwov-resources/flp/images/dbs_logo.svg"></a>
</div>
<div class="pull-right">
<div class="mobile-box">
<a target="_blank" href="/personal/support/home.html?pid=sg-dbs-pweb-header-default-help-support-textlink" class="mobile-menu"><i class="icon ico-help2"></i></a>
</div>
<div class="dark-menu-group">
<a aria-expanded="false" aria-haspopup="true" class="button-wrapper" href="https://internet-banking.dbs.com.sg" target="_blank"><i class="icon ico-lock2"></i>Login</a>
</div>
</div>
</div>
<div class="navbar-links-left hidden-xs ">
<ul>
<li>
<a data-node="j7nnjyme" href="/personal/deposits/default.page">Bank</a>
</li>
<li>
<a data-node="j7nnjymf" href="/personal/cards/default.page">Cards</a>
</li>
<li>
<a data-node="j7nnjymg" href="/personal/insurance/default.page">Insure</a>
</li>
<li>
<a data-node="j7nnjymh" href="/personal/loans/default.page">Borrow</a>
</li>
<li>
<a data-node="j7nnjymi" href="/personal/investments/default.page">Invest</a>
</li>
<li class="divider"></li>
<li>
<a data-node="j7nnjymj" href="/personal/learn/default.page">Learn</a>
</li>
<li>
<a data-node="j7nnjymk" href="/personal/marketplace/default.page">Marketplace</a>
</li>
</ul>
</div>
<div class="header-navigation hidden-xs ">
<ul class="header-menu">
<li class="submenulist">
<div class="dropdown" id="searchMenuId">
<a aria-expanded="false" aria-haspopup="true" data-toggle="dropdown" class="button-wrapper" href="javascript:void(0);"><span class="icon ico-search"></span></a>
<div role="menu" class="dropdown-menu dark-menu">
<form role="form" class="form-horizontal" method="post">
<div class="search-menu">
<div class="search-menu-content">
<div class="row">
<div class="search-box open col-md-12 col-sm-12 ">
<input autocomplete="off" class="m-searchbox" name="search" placeholder="Search" type="text">
<div id="search_suggest_m_m0" class="ss-gac-mm">
<div data-max="5" class="search-section"></div>
<div>
<button data-url="/personal/searchresults.page" data-target="_blank" class="btn-view-all-results form-control text-center">View all results</button>
</div>
</div>
<table id="search_suggest_recent" class="ss-gac-recent hide"></table>
<button class="btn-search" data-url="/personal/searchresults.page" data-target="_blank" id="btnMainSearch" type="button"><span class="icon ico-search"></span></button><a class="btn-close hide" href="javascript:void(0);"><span class="icon ico-cancel4"></span></a><a class="btn-history m-btn-history" href="javascript:void(0);"><span class="icon ico-time1"></span></a><label class="pop-search-label">Popular searches</label>
<ol class="pop-search-list">
<li>
<a target="_blank" href="/personal/searchresults.page?q=digibank">digibank</a>
</li>
<li>
<a target="_blank" href="/personal/searchresults.page?q=GIRO">GIRO</a>
</li>
<li>
<a target="_blank" href="/personal/searchresults.page?q=Travel Insurance">Travel Insurance</a>
</li>
<li>
<a target="_blank" href="/personal/searchresults.page?q=Loan">Loan</a>
</li>
<li>
<a target="_blank" href="/personal/searchresults.page?q=Swift Code">Swift Code</a>
</li>
</ol>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</li>
<li class="submenulist last-child">
<div class="dark-menu-group">
<a aria-expanded="false" aria-haspopup="true" class="button-wrapper" href="https://internet-banking.dbs.com.sg" target="_blank"><i class="icon ico-lock2"></i>Login</a>
</div>
</li>
</ul>
</div>
</div>
</header>
</div><script type="text/javascript">
            var gsaSearchCollection= "sg_ibank_personal_upgrade&Client1=dbssg_ibank";
            var directory = 'personal';
            context_s = 'i-bank';
            context_d = 'personal';
            $(document).ready(function() {
            var navLinkHref = $('.breadcrumb li:eq(1) a').attr('href');
            if (navLinkHref != '') {
            $.hightlightMegaMenu(navLinkHref);
            }
            });
        </script>
</div>
<div class=" main-container" id="bodywrapper"><!--ForiegnExchange Rates-1489849583266--><div class="container flp-freestyle flp-fx">
<section class="mTop-24">
<div class="row">
<div class="col-md-4 col-sm-4">
<div class="left-wrapper">
<ul class="left-breadcrumb breadcrumb">
<li>
<a href="/personal/default.page">Home<i class="icon ico-arrowright2"></i></a>
</li>
<li>
<a href="/personal/rates-online/default.page">Rates Online<i class="icon ico-arrowright2"></i></a>
</li>
<li>Foreign Currencies - Foreign Exchange</li>
</ul>
<div class="left-promotion-content">
<h1 class="h1-big">Foreign Currencies - Foreign Exchange</h1>
</div>
<div class="list-box desktop-nav-bar" id="sideNav">
<ul class="left-nav nav navbar-nav">
<li class="clearfix">
<a class="hasDevice" href="#slideToNavLink1"><span class="nav-icon ico-arrowright3"></span>Main Currency Rates</a>
</li>
<li class="clearfix">
<a class="hasDevice" href="#slideToNavLink2"><span class="nav-icon ico-arrowright3"></span>Other Currency Rates</a>
</li>
</ul>
</div>
<div class="list-box mobile-nav-bar" id="mb-menu-top">
<a class="select-section hasShadow"><span class="nav-text">Main Currency Rates</span><span class="icon ico-arrowdown1 icon-arrow">&amp;nbsp;</span></a>
<div class="top-nav">
<span class="icon ico-arrowup1 icon-arrow">&amp;nbsp;</span>
<ul class="navbar-nav nav">
<li>
<a class="hasDevice" href="#slideToNavLink1">Main Currency Rates</a>
</li>
<li>
<a class="hasDevice" href="#slideToNavLink2">Other Currency Rates</a>
</li>
</ul>
</div>
</div>
</div>
</div>
<div class="col-md-8 col-sm-8 left-content">
<span class="anchor" id="slideToNavLink1"></span>
<div class="dropdown-wrapper mBot-24">
<div class="custom-dropdown fx-fe-dropdown">
<select><option value="All">View All</option><option value="usdollar">US Dollar</option><option value="euro">Euro</option><option value="sterlingpound">Sterling Pound</option><option value="australiandollar">Australian Dollar</option><option value="canadiandollar">Canadian Dollar</option><option value="newzealanddollar">New Zealand Dollar</option><option value="danishkroner">Danish Kroner</option><option value="hongkongdollar">Hong Kong Dollar</option><option value="norwegiankroner">Norwegian Kroner</option><option value="swedishkroner">Swedish Kroner</option><option value="swissfranc">Swiss Franc</option><option value="chineserenminbi(offshore)">Chinese Renminbi(Offshore)</option><option value="uaedirham">UAE Dirham</option><option value="turkishlira">Turkish Lira</option><option value="japaneseyen">Japanese Yen</option><option value="thaibaht">Thai Baht</option><option value="indonesianrupiah">Indonesian Rupiah</option><option value="russianruble">Russian Ruble</option><option value="mexicanpeso">Mexican Peso</option><option value="bruneidollar">Brunei Dollar</option><option value="southafricanrand">South African Rand</option><option value="chineserenminbi">Chinese Renminbi</option><option value="indianrupee">Indian Rupee</option><option value="koreanwon">Korean Won</option><option value="srilankarupee">Sri Lanka Rupee</option><option value="philippinepeso">Philippine Peso</option><option value="newtaiwandollar">New Taiwan Dollar</option><option value="saudirial">Saudi Rial</option></select>
</div>
</div>
<h4 class="mBot-24 mTop-0 eff-note">Effective Date: 21/11/2017  Last Updated:  4:46pm</h4>
<div class="table-wrapper mBot-24 table-primary-wrapper">
<h2 class="h2-big mBot-16">Main Currency Rates</h2>
<table class="tbl-primary mBot-16 tbl-fe-primary">
<colgroup>
<col width="30%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
<col width="10%">
</colgroup>
<thead>
<tr class="table-subHeader">
<th colspan="3" class="align-right">
                                        &nbsp;
                                    </th><th>
                                        &nbsp;
                                    </th><th colspan="3" class="align-right">For amount less than S$50,000</th><th colspan="3" class="align-right">For amounts S$50,000 to S$200,000</th>
</tr>
<tr>
<th colspan="3" class="align-bottom pLeft-0">Currency</th><th data-after-text="For amount less than $50,000" data-before-text="Unit" class="align-bottom align-right ">Unit</th><th class="align-right ">Selling TT/OD</th><th class="align-right ">Buying TT</th><th class="align-right ">Buying OD</th><th data-before-text="For amount less than $50,000" class="align-right ">Selling TT/OD</th><th class="align-right ">Buying TT</th><th class="align-right ">Buying OD</th>
</tr>
</thead>
<tbody>
<tr name="usdollar">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>US Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/usdollar_flg.png" alt="usdollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.3652</td><td data-before-text="Buying TT" class="column4 align-right">1.3469</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.3409</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.3642</td><td data-before-text="Buying TT" class="column7 align-right">1.3479</td><td data-before-text="Buying OD" class="column8 align-right">1.3422</td>
</tr>
<tr name="euro">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Euro</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/euro_flg.png" alt="euro"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.6090</td><td data-before-text="Buying TT" class="column4 align-right">1.5747</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.5697</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.6088</td><td data-before-text="Buying TT" class="column7 align-right">1.5749</td><td data-before-text="Buying OD" class="column8 align-right">1.5705</td>
</tr>
<tr name="sterlingpound">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Sterling Pound</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/sterlingpound_flg.png" alt="sterlingpound"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.8148</td><td data-before-text="Buying TT" class="column4 align-right">1.7776</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.7671</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.8132</td><td data-before-text="Buying TT" class="column7 align-right">1.7792</td><td data-before-text="Buying OD" class="column8 align-right">1.7696</td>
</tr>
<tr name="australiandollar">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Australian Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/australiandollar_flg.png" alt="australiandollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.0345</td><td data-before-text="Buying TT" class="column4 align-right">1.0099</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.0049</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.0327</td><td data-before-text="Buying TT" class="column7 align-right">1.0117</td><td data-before-text="Buying OD" class="column8 align-right">1.0066</td>
</tr>
<tr name="canadiandollar">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Canadian Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/canadiandollar_flg.png" alt="canadiandollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.0680</td><td data-before-text="Buying TT" class="column4 align-right">1.0464</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.0403</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.0678</td><td data-before-text="Buying TT" class="column7 align-right">1.0466</td><td data-before-text="Buying OD" class="column8 align-right">1.0424</td>
</tr>
<tr name="newzealanddollar">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>New Zealand Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/newzealanddollar_flg.png" alt="newzealanddollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.9341</td><td data-before-text="Buying TT" class="column4 align-right">0.9099</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.9037</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.9329</td><td data-before-text="Buying TT" class="column7 align-right">0.9111</td><td data-before-text="Buying OD" class="column8 align-right">0.9068</td>
</tr>
<tr name="danishkroner">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Danish Kroner</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/danishkroner_flg.png" alt="danishkroner"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.2171</td><td data-before-text="Buying TT" class="column4 align-right">0.2107</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.2081</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.2166</td><td data-before-text="Buying TT" class="column7 align-right">0.2112</td><td data-before-text="Buying OD" class="column8 align-right">0.2090</td>
</tr>
<tr name="hongkongdollar">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Hong Kong Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/hongkongdollar_flg.png" alt="hongkongdollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.1756</td><td data-before-text="Buying TT" class="column4 align-right">0.1716</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.1701</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.1753</td><td data-before-text="Buying TT" class="column7 align-right">0.1719</td><td data-before-text="Buying OD" class="column8 align-right">0.1706</td>
</tr>
<tr name="norwegiankroner">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Norwegian Kroner</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/norwegiankroner_flg.png" alt="norwegiankroner"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.1652</td><td data-before-text="Buying TT" class="column4 align-right">0.1606</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.1578</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.1648</td><td data-before-text="Buying TT" class="column7 align-right">0.1610</td><td data-before-text="Buying OD" class="column8 align-right">0.1586</td>
</tr>
<tr name="swedishkroner">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Swedish Kroner</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/swedishkroner_flg.png" alt="swedishkroner"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.1619</td><td data-before-text="Buying TT" class="column4 align-right">0.1563</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.1536</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.1612</td><td data-before-text="Buying TT" class="column7 align-right">0.1570</td><td data-before-text="Buying OD" class="column8 align-right">0.1547</td>
</tr>
<tr name="swissfranc">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Swiss Franc</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/swissfranc_flg.png" alt="swissfranc"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.3810</td><td data-before-text="Buying TT" class="column4 align-right">1.3492</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.3474</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.3797</td><td data-before-text="Buying TT" class="column7 align-right">1.3505</td><td data-before-text="Buying OD" class="column8 align-right">1.3489</td>
</tr>
<tr name="chineserenminbi(offshore)">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Chinese Renminbi(Offshore)</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/chineserenminbi(offshore)_flg.png" alt="chineserenminbi(offshore)"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.2068</td><td data-before-text="Buying TT" class="column4 align-right">0.2015</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.2063</td><td data-before-text="Buying TT" class="column7 align-right">0.2020</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
<tr name="uaedirham">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>UAE Dirham</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/uaedirham_flg.png" alt="uaedirham"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.3792</td><td data-before-text="Buying TT" class="column4 align-right">0.3591</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.3774</td><td data-before-text="Buying TT" class="column7 align-right">0.3609</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
<tr name="turkishlira">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Turkish Lira</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/turkishlira_flg.png" alt="turkishlira"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0000</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.0000</td><td data-before-text="Buying TT" class="column7 align-right">0.0000</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
<tr name="japaneseyen">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Japanese Yen</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/japaneseyen_flg.png" alt="japaneseyen"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.2195</td><td data-before-text="Buying TT" class="column4 align-right">1.1908</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">1.1901</td><td data-before-text="Selling TT/OD" class="column6 align-right">1.2183</td><td data-before-text="Buying TT" class="column7 align-right">1.1920</td><td data-before-text="Buying OD" class="column8 align-right">1.1917</td>
</tr>
<tr name="thaibaht">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Thai Baht</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/thaibaht_flg.png" alt="thaibaht"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">4.1984</td><td data-before-text="Buying TT" class="column4 align-right">4.0720</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">3.9976</td><td data-before-text="Selling TT/OD" class="column6 align-right">4.1878</td><td data-before-text="Buying TT" class="column7 align-right">4.0826</td><td data-before-text="Buying OD" class="column8 align-right">4.0146</td>
</tr>
<tr name="indonesianrupiah">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Indonesian Rupiah</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/indonesianrupiah_flg.png" alt="indonesianrupiah"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0102</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.0000</td><td data-before-text="Buying TT" class="column7 align-right">0.0000</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
<tr name="russianruble">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Russian Ruble</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/russianruble_flg.png" alt="russianruble"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0000</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.0000</td><td data-before-text="Buying TT" class="column7 align-right">0.0000</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
<tr name="mexicanpeso">
<td data-before-text="Currency" colspan="3" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Mexican Peso</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/mexicanpeso_flg.png" alt="mexicanpeso"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0000</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-after-text="For amounts S$50,000 to S$200,000" data-before-text="Buying OD" class="column5 align-right">0.0000</td><td data-before-text="Selling TT/OD" class="column6 align-right">0.0000</td><td data-before-text="Buying TT" class="column7 align-right">0.0000</td><td data-before-text="Buying OD" class="column8 align-right">0.0000</td>
</tr>
</tbody>
</table>
<div class="table-notes">
<h3 class="mBot-24">Notes :</h3>
<ul>
<li>Telegraphic Transfer ("TT") rates and On Demand ("OD") are rates available involving foreign exchange.</li>
<li>The TT rate is applicable to funds that has already been cleared with the Bank while the OD rate is applied otherwise.</li>
<li>The buying rate is used when foreign currency is sold to the Bank and the selling rate is used when foreign currency is bought from the Bank.</li>
</ul>
</div>
</div>
<br>
<span class="anchor" id="slideToNavLink2"></span>
<h4 class="mBot-24 mTop-0 eff-note">Effective Date: 21/11/2017  Last Updated:  4:46pm</h4>
<div class="table-wrapper mBot-24 table-other-wrapper">
<h2 class="h2-big mBot-16">Other Currency Rates</h2>
<table class="tbl-primary mBot-16 tbl-fe-other">
<colgroup>
<col width="30%">
<col width="10%">
<col width="20%">
<col width="20%">
<col width="20%">
</colgroup>
<thead>
<tr class="table-subHeader">
<th colspan="3" class="align-right">
                                                &nbsp;
                                            </th><th colspan="2" class="align-right">For amount less than S$50,000</th>
</tr>
<tr>
<th class="align-bottom pLeft-0">Currency</th><th data-after-text="For amount less than $50,000" data-before-text="Unit" class="align-bottom align-right ">Unit</th><th class="align-right ">Selling TT/OD</th><th class="align-right ">Buying TT</th><th class="align-right ">Buying OD</th>
</tr>
</thead>
<tbody>
<tr name="bruneidollar" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Brunei Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/bruneidollar_flg.png" alt="bruneidollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">1.0000</td><td data-before-text="Buying TT" class="column4 align-right">1.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.9926</td>
</tr>
<tr name="southafricanrand" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>South African Rand</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/southafricanrand_flg.png" alt="southafricanrand"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0980</td><td data-before-text="Buying TT" class="column4 align-right">0.0945</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="chineserenminbi" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Chinese Renminbi</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/chineserenminbi_flg.png" alt="chineserenminbi"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">1</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.0000</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="indianrupee" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Indian Rupee</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/indianrupee_flg.png" alt="indianrupee"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">2.1059</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="koreanwon" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Korean Won</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/koreanwon_flg.png" alt="koreanwon"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.1263</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="srilankarupee" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Sri Lanka Rupee</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/srilankarupee_flg.png" alt="srilankarupee"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">0.8990</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="philippinepeso" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Philippine Peso</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/philippinepeso_flg.png" alt="philippinepeso"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">2.6992</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="newtaiwandollar" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>New Taiwan Dollar</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/newtaiwandollar_flg.png" alt="newtaiwandollar"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">4.5788</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
<tr name="saudirial" class="other">
<td data-before-text="Currency" class="column1 pLeft-0 ">
<div class="clearfix rateHeadContent-wrapper">
<span class="text-wrapper dscTxt"><span>Saudi Rial</span></span><span class="img-wrapper"><img width="16px" height="16px" src="/iwov-resources/flp/images/rates/saudirial_flg.png" alt="saudirial"></span>
</div>
</td><td data-after-text="For amount less than $50,000" data-before-text="Unit" class="column2 align-right fx-unit">100</td><td data-before-text="Selling TT/OD" class="column3 align-right">36.5283</td><td data-before-text="Buying TT" class="column4 align-right">0.0000</td><td data-before-text="Buying OD" class="column5 align-right">0.0000</td>
</tr>
</tbody>
</table>
<div class="table-notes">
<h3 class="mBot-24">Notes :</h3>
<ul>
<li>Rates quoted are subject to change without prior notice.</li>
<li>Rates information is also available toll free on 1800-111 1111.</li>
</ul>
</div>
</div>
</div>
<div class="clearfix"></div>
</div>
</section>
</div>
<!--FreeText-component-1507461043545-->
<footer class="footer footer-gray" id="primaryFooter">
<div class="footer-content">
<div class="col-md-3 col-sm-3 col-xs-12">
<h4>Useful Links</h4>
<ul class="clearfix">
<li class="long-txt">
<a href="https://www.dbs.com/about-us/default.page?pid=sg-dbs-pweb-footer-default-about-dbs-textlink" target="_blank">About DBS</a>
</li>
<li class="long-txt">
<a href="http://www.dbs.com/investor/index.html?pid=sg-dbs-pweb-footer-default-investor-relations-textlink" target="_blank">Investor Relations</a>
</li>
<li class="last">
<a href="/personal/deposits/terms-conditions-electronic-services.page?pid=sg-dbs-pweb-footer-default-term-conditions-governing-electronic-services-textlink" target="_self">Terms & Conditions Governing Electronic Services</a>
</li>
</ul>
</div>
<div class="col-md-3 col-sm-3 col-xs-12">
<h4>Others</h4>
<ul class="clearfix">
<li class="long-txt">
<a href="/personal/form/default.page?pid=sg-dbs-pweb-footer-default-forms-textlink" target="_self">Forms</a>
</li>
<li class="long-txt">
<a href="/personal/rates-online/default.page?pid=sg-dbs-pweb-footer-default-rates-textlink" target="_self">Rates</a>
</li>
<li class="long-txt">
<a href="/personal/calculators/default.page?pid=sg-dbs-pweb-footer-default-tools-textlink" target="_self">Tools</a>
</li>
<li class="long-txt">
<a href="/personal/deposits/security-and-you/default.page?pid=sg-dbs-pweb-footer-default-security-you-textlink" target="_self">Security & You</a>
</li>
<li class="long-txt">
<a href="/personal/deposits/maintenance-schedule.page?pid=sg-dbs-pweb-footer-default-notices-maintenance-textlink" target="_self">Notices & Maintenance</a>
</li>
<li class="last">
<a href="/personal/deposits/bank-with-ease/update-particulars?pid=sg-dbs-pweb-footer-default-update-particulars-textlink" target="_self">Update Personal Particulars</a>
</li>
</ul>
</div>
<div class="col-md-3 col-sm-3 col-xs-12">
<h4>Need Help?</h4>
<ul class="clearfix">
<li><p><a style="font-weight: 500;" href="http://www.dbs.com.sg/personal/support/home.html?pid=sg-dbs-pweb-footer-default-help-support-textlink" target="_blank">Help &amp; Support Portal</a></p>
<p style="font-weight: 400;">Phone - <a style="font-size: 14px;" href="tel:18001111111">1800 111 1111</a></p></li>
</ul>
</div>
<div class="col-md-3 col-sm-3 col-xs-12 pull-right">
<h4>Country</h4>
<div class="country-box mTop-16">
<div class="row hidden-sm hidden-md hidden-lg">
<div class="col-xs-6">
<a aria-controls="countryList" aria-expanded="false" href="#countryList" data-toggle="collapse" role="button" class="hidden-sm hidden-md hidden-lg" id="btnCountryList">Singapore<span class="icon ico-arrowdown1 icon-animate"></span></a>
</div>
<div class="clearfix"></div>
</div>
<div id="countryList" class="collapse">
<ul class="country-list">
<li class="active">
<a target="_blank">Singapore</a>
</li>
<li>
<a href="http://www.dbs.com.cn/index/default.page" target="_blank">China</a>
</li>
<li>
<a href="http://www.dbs.com.hk/index/default.page" target="_blank">Hong Kong</a>
</li>
<li>
<a href="http://www.dbs.com/in/index/default.page" target="_blank">India</a>
</li>
<li>
<a href="http://www.dbs.com/id/index/default.page" target="_blank">Indonesia</a>
</li>
<li class="last">
<a href="http://www.dbs.com.tw/index/default.page" target="_blank">Taiwan</a>
</li>
</ul>
</div>
</div>
</div>
</div>
</footer>
</div>
<div class="" id="global-footer"><!--component-1489849583268--><footer class="footer footer-gray secondary">
<div class="footer-content">
<div class="footer-links ">
<div class="col-md-9 col-sm-12 col-xs-12">
<ul class="none">
<li>
<a href="http://www.dbs.com/terms/default.page" target="_blank" ops="Terms &amp; Conditions">Terms & Conditions</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com/privacy/default.page" target="_blank" ops="Privacy Policy">Privacy Policy</a><span>|</span>
</li>
<li>
<a href="http://www.dbs.com/fairdealing/default.page" target="_blank" ops="Fair Dealing Commitment">Fair Dealing Commitment</a><span>|</span>
</li>
<li>
<a href="/personal/compliance-tax-requirements/index.html" target="_blank" ops="Compliance with Tax Requirements">Compliance with Tax Requirements</a>
</li>
</ul>
<div class="clearfix"></div>
<ul class="none">
<li>&copy;2017 DBS Bank Ltd<span>|</span>
</li>
<li>Co. Reg. No. 196800306E</li>
</ul>
</div>
<div class="col-md-3 col-sm-12 col-xs-12">
<div class="footer-social-box mobMTop-32 mobMBot-8">
<ul>
<li>
<a href="http://www.youtube.com/user/DBS/feed" target="_blank"><span class="icon ico-youtube"></span></a>
</li>
<li>
<a href="http://www.linkedin.com/company/dbs-bank" target="_blank"><span class="icon ico-linkedin"></span></a>
</li>
<li>
<a href="http://twitter.com/dbsbank" target="_blank"><span class="icon ico-twitter"></span></a>
</li>
<li class="mRight-0">
<a href="http://www.facebook.com/dbs" target="_blank"><span class="icon ico-facebook"></span></a>
</li>
</ul>
</div>
</div><script src="/iwov-resources/scripts/flp/aa-digitalData.js" type="text/javascript" language="JavaScript"></script>
<script src="/iwov-resources/scripts/flp/aa-site-catalyst.js" type="text/javascript" language="JavaScript"></script>
<script type="text/javascript">_satellite.pageBottom();</script>
</div>
</div>
</footer><script type="text/javascript">
			var addthis_config = addthis_config||{};
			addthis_config.data_track_addressbar = false;
			addthis_config.data_track_clickback = false;
		</script>
<div></div>
</div>
</div>
</div></body><!--</html>-->
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

$b = explode('<tr name=', $a);
array_shift($b);
$rates['SGD'] = Array('Currency' => 'Singapore Dollar', 'Rate' => 1);
foreach ($b as $key => $val) {
	$c = explode('<span>', $val);
	$c = explode('</span>', $c[1]);
	$c = $c[0]; // Currency
	$d = explode('data-before-text="Selling TT/OD" class="column3 align-right">', $val);
	$d = explode('</td>', $d[1]); // Rate
	$rate = $d[0];
	$u = explode('data-before-text="Unit" class="column2 align-right fx-unit">', $val);
	$u = explode('</td>', $u[1]); // Unit
	$unit = $u[0];
	if ($unit <> 1) $rate /= $unit;
	$e = array_search($c, $currencies); // CurrCode
	if ($rate > 0) $rates[$e] = Array('Currency' => $c, 'Rate' => $rate);
}

// echo print_r($rates,true);
// exit;

if ($tsvlist) {
	$tsv = '';
	foreach ($rates as $key => $val) {
		if ($rates[$bcurrency]['Rate'] > 0) {
			$rate = $rates[$key]['Rate'];
			if ($bcurrency != 'SGD') $rate /= $rates[$bcurrency]['Rate'];
			// Ref: http://stackoverflow.com/questions/10916675/display-float-value-w-o-scientific-notation
			$tsv .= $key . "\t" . $currencies[$key] . "\t" . rtrim(sprintf('%.10F', $rate), '0') . "\n";
		}
	}
	echo $tsv;
} else {
	if ($rates[$bcurrency]['Rate'] > 0) {
		$rate = $rates[$currency]['Rate'];
		if ($bcurrency != 'SGD') $rate /= $rates[$bcurrency]['Rate'];
		echo $rate;
	}
}

?>
