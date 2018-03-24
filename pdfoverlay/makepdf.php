<?php
// id argument holds Document ID
// All strings must be devoid of unescaped double quotes.

/*
CREATE TABLE `documents` (
  `DocID` int(11) NOT NULL AUTO_INCREMENT,
  `PersonName` varchar(60) NOT NULL,
  `Mobile` varchar(16) NOT NULL DEFAULT '',
  `Ready` tinyint(1) NOT NULL DEFAULT '0',
  `HashCode` char(5),
  PRIMARY KEY (`DocID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO `documents`(`DocID`,`PersonName`,`Mobile`,`Ready`,`HashCode`) VALUES 
  ( '5','Mr. John Doe','+91-9856589856','1','12345');
*/

$DocID = 0;
$makepdf_debug = false;

if (isset($_REQUEST['id']) && $_REQUEST['id']+0 > 0) { 

//	include "dbconnect.php";
	$link = mysqli_connect('localhost', 'root', '', 'example_db');

	$DocID = $_REQUEST['id']+0;
	$sql = "SELECT * FROM documents WHERE DocID=$DocID";

	$result = mysqli_query($link, $sql);
	if ($result === false) die ("No document record");
	$doc_data = mysqli_fetch_assoc($result);
	extract($doc_data);

} else {

	$makepdf_debug = true; // future use

	// Get each field value to be populated in the output PDF file
	$DocID      = 5;
	$PersonName = 'Mr. John Doe';
	$Mobile     = '+91-9856589856';
	$Ready      = 1;
	$HashCode   = 12345;
}

require_once('pdflibs/php-barcode.php');
require_once('pdflibs/fpdf.php');
require_once('pdflibs/fpdi.php');

/*
// ======
// code placed in fpdf.php file
  class eFPDF extends FPDI{
	var $h; // avoids protected variable error from fpdf
	var $k; // avoids protected variable error from fpdf
    function TextWithRotation($x, $y, $txt, $txt_angle, $font_angle=0)
    {
        $font_angle+=90+$txt_angle;
        $txt_angle*=M_PI/180;
        $font_angle*=M_PI/180;
    
        $txt_dx=cos($txt_angle);
        $txt_dy=sin($txt_angle);
        $font_dx=cos($font_angle);
        $font_dy=sin($font_angle);
    
        $s=sprintf('BT %.2F %.2F %.2F %.2F %.2F %.2F Tm (%s) Tj ET',$txt_dx,$txt_dy,$font_dx,$font_dy,$x*$this->k,($this->h-$y)*$this->k,$this->_escape($txt));
        if ($this->ColorFlag)
            $s='q '.$this->TextColor.' '.$s.' Q';
        $this->_out($s);
    }
  }
// ======

$pdf = new eFPDF();
*/

$pdf = new FPDI();


$pdf->SetAuthor("Ap.Muthu");
$pdf->SetCreator("http://www.MnMServe.com");
$pdf->SetTitle("PDF Overlay Example");

// Use PDF v1.4 or v1.5 with no encryption for free fpdi library
$pageCount = $pdf->setSourceFile('PDFTemplate.pdf');
$tplIdx  = $pdf->importPage(1, '/MediaBox');

// $pageCount = $pdf->setSourceFile('SecondFile.pdf');
// $tplIdx2 = $pdf->importPage(1, '/MediaBox');

$pdf->addPage();
$pdf->useTemplate($tplIdx, 0, 0, 210); // A4 width is 210 mm in Portrait mode

// Set font
$pdf->SetFont('Arial','B',8);


$pdf->SetY(32);
$pdf->SetX(98);
$pdf->Cell(0, 8, $DocID, 0, 1);
// Cell(float w [, float h [, string txt [, mixed border [, int ln [, string align [, boolean fill [, mixed link]]]]]]])
$pdf->SetY(37);
$pdf->SetX(98);
$pdf->Cell(0, 8, $PersonName, 0, 1);
$pdf->SetY(42);
$pdf->SetX(98);
$pdf->Cell(0, 8, $Mobile);

$pdf->Ln();
$a = $pdf->GetY()-2;
// Image(string file [, float x [, float y [, float w [, float h [, string type [, mixed link]]]]]])

if (isset($Ready) && $Ready == 1) {
	$pdf->Image('tickmark.png', 98, $a, 4, 4);
}

// ============
  $fontSize = 10;
  $marge    = -5;   // between barcode and hri in pixel
  $x        = 105;  // barcode center
  $y        = 275;  // barcode center
  $height   = 10;   // barcode height in 1D ; module size in 2D
  $width    = 0.5;    // barcode width in 1D ; not used in 2D
  $angle    = 0;   // rotation in degrees
  
  $code     = "$Hash-$DocID"; // barcode, of course ;)
//  $type     = 'ean13'; // $code must have 12 digits for ean13
//  $type     = 'code128'; // $code must not have spaces or underscores
  $type     = 'code39'; // $code must not have spaces or underscores
  $black    = '000000'; // color in hexa

  $data = Barcode::fpdf($pdf, $black, $x, $y, $angle, $type, array('code'=>$code), $width, $height);

  $pdf->SetTextColor(0, 0, 0);
  $len_a = $pdf->GetStringWidth($data['hri']);
  Barcode::rotate(-$len_a / 2, ($data['height'] / 2) + $fontSize + $marge, $angle, $xt, $yt);
  // The following method is in the modified fpdf.php file
  $pdf->TextWithRotation($x + $xt, $y + $yt, $data['hri'], $angle);

// ============

// $pdf->addPage();
// $pdf->useTemplate($tplIdx2, 0, 0, 210);

$ts_string = date('YmdHis');
$pdf_name = 'Example_'.$DocID.'_'.$ts_string.'.pdf';
$pdf->Output('I', $pdf_name);
?>
