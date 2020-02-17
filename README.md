# phpprojects - Ap.Muthu's PHP Snippets

* `Aadhar` - PHP Class, Non-Class and JS Validation of 12 digit Aadhar Number
* `AjaxDropDownSelect` - Ajax and JS based cascading dropdown select box
* `AjaxRealTimeGraph` - PHP based Real Time Plot of sensor values acquired using Ajax
* `PHPFormToDBonce` - One time update of record using random hash from a field in record
* `PHPProgressMonitor` - Monitor progress of execution of a long running php script with examples
* `phpHitCounter` - Implements a single webpage hit counter for a single file or set of files
* `SpriteCSSImages` - Deploy several images from single Sprite Image using CSS. Use in counter digits display.
* `LangUtils` - GetText manipulation scripts for rapid translations
* `LimeSurveyQAImport` - SQLs generated to import List Radio Questions and Answers from Formatted Text file into LimeSurvey v2.051's DB
* `MSAccessInPHP/mdbtest.php` - Illustrates the usage of MSAccess MDB file in PHP on Windows
* `OrangeHRMutils` - External and internal bridges to OrangeHRM's Free Open Source Edition
* `PHPINICompare` - Compare **php.ini** files across servers
* `phpRFT` - PHP Remote File Transfer
* `SubnetMaskcalc` - Subnet Mask Calculator by [subnetmask.info](http://www.subnetmask.info)
* `translation` - [Easy PHP Site Translation](http://tympanus.net/codrops/2009/12/30/easy-php-site-translation/) class
* `unixtime/unix_time.html` - Epoch Convertor from [Online Conversion](http://www.onlineconversion.com) | [Demo](https://rawgit.com/apmuthu/phpprojects/master/unixtime/unix_time.html) | [Production](https://cdn.rawgit.com/apmuthu/phpprojects/master/unixtime/unix_time.html)
* `cplusplus` - C++ tutorial examples
* `clean_csv_quote_strings.php` - Strips line feeds in quoted strings
* `data_in_php` - Store, retrieve, include and execute data at the end of a php file
* `docgenerator` - Generates a sample contractual agreement with data from a html form. Generate Disclaimer.
* `display_paged.php` - Display a paged set of records from a MySQL table
* `domtute.php` - PHP syntax for DOMDocument across PHP versions to treat searched objects as arrays
* `jsDynaField` - [jQuery](https://jquery.org/) based Dynamic Form Field Addition
* `oct_repl.php` - Octal to ASCII string replacer
* `opensslver.php` - OpenSSL version checker - useful for checking if TLS alone is enabled
* `pdfoverlay` - Generate an overlaid PDF populating a template PDF file using data from a database
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
* `ip2isp_tsv.php` - Lookup the owner ISP of an array of IPs from https://ipinfo.io (free 1000 lookups per day per IP)
* `perm.php` - Set folders to 755 and files to 644 permissions recursively
* `PortReDirect.html` - Redirects from Port 80 to any other port without port forwarding - plain HTML and JS only
* `UnixTS2DateTS.php` - Convert Unix Timestamp to Readable Date Format in PHP
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

### PHP CLI
* `php_is_cli.php` - Checks if called from PHP CLI, obtains local server IP
* `php_cli_param_usage.php` - Various ways to pass on parameters into a PHP script for CLI usage
* `php_cli_console_input.php` - Get user input from console into PHP variable

### Forex Parsers
* `dbs_xchg_rate.php` - Get Exchange Rate from DBS Bank in Singapore Dollars
* `Bloomberg_Rates.php` - Get currency exchange rate from Bloomberg
* `fxratenet_rates.php` - Get currency exchange rate from fx-rate.net
* `XE/xe_xchg_rate.php` - Get all From/To exchange rates from [XE](http://www.xe.com)
* `x-rates/x-rates.php` - Get 1 USD Exchange Rate of 53 Currencies from [x-rates](https://www.x-rates.com)
* `rbi_inr_rates.php` - Get latest Reserve Bank of India (RBI) Forex rates in INR

### Format Parsers
* `ExtractOptions.php` - HTML select box options string to array
* `HTML2Links.php` - Extract all unique filtered URLs with their display values from XML / HTML content
* `parse_word.php` - Extract text from Word documents
* `ParseSQLstr.php` - Parse SELECT columns of any SQL string without connecting to DB
* `xml2tsv` - Convert XML to TSV (Tab Separated Values)
* `youtube2srt.php` - Convert YouTube Transcript page text into subtitle .srt format

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

### PHP debugging by append marker (AA here) to log file
````
$a = file_put_contents('./logs.txt', date('Y-m-d ')."AA".PHP_EOL , FILE_APPEND | LOCK_EX);
````

### MySQL get first 2 bytes of IPv4
````
INET_NTOA(INET_ATON( <IPField> ) & 0xFFFF0000)
````

### MySQL move table
````
ALTER TABLE my_old_db.mytable RENAME my_new_db.mytable;
````

### MySQL NULL / Zero (0) Substitutions
````
COALESCE( expression, 'a substitute for NULL' ) -- NULL only
COALESCE( NULLIF( expression, 0 ), 'a substitute for Zero' ) -- Zero only
IFNULL( NULLIF( expression, 0 ), 'a substitute for NULL or Zero') -- NULL or Zero
````

### MySQL split email addresses
````
SELECT SUBSTR(MailID, 1, INSTR(MailID, '@') -1) FROM `users`; -- username
SELECT (SUBSTRING_INDEX(SUBSTR(MailID, INSTR(MailID, '@') +1),'.',1)) FROM `users`; -- domain first part
````

### MySQL default CURRENT DATE for default NULL date field `dtable.query_date` using trigger
````
USE `ddb`;
DELIMITER $$
CREATE TRIGGER `default_date` BEFORE INSERT ON `dtable` FOR EACH ROW
if ( isnull(new.query_date) ) then
 set new.query_date=curdate();
end if;
$$
delimiter ;
````

### Bash extract unique IPv4 addresses from `log.txt` and store in `new.txt`
````
grep -o '[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}\.[0-9]\{1,3\}' log.txt | sort -u > new.txt
````

### Windows GETMAC
````
getmac -v -fo list
````

### Excel [Reverse Concatenate](https://www.extendoffice.com/documents/excel/3278-excel-reverse-concatenate.html)
````
=TRIM(MID(SUBSTITUTE($A2,",",REPT(" ",999)),COLUMNS($A:A)*999-998,999))
````

