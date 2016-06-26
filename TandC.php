<?php
/*
// Program      : Example code to place defined constants in a PHP String.
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2016-06-26
// Reference    : http://stackoverflow.com/questions/2203943/include-constant-in-string-without-concatenating
*/

$constant = 'constant'; // very essential - do not change

define("SITE_NAME", "<b>github.com/apmuthu</b>");
define("SITE_SLOGAN", "<b>apmuthu on GitHub</b>");
define('PRINCIPAL', '<b>Ap.Muthu codes</b>');

// usage in string:
// {$constant('SITE_NAME')}
// {$constant('SITE_SLOGAN')}
// {$constant('PRINCIPAL')}

// Example String having Terms and Conditions for a website.

$a = "
<h3>Terms and Conditions</h3>

Welcome to our website {$constant('SITE_NAME')}. If you continue to browse and use this website, you are agreeing to comply with and be bound by the following terms and conditions of use. If you disagree with any part of these terms and conditions, please do not use our website.<br>
<br>
The term {$constant('SITE_SLOGAN')} or <b>we</b> or <b>us</b> or <b>our</b> refers to the owner of {$constant('SITE_NAME')} website.<br>
The term <b>you</b> or <b>your</b> or <b>their</b> refers to the user or viewer of our website.<br>
The term <b>{$constant('PRINCIPAL')}</b> refers to the {$constant('PRINCIPAL')} and its Application.<br>
<br>
The use of this website is subject to the following terms of use:
<ul>
  <li>    Our website {$constant('SITE_NAME')} <b><u>IS NOT</u></b> a part of the official {$constant('PRINCIPAL')} website. {$constant('SITE_NAME')} was made to provide you the information regarding {$constant('PRINCIPAL')} template customizations, tips and tricks, and the other useful resources that related to the {$constant('PRINCIPAL')} application.
  <li>    In order to read the full articles in our site, then you have to register your account based on the certain membership you may choose. Please read our Membership Options for further information.
  <li>    There is no refund policy in our site. However, you may cancel or end your membership anytime you want by simply choosing the third option (Unsubscribe button) from our Membership Options page.
  <li>    Our website uses cookies to monitor browsing preferences. A cookie is a string of information that a website stores on a visitor’s computer to help us identify and track visitors, their usage of our website, and their website access preferences. The following personal information may be stored by us for use by third parties: Your username and a double-hashed copy of your password.
  <li>    Neither we nor any third parties provide any warranty or guarantee as to the accuracy, timeliness, performance, completeness or suitability of the information and materials found or offered on this website for any particular purpose. You acknowledge that such information and materials may contain inaccuracies or errors and we expressly exclude liability for any such inaccuracies or errors to the fullest extent permitted by law.
  <li>    Your use of any information or materials on this website is entirely at your own risk, for which we shall not be liable. It shall be your own responsibility to ensure that any products, services or information available through this website meet your specific requirements.
  <li>    This website contains material which is owned by or licensed to us. This material includes, but is not limited to, the design, layout, look, appearance and graphics. Reproduction is prohibited other than in accordance with the copyright notice, which forms part of these terms and conditions.
  <li>    Some of the content of this site contains modification that involving or depending on the extension files. We do not provide you the complete extension files that used by {$constant('PRINCIPAL')} product. Just like the {$constant('PRINCIPAL')} product,the extension files are something that you have to buy from the official {$constant('PRINCIPAL')} website. We assume that you are the registered users of {$constant('PRINCIPAL')} application, so that you will automatically get the extension files.
  <li>    You are strictly forbidden to copy the contents of this site to the other sites. You are also strictly forbidden to publish the source code contained within each article to others. The content of the pages of this website is for your personal information and use only.
  <li>    All trademarks reproduced in this website, which are not the property of, or licensed to the operator, are acknowledged on the website.
  <li>    Unauthorised use of this website may give rise to a claim for damages and/or be a criminal offence.
  <li>    From time to time, this website may also include links to other websites. These links are provided for your convenience to provide further information. They do not signify that we endorse the website(s). We have no responsibility for the content of the linked website(s).
</ul>
";

echo $a;
?>
