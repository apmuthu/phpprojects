<HTML><HEAD><TITLE>PHP Source code viewer 
<?php 
/*
This index file will create a browsable PHP code repository with syntax highlighting and optional line numbers
from any directory placed beneath it.
To install..
1. Create a directory such as "source" within your website.
2. Upload this file  to your new "source" directory as ASCII/plain text and name it "index.php".
3. Create a "Project" directory within the "source" directory and upload your source code to it.
   Name your Project directory anything you'd like, eg; "dew-newphplinks-2010b-SEF"
4. Browse to your new "source" directory with a web browser.

This is an open source GPL script You are free to alter it however you like and give your
new version away. I only require you to leave the powered by link intact, and please consider leaving
1 or more of the banner ads in place. They are the only source of revenue I get from this script

Thanks,
Dewed
http://www.dew-code.com
*/
$version ="Dew-Code's PHP Source Code Viewer 1.2 ";
if ($_GET["filename"]){echo $_GET["filename"];} 
?>
</TITLE>
<style type="text/css">
body {font: "Courier New", Courier, monospace; background:#F0F0F0; color: #000000; font-size: 12px;}
.code_cell {border: medium groove; padding: 12x;}
ol  {padding: -18px;}
ol li {padding: 8px;}

.nav_cell {border: medium groove; padding: 12px; background:#D0D0D0;}
.anav {padding: 12px; text-align: right; font-family: Verdana, Geneva, Arial, sans-serif; background:#E0E0E0}
.heading {background: #000000; padding: 2px; text-align: center; color: White; font-weight: bold; font-family: Verdana, Geneva, Arial, Helvetica, sans-serif; font-size: smaller;}
hr {border: thin;}
</style>
</HEAD><BODY>

<hr><div align=right>
<?php 
if(empty($_GET["filename"])){$anav= "<a href=/source/>PHP Source Code Viewer</a> :: ";
    if (empty($_GET["g"])){$anav .= "<a href=./?g=1>Show graphics</a>";}
    else {if ($_GET["g"] !=2){$anav .= "<a href=./?g=2>Really &quot;show&quot; graphics!</a> :: ";}
$anav .='<a href=./?>Hide graphics</a>';
}

$anav .=" :: <a href=/>Home</a> :: <a href=./?about=source>?</a> &nbsp;&nbsp;</div><table width=\"99%\"><tr><td class=\"code_cell\">";
echo $anav;
if(!empty($_GET["about"])){
// if you want to customize the about page, pleas echo it 
// here, and leave this script's info intact beneath your own
// echo "<blockquote><h4>Custom about heading </h4> custom text...  <hr></blockquote>"
// you could also just leave PHP mode and put in plain HTML like this

/* ?> <h3> My about page</h3><blockquote>My about text</blockquote> <?php */

echo"<blockquote><h3>About ". $version ."</h3>". $version ." is a free* php source code viewer, released as GPL, aka open source <br> It instantly creates a web based PHP code archive from any sub directories placed beneath it.<br> <ul><b>Some potential uses.</b>
<li>Developers can quickly reference other sections of large projects.</li> <li>Create an online code snippet library.</li> <li>Use in conjunction with CVS or other version control software.</li> </ul> <ul> <b>Features include</b></br> <li>Simple to install. Nothing to do but
upload one file, and upload the source you want to display.</li> <li>Displays php and html source.</li> <li>Easily add file types as needed. Just copy an examlple line and correct the file extension</li> <li>PHP source is syntax highlighted.</li> <li>Display graphic files
options, including inline</li> <li>Display line numbers option.</li> <li>Secure. Only files stored in directories beneath it can be viewed.</li></ul> You'll find the latest version of this PHP Source Code Viewer at <a href=http://www.dew-code.com>Dew-Code.com</a> on the
Downloads page.</blockquote><br> <i>*= free to modify to suit your needs and taste and free to give your new version away.<br> My only request is to leave the powered by link intact, and consider leaving 1 or more of my banner ads in place.</i> <hr>";}


function getDirList ($dirName) {
$d = dir($dirName);
while($entry = $d->read()) {
if ($entry != "." && $entry != "..") {
if (is_dir($dirName."/".$entry)) {
getDirList($dirName."/".$entry);
} else {
if (
    (ereg('\.php$', $entry))
    && 
    (!ereg('index\.php$', $entry))
){    
echo "<a href=./?filename=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";
}

// If you need to list a file with odd name or no extension , just add an ereg line for it  'blah$' denotes ends with blah
if (ereg('directory$', $entry)){echo "<a href=./?filename=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";}


// You can also list other file extension like this
//if (ereg('\.log$', $entry)){echo "<a href=./?filename=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";}
//if (ereg('\.txt$', $entry)){echo "<a href=./?filename=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";}

if (ereg('\.html$', $entry)){echo "<a href=./?filename=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";}


if(!empty($_GET["g"])){
// you can list other graphic types like this.
//if (eregi('\.BMP$', $entry)){echo $linkto ."=".$dirName."/".$entry.">".$dirName."/".$entry."</a><br>\n";}

if($_GET["g"]<2){$linkto = "<a target=_blank href"; $linkend = "</a>";}
if($_GET["g"]>1){$linkto = "<img align=middle src";$linkend = "";}
if (eregi('\.jpg$', $entry)){echo $linkto ."=".$dirName."/".$entry.">".$dirName."/".$entry.$linkend ."<br>\n";}
if (eregi('\.gif$', $entry)){echo $linkto ."=".$dirName."/".$entry.">".$dirName."/".$entry.$linkend ."<br>\n";}
if (eregi('\.ico$', $entry)){echo $linkto ."=".$dirName."/".$entry.">".$dirName."/".$entry.$linkend."<br>\n";}
if (eregi('\.png$', $entry)){echo $linkto ."=".$dirName."/".$entry.">".$dirName."/".$entry.$linkend."<br>\n";}
}

}
}
}
$d->close();
}
getDirList(".");
echo "</td><td width=\"161\"0 align=center valign=top class=anav> <p> <br></p>";

echo "<br><br>
</td></tr></table>";
}
else {
echo "</div>";
$filename=$_GET["filename"];
$filename = ereg_replace('\.\.','', $filename);
$filename = ereg_replace('\./','', $filename);
// $file = "./". $filename;
 $content = highlight_file("./". $filename, TRUE);
    $Lines = substr_count($content, "<br />") + 1;
    $SizeofFile = number_format(filesize("./".$file), 0, ' ', ' ');
    $lastModified = date( "F d Y H:i:s.", filemtime("./".$file));
    echo "<div class=anav>
<a href=/source/>PHP Source Code Viewer</a> :: ";
    if (empty($_GET["ln"])){ echo "<a href=./?filename=". $filename."&ln=1>Show line #s</a>";}
        else 
    {echo "<a href=./?filename=". $filename.">Hide line #s</a>";}
echo " :: <a href=/>Home</a> :: <a href=./?about=source>?</a></div><div class=heading>", $filename, " has ", $Lines, " lines, size is ", $SizeofFile, " bytes, last modified on ", $lastModified, "</div>
<table width=\"100%\"><tr><td width=\"90%\" class=code_cell  valign=top> ";
if ($_GET["ln"]){$content =ereg_replace("<br />", "</code></li><li><code>", $content);}
if ($_GET["ln"]){echo "<ol><li>";} else {echo "\n <br>";}
    print_r ($content);
if ($_GET["ln"]){echo "</ol>";} else {echo "\n ";}
echo "</td><td width=\"130\" valign=top align=center class=nav_cell> <br>

</td></tr></table>";
}
?> 
<center>
<br>
</center>
<div class=anav><a href=#top> TOP </a> :: <a href=./?>PHP Source Code Viewer</a>&nbsp; &nbsp; &nbsp; &nbsp; Powered by <a target=_blank href=http://www.dew-code.com/><?php echo $version;?></a></div>
</BODY> </HTML>