<?php
/*
// Program        : Generate a DMCA page, setting your site details in the variables below
// Author         : Ap.Muthu <apmuthu@usa.net>
// Version        : 1.0
// Release Date   : 2020-07-19
*/

// Can take $domain from the URL itself automatically
// Ref: https://stackoverflow.com/questions/6768793/get-the-full-url-in-php
// Security Note: The client can set HTTP_HOST and REQUEST_URI to any arbitrary value it wants and hence is not used here

$domain='example.com';
$contact_email = 'dmca@example.com';
$charset = 'iso-8859-1'; // can be utf-8 if other language / UTF8 characters are used
?>
<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo $charset; ?>">
<title>Digital Millenium Copyright Act Policy (DMCA)</title>
</head>

<body bgcolor="#FFFFFF">

<p><span><h1>Digital Millenium Copyright Act Policy (DMCA)</h1></span></p>
<p><span>It is <?php echo $domain; ?>'s policy to respond to clear notices of alleged copyright infringement. If you believe that your intellectual property rights have been infringed upon by one of <?php echo $domain; ?>'s users, <?php echo $domain; ?> needs you to send a proper notification. All notices should comply with the notification requirements of the DMCA. You MUST provide the following information:</span></p>
<div class='code-block code-block-3' style='margin: 8px 0; clear: both;'>
<ol>
<li><span>Identify yourself as either:</span><br />
<span>- The owner of a copyrighted work(s), or</span><br />
<span>- A person "authorized to act on behalf of the owner of an exclusive right that is allegedly infringed."</span></li>
<li><span>Identify the copyrighted work claimed to have been infringed.</span></li>
<li><span>Identify the material that is claimed to be infringing or to be the subject of the infringing activity and that is to be removed or access to which is to be disabled by providing <?php echo $domain; ?> the exact location of the infringing file with the exact <?php echo $domain; ?> link.</span></li>
<li><span>Provide <?php echo $domain; ?> the web address under which the link has been published.</span></li>
<li><span>Provide your contact information, which includes, your full name, address and telephone number.</span></li>
</ol>
<p><span>(For more details on the information required for valid notification, see 17 U.S.C. 512(c)(3).)</span></p>
<p><span>You should be aware that, under the DMCA, claimants who make misrepresentations concerning copyright infringement might be liable for damages incurred as a result of the removal or blocking of the material, court costs, and attorneys fees.</span></p>
<p><span>A proper notification MUST contain the information above, or it may be IGNORED.</span></p>
<p><span>Send notifications to: <em><?php echo $contact_email; ?></em></span></p>
<p><span>Please allow up to two business days for an email response. Thank you for your understanding.</span></p>
</body>
</html>
