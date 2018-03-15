# phpprojects - Ap.Muthu's PHP Snippets

* `AjaxRealTimeGraph` - PHP based Real Time Plot of sensor values acquired using Ajax
* `PHPFormToDBonce` - One time update of record using random hash from a field in record
* `PHPProgressMonitor` - Monitor progress of execution of a long running php script with examples
* `phpHitCounter` - Implements a single webpage hit counter for a single file or set of files
* `SpriteCSSImages` - Deploy several images from single Sprite Image using CSS. Use in counter digits display.
* `LangUtils` - GetText manipulation scripts for rapid translations
* `LimeSurveyQAImport` - SQLs generated to import List Radio Questions and Answers from Formatted Text file into LimeSurvey v2.051's DB
* `MSAccessInPHP/mdbtest.php` - Illustrates the usage of MSAccess MDB file in PHP on Windows
* `OrangeHRMutils` - External and internal bridges to OrangeHRM's Free Open Source Edition
* `SubnetMaskcalc` - Subnet Mask Calculator by [subnetmask.info](http://www.subnetmask.info)
* `translation` - [Easy PHP Site Translation](http://tympanus.net/codrops/2009/12/30/easy-php-site-translation/) class
* `unixtime/unix_time.html` - Epoch Convertor from [Online Conversion](http://www.onlineconversion.com) | [Demo](https://rawgit.com/apmuthu/phpprojects/master/unixtime/unix_time.html) | [Production](https://cdn.rawgit.com/apmuthu/phpprojects/master/unixtime/unix_time.html)
* `cplusplus` - C++ tutorial examples
* `data_in_php` - Store, retrieve, include and execute data at the end of a php file
* `docgenerator` - Generates a sample contractual agreement with data from a html form
* `display_paged.php` - Display a paged set of records from a MySQL table
* `jsDynaField` - [jQuery](https://jquery.org/) based Dynamic Form Field Addition
* `phpGetDomains` - domain_lister.php - Get Insert SQL statements from registrar records at [Daily Changes](http://www.dailychanges.com)
* `php-mysql-functions` - PHP functions for MySQL and Password set/blank bash scripts for MySQL 5.6
* `phpssh2.php` - PHP Tunnel into remote service on localhost
* `phpunzip` - Unzip archives using php by [PHPConcepts](http://www.phpconcept.net)
* `pincodes` - Data Dump of Indian Postal Codes
* `wiki_extract.php` - Extract urls of uploaded files in MediaWiki based Wikis and use with `wget`
* `sql2excel` - php class to convert an sql to an excel worksheet
* `gxlate` - PHP Function for Google Translation of single string without using Google Translate API
* `cidr_match.php` - Check if IPv4 is within subnet range and dynamically get a base URL
* `ip.php` - Obtain your public / private ip
* `iprec.php` - Store your public / private ip in a text file on the server and retrieve at will
* `perm.php` - Set folders to 755 and files to 644 permissions recursively

````
pubip=`wget -qO- http://www.apmuthu.com/ip.php`
````
* `DecryptCSinPHP.php` - decrypt C# in php
* `xlate.php` - Encode / Decode strings / binary in PHP
* `mod_rewrite_test.php` - Advanced mod_rewrite troubleshooting tester
* `PHP_SourceCodeViewer.php` - Place this file in a folder called `source` and name it `index.php` to view source code of all php files under it.
* `phpLuhn.php` - generate and verify credit card checksums
* `var2file.php` - Save a PHP variable in a file for including it in another PHP file.
* `PDFMerger.php` - [Split and Merge PDF](https://pdfmerger.codeplex.com/releases/view/37934) files using [fpdf](http://www.fpdf.org) and [fpdi](https://www.setasign.com/products/fpdi/about/)
* `AjaxJSselect.html` - Javascript based drop down select controlled by another select box
* `TandC.php` - Place defined constants in a PHP String

### Forex Parsers
* `dbs_xchg_rate.php` - Get Exchange Rate from DBS Bank in Singapore Dollars
* `Bloomberg_Rates.php` - Get currency exchange rate from Bloomberg
* `fxratenet_rates.php` - Get currency exchange rate from fx-rate.net
* `XE/xe_xchg_rate.php` - Get all From/To exchange rates from [XE](http://www.xe.com)
* `rbi_inr_rates.php` - Get latest Reserve Bank of India (RBI) Forex rates in INR

### XML and HTML Parsers
* `ExtractOptions.php` - HTML select box options string to array
* `HTML2Links.php` - Extract all unique filtered URLs with their display values from XML / HTML content

### Format Conversion
* Debian to FreeBSD md5 format conversion and comparison in bash
````
# in Debian / Windows GitBash
find . -type f -exec md5sum '{}' \; > ../debian_md5.txt

# in FreeBSD
find . -type f -exec md5 '{}' \; > ../freebsd_md5.txt

awk -F'*' '{ print "MD5 ("$2") = "$1 }' ../debian_md5.txt  | sed 's/\s$//' > ../freebsd_formatted_md5.txt

diff ../freebsd_formatted_md5.txt ../freebsd_md5.txt
````
