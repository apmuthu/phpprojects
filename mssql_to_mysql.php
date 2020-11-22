<?php
/*
// Program      : Converts MS SQL Server sql constructs to MySQL - supports CREATE TABLE and INSERT INTO statements
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2020-11-15
// Usage notes  : Optionally can convert Glyph Fonts to Unicode for the output script
*/

define("TAMILTAB", false);

if (TAMILTAB)
	include_once('Tab2Uni.php'); // https://github.com/apmuthu/phpprojects/blob/master/phpTamilTabUniFont/Tab2Uni.php

$a = <<<EOT
CREATE TABLE [tblPayment (1410104064)] (
	[PaymentId] [numeric](18,0) NULL,
	[PaymentDate] [datetime] NULL,
	[PNo] [numeric](18,0) NULL,
	[PaymentNo] [numeric](18,0) NULL,
	[AccId] [numeric](18,0) NULL,
	[Heading] [nvarchar](450) NULL,
	[Name] [nvarchar](450) NULL,
	[Place] [nvarchar](450) NULL,
	[LedgerId] [numeric](18,2) NULL,
	[Amount] [numeric](18,2) NULL,
	[ChqNo] [nvarchar](450) NULL,
	[Narration] [nvarchar](450) NULL,
	[UserName] [nvarchar](450) NULL,
	[Pasali] [nvarchar](450) NULL,
	[RecStatus] [int] NULL,
	[CAmount] [numeric](18,2) NULL,
	[Recdate] [datetime] NULL,
	[Deduction] [numeric](18,0) NULL,
	[NetAmount] [numeric](18,0) NULL,
	[LedgerGroupId] [numeric](18,0) NULL,
	[ChqType] [nvarchar](450) NULL,
	[ItNarration] [nvarchar](450) NULL,
	[AdjType] [nvarchar](450) NULL
)
GO

INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (19, N'2020-07-13T00:00:00.000', 19, 19, 1, N'', N'BSNL Telephone', N'', 4.00, 7411.00, NULL, N'î¤¼è¢«è£ò¤ô¢ ðòù¢ð£ì¢®ô¢ à÷¢÷ ªî£¬ô«ðê¤ Þ¬íð¢°Àè¢° 6/2020 ñ£î èì¢ìíñ¢ ªê½î¢î¤ò õ¬èò¤ô¢ ðì¢®òô¢ ªî£¬è 26800430=3357,487=1787, 451=1301,880=584,789=382 ñø¢Áñ¢ Þ¬íÝ¬íòó¢ ¬è«ðê¤è¢° èì¢ìíñ¢ ªê½î¢î¤ò õ¬èò¤ô¢ Ï. 277', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 7411, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (53, N'2020-07-30T00:00:00.000', 53, 53, 1, N'', N'your self', N'', 4.00, 91757.00, NULL, N'î¤¼è¢«è£ò¤ô¤ô¢ ðí¤¹ó¤»ñ¢ 36 ðí¤ò£÷ó¢èÀè¢° ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£ ªê½î¢î¤ò õ¬èò¤ô¢ ñø¢Áñ¢ ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£õ¤ø¢° «ê¬õ õó¤ 18% ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 91757, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (54, N'2020-07-30T00:00:00.000', 54, 54, 1, N'', N'ðì¢®òô¢ð®', N'', 4.00, 276600.00, NULL, N'î¤¼.êï¢«î£û¢ = 42500, î¤¼.ªõé¢èì¢= 42500, î¤¼ñî¤.õ£²è¤ = 85000, î¤¼.Ü¼í¢°ñ£ó¢ = 85000 ', N'ADMIN', N'1430', 0, 0.00, NULL, 21600, 255000, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (55, N'2020-07-31T00:00:00.000', 55, 55, 1, N'', N'your self', N'', 4.00, 148493.00, NULL, N'î¤¼è¢«è£ò¤ô¤ô¢ ðí¤¹ó¤»ñ¢ 3 Üòô¢ðí¤ èí¢è£í¤ð¢ð£÷ó¢èÀè¢° july  2020 ñ£î áî¤òñ¢ Ü÷¤î¢î õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 17139, 131354, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (50, N'2020-07-20T00:00:00.000', 50, 50, 1, N'', N'Þ´ñ¢ðù¢ êó¢õ¦ú¢ ú¢«ìêù¢', N'', 4.00, 11871.00, NULL, N'Þ¬íÝ¬íòó¢(èô¢õ¤ ñø¢Áñ¢ ªî£í¢´ ï¤Áõùé¢è÷¢ ) Ü½õôè ðòù¢ð£ì¢®ô¢ à÷¢÷ TN20BD 0397 è£¼è¢° 6/2020 ñ£îñ¢ ¯êô¢ «ð£ì¢ì¬ñè¢° ðì¢®òô¢ ªî£¬èò÷¤î¢î õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 11871, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (50, N'2020-07-20T00:00:00.000', 50, 50, 1, N'', N'Þ´ñ¢ðù¢ êó¢õ¦ú¢ ú¢«ìêù¢', N'', 4.00, 11871.00, NULL, N'Þ¬íÝ¬íòó¢(èô¢õ¤ ñø¢Áñ¢ ªî£í¢´ ï¤Áõùé¢è÷¢ ) Ü½õôè ðòù¢ð£ì¢®ô¢ à÷¢÷ TN20BD 0397 è£¼è¢° 6/2020 ñ£îñ¢ ¯êô¢ «ð£ì¢ì¬ñè¢° ðì¢®òô¢ ªî£¬èò÷¤î¢î õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 11871, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (53, N'2020-07-30T00:00:00.000', 53, 53, 1, N'', N'your self', N'', 4.00, 91757.00, NULL, N'î¤¼è¢«è£ò¤ô¤ô¢ ðí¤¹ó¤»ñ¢ 36 ðí¤ò£÷ó¢èÀè¢° ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£ ªê½î¢î¤ò õ¬èò¤ô¢ ñø¢Áñ¢ ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£õ¤ø¢° «ê¬õ õó¤ 18% ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 91757, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (54, N'2020-07-30T00:00:00.000', 54, 54, 1, N'', N'ðì¢®òô¢ð®', N'', 4.00, 276600.00, NULL, N'î¤¼.êï¢«î£û¢ = 42500, î¤¼.ªõé¢èì¢= 42500, î¤¼ñî¤.õ£²è¤ = 85000, î¤¼.Ü¼í¢°ñ£ó¢ = 85000 ', N'ADMIN', N'1430', 0, 0.00, NULL, 21600, 255000, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (53, N'2020-07-30T00:00:00.000', 53, 53, 1, N'', N'your self', N'', 4.00, 91757.00, NULL, N'î¤¼è¢«è£ò¤ô¤ô¢ ðí¤¹ó¤»ñ¢ 36 ðí¤ò£÷ó¢èÀè¢° ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£ ªê½î¢î¤ò õ¬èò¤ô¢ ñø¢Áñ¢ ñ¼î¢¶õ è£ð¢ð¦´ êï¢î£õ¤ø¢° «ê¬õ õó¤ 18% ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 91757, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (163, N'2020-09-30T00:00:00.000', 163, 162, 1, N'', N'your self', N'', 4.00, 14139.00, NULL, N'Üòô¢ðí¤ èí¢è£í¤ð¢ð£÷ó¢ Íõó¤ù¢ 9/2020 ñ£î áî¤òñ¢ ð¤®î¢îñ¢ ªêò¢î¬î õé¢è¤ò¤ô¢ ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 14139, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (252, N'2020-11-10T00:00:00.000', 252, 251, 1, N'', N'your self', N'', 4.00, 274210.00, NULL, N'î¤¼è¢«è£ò¤ô¢ ðí¤ò£÷ó¢è÷¤ù¢ 10/2020 ñ£î ß.ð¤.âð¢ êï¢î£ ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 274210, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (252, N'2020-11-10T00:00:00.000', 252, 251, 1, N'', N'your self', N'', 4.00, 274210.00, NULL, N'î¤¼è¢«è£ò¤ô¢ ðí¤ò£÷ó¢è÷¤ù¢ 10/2020 ñ£î ß.ð¤.âð¢ êï¢î£ ªê½î¢î¤ò õ¬èò¤ô¢ ', N'ADMIN', N'1430', 0, 0.00, NULL, 0, 274210, 3, N'With', N'', N'0')
INSERT [tblPayment (1410104064)] ([PaymentId], [PaymentDate], [PNo], [PaymentNo], [AccId], [Heading], [Name], [Place], [LedgerId], [Amount], [ChqNo], [Narration], [UserName], [Pasali], [RecStatus], [CAmount], [Recdate], [Deduction], [NetAmount], [LedgerGroupId], [ChqType], [ItNarration], [AdjType]) VALUES (NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL)

GO

EOT;

$a = str_replace("\r\n", "\n", $a);
$a = str_replace('[','', $a);
$a = str_replace(']','', $a);
$a = str_replace('dbo.','', $a);
$a = str_replace("\n\n\n","\n\n", $a);
while (strpos($a, "\n'") !== false) $a = str_replace("\n'","'", $a);
$a = str_replace(", N'", ", '", $a);
$a = str_replace("DEFAULT (0)", "DEFAULT 0", $a);
$a = str_replace("DEFAULT (1)", "DEFAULT 1", $a);
$a = str_replace("\nGO\n", " ENGINE=MyISAM;\n", $a);
$a = str_replace(")\n", ");\n", $a);
$a = str_replace("\n ENGINE=MyISAM;\n", "\n", $a);
$a = str_replace(" ASC);\n", ")\n", $a);
$a = str_replace(" DESC);\n", ")\n", $a);
$a = str_replace(" CLUSTERED ", " ", $a);
$a = str_replace(" IDENTITY(1,1) ", " AUTO_INCREMENT ", $a);
$a = str_replace(" nvarchar(", " varchar(", $a);
$a = str_replace(" numeric(18,0)", " bigint(18)", $a);
$a = str_replace(" numeric(18,", " double(18,", $a);
$a = str_replace(" numeric(", " int(", $a);
$a = str_replace(" int(10,0)", " INT(10)", $a);

$b = explode("\n", $a);
$a = '';

foreach($b as $k => $v) {
	if ($v == 'GO') continue;
	if (substr($v, 0, 19)  == 'SET IDENTITY_INSERT') continue;
	if (substr($v, 0, 7) == 'INSERT ' && substr($v, 0, 12) != 'INSERT INTO ') $v = 'INSERT INTO ' . substr($v,7);
	$a .= remove_word2($v, 'CONSTRAINT') . "\n";
}

if (TAMILTAB)
	$a = tab2uni($a);

header('Content-Type: text/html; charset=utf-8');
echo $a;

function remove_word2($str, $word, $delim = ' ') {
	if (strpos($str, $word) !== false) {
		$c = explode($delim, $str);
		foreach($c as $k1 => $v1) {
			if (strpos($v1, $word) !== false) {
				unset($c[$k1+1], $c[$k1]);
				$str = implode(" ", $c);
				return $str;
			}
		}
	}
	return $str;
}


?>
