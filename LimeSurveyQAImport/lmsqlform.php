<?php
/*
// Program       : LimeSurvey Txt to SQL Import of List Radio Questions and Answers
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2016-08-13
// Example Usage : http://DOMAIN.TLD/LIMESURVEY_PATH/lmsqlform.php
// Usage Notes   : The output SQLs generated can be executed on the LimeSurvey Database
*/

$lf = chr(10);
$brlf = '<br>' . $lf;

include 'ls_link.php';
$dbvals = get_max_ls_db_values();
$db_html = "<table border='1'><tr><th>QPfx</th><th>QSfxLen</th><th>QSfxMin</th><th>QSfxMax</th></tr>$lf";

foreach ($dbvals as $row) {
	$db_html .= "<tr><td>$row[QPfx]</td><td>$row[QSfxLen]</td><td>$row[QSfxMin]</td><td>$row[QSfxMax]</td></tr>$lf"; 
}
$db_html .= "</table>$lf";

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<title>LM SQLs Form</title>
<meta name="author" content="Ap.Muthu">
<meta name="generator" content="www.MnMserve.com">
<style type="text/css">
body
{
   background-color: #FFFFFF;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
   margin: 0;
   padding: 0;
}
</style>
<style type="text/css">
a
{
   color: #0000FF;
   text-decoration: underline;
}
a:visited
{
   color: #800080;
}
a:active
{
   color: #FF0000;
}
a:hover
{
   color: #0000FF;
   text-decoration: underline;
}
</style>
<style type="text/css">
#wb_LMSQLsForm
{
   background-color: #FAFAFA;
   border: 0px #000000 solid;
}
#wb_Text1 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: center;
}
#wb_Text1 div
{
   text-align: center;
}
#Table1
{
   border: 2px #C0C0C0 solid;
   background-color: transparent;
   border-spacing: 1px;
}
#Table1 td
{
   padding: 0px 0px 0px 0px;
}
#Table1 td div
{
   white-space: nowrap;
}
#wb_Text2 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text2 div
{
   text-align: left;
}
#Editbox1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   padding: 0px 0px 0px 2px;
   text-align: left;
   vertical-align: middle;
}
#FileUpload1
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color: #000000;
   font-family:Arial;
   font-size: 13px;
}
#Editbox2
{
   border: 1px #A9A9A9 solid;
   background-color: #FFFFFF;
   color :#000000;
   font-family: Arial;
   font-size: 13px;
   padding: 0px 0px 0px 2px;
   text-align: left;
   vertical-align: middle;
}
#Button1
{
   border: 1px #A9A9A9 solid;
   background-color: #F0F0F0;
   color: #000000;
   font-family: Arial;
   font-size: 13px;
}
#wb_Text3 
{
   background-color: transparent;
   border: 0px #000000 solid;
   padding: 0;
   text-align: left;
}
#wb_Text3 div
{
   text-align: left;
}
</style>
<script type="text/javascript">
function ValidateLMSQLsForm(theForm)
{
   var regexp;
   regexp = /^[A-Za-zÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýþÿ]*$/;
   if (!regexp.test(theForm.Editbox1.value))
   {
      alert("Enter an existing Question Title Prefix or a new one");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value == "")
   {
      alert("Enter an existing Question Title Prefix or a new one");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length < 2)
   {
      alert("Enter an existing Question Title Prefix or a new one");
      theForm.Editbox1.focus();
      return false;
   }
   if (theForm.Editbox1.value.length > 4)
   {
      alert("Enter an existing Question Title Prefix or a new one");
      theForm.Editbox1.focus();
      return false;
   }
   var extension = theForm.FileUpload1.value.substr(theForm.FileUpload1.value.lastIndexOf('.'));
   if ((extension.toLowerCase() != ".txt") &&
       (extension != ""))
   {
      alert("The \"QAFile\" field contains an unapproved filename.");
      theForm.FileUpload1.focus();
      return false;
   }
   regexp = /^[-+]?\d*\.?\d*$/;
   if (!regexp.test(theForm.Editbox2.value))
   {
      alert("Please enter only digit characters in the \"QTSfx\" field.");
      theForm.Editbox2.focus();
      return false;
   }
   if (theForm.Editbox2.value != "" && !(theForm.Editbox2.value > 1 && theForm.Editbox2.value < 18))
   {
      alert("Please enter a value greater than \"1\" and less than \"18\" in the \"QTSfx\" field.");
      theForm.Editbox2.focus();
      return false;
   }
   return true;
}
</script>
</head>
<body>
<div id="wb_LMSQLsForm" style="position:absolute;left:19px;top:14px;width:503px;height:557px;z-index:9;">
<form name="LMSQLsForm" method="post" action="get_lm_sqls.php" enctype="multipart/form-data" id="LMSQLsForm" onsubmit="return ValidateLMSQLsForm(this)">
<div id="wb_Text1" style="position:absolute;left:114px;top:19px;width:280px;height:24px;text-align:center;z-index:0;">
<span style="color:#0000FF;font-family:Arial;font-size:21px;">LimeSurvey QA SQLs Form</span></div>
<table style="position:absolute;left:31px;top:121px;width:455px;height:143px;z-index:1;" cellpadding="0" cellspacing="1" id="Table1">
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:middle;width:180px;height:30px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> Question Title Prefix</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:30px;">&nbsp;</td>
</tr>
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:middle;width:180px;height:30px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> Q and A Input File (<strong>.txt</strong> file)</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:30px;">&nbsp;</td>
</tr>
<tr>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:middle;width:180px;height:34px;"><div><span style="color:#000000;font-family:Arial;font-size:13px;"> Title Numeric Suffix Length</span></div>
</td>
<td style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:34px;">&nbsp;</td>
</tr>
<tr>
<td colspan="2" style="background-color:transparent;border:1px #C0C0C0 solid;text-align:left;vertical-align:top;height:32px;"><div><span style="color:#000000;font-family:Arial;font-size:16px;">&nbsp; </span></div>
</td>
</tr>
</table>
<div id="wb_Text2" style="position:absolute;left:32px;top:59px;width:452px;height:48px;z-index:2;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">This form outputs the necessary SQLs needed to acquire the questions and answers of a Lime Survey Radio List type and choices where the first one is the correct answer. <a href="SampleQuestions.txt" target="_blank">Formatted Sample Q and A File</a></span></div>
<input type="text" id="Editbox1" style="position:absolute;left:230px;top:129px;width:92px;height:19px;line-height:19px;z-index:3;" name="QTPfx" value="" maxlength="4">
<input type="file" id="FileUpload1" style="position:absolute;left:230px;top:162px;width:230px;height:21px;z-index:4;" name="QAFile">
<input type="text" id="Editbox2" style="position:absolute;left:230px;top:195px;width:30px;height:19px;line-height:19px;z-index:5;" name="QTSfx" value="3" maxlength="2" placeholder="Enter a numeric suffix for question title">
<input type="submit" id="Button1" name="QLMbutton" value="Get LM SQLs" style="position:absolute;left:230px;top:231px;width:96px;height:25px;z-index:6;">
<!-- Existing Question Titles Info -->
<div id="Html1" style="position:absolute;overflow:scroll;left:31px;top:303px;width:452px;height:233px;z-index:7">
<?php echo $db_html; ?>
</div>
<div id="wb_Text3" style="position:absolute;left:30px;top:285px;width:294px;height:16px;z-index:8;text-align:left;">
<span style="color:#000000;font-family:Arial;font-size:13px;">Currently available Question Title Prefix details</span></div>
</form>
</div>
</body>
</html>