<?php
/*
    Purpose: Use wget as shell command (in windows too) in PHP
    Author : Ap.Muthu <apmuthu@usa.net>
    Release: 2020-04-26
    Usage  : print_r(shell_exec('dir')); // for windows
    Notes  : Take wget from https://eternallybored.org/misc/wget/ and place in same folder
             try exec instead of shell_exec if it does not work
    Output : file is saved on disk
*/

shell_exec('wget -O "./myfile.html" --no-check-certificate https://www.example.com/sample.php');
echo "Done";

/*
print_r(shell_exec('dir'));


 Volume in drive D has no label.
 Volume Serial Number is 5487-5F8D

 Directory of D:\xampp\htdocs\doclinks

04/26/2020  04:15 PM    <DIR>          .
04/26/2020  04:15 PM    <DIR>          ..
04/26/2020  03:58 PM                82 GetDocLinks.URL
04/26/2020  04:13 PM               980 php_wget.php
01/23/2018  08:34 PM         3,895,184 wget.exe
               3 File(s)      3,896,246 bytes
               2 Dir(s)      115,980,288 bytes free
*/
?>