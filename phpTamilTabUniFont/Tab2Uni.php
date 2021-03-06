<?php
/*
// Program      : PHP script to convert Tamil TAB Font to Unicode and vice-versa
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2020-11-15
// Exceptions   : ஙூ,சூ,ஞூ,டூ,தூ do not have equivalents in TAB font here and in the references
// Morphs       : ஷு,ஸு,ஹு,க்ஷு have some changes in TAB conversions that are not faithfully reversible
// References   : 
https://www.tamillexicon.com/uc/tab-unicode
https://www.tamillexicon.com/uc/unicode-tab
https://www.indiadict.com/web/tamil-fonts-encoding-converter.html
https://ilearntamil.com/tamil-alphabets-chart/

// Usage reference code
header('Content-Type: text/html; charset=utf-8');

// Sample TAB String conversion to Unicode Font:
// $tab_str = 'î¤¼è¢«è£ò¤ô¢ Þ¼ð¢ð¤ô¢ à÷¢÷ îé¢èñ¢, ªõ÷¢÷¤ ñø¢Áñ¢';
$tab_str = 'Hello Þé¢¬è Table ªè£ë¢êñ¢ õ£é¢è.';
echo tab2uni($tab_str) . '<br>' . "\n";

// Sample Unicode String conversion to TAB Font:
$unicode_str = 'Hello இங்கை Table கொஞ்சம் வாங்க.';
echo uni2tab($unicode_str) . '<br>' . "\n";

*/

function tab2uni($str) {
	$Tab2Unicode = Array(
'÷¦' => 'ளீ',
'÷¢' => 'ள்',
'÷£' => 'ளா',
'÷¤' => 'ளி',
'è¢«û£' => 'க்ஷோ',
'è¢ªû÷' => 'க்ஷௌ',
'è¢ªû£' => 'க்ஷொ',
'è¢«û' => 'க்ஷே',
'è¢¬û' => 'க்ஷை',
'è¢ªû' => 'க்ஷெ',
'è¢û¦' => 'க்ஷீ',
'è¢û¨' => 'க்ஷூ',
'è¢û¢' => 'க்ஷ்',
'è¢û£' => 'க்ஷா',
'è¢û¤' => 'க்ஷி',
'è¢û§' => 'க்ஷு',
'«÷£' => 'ளோ',
'«ð£' => 'போ',
'«é£' => 'ஙோ',
'«è£' => 'கோ',
'«ê£' => 'சோ',
'«ë£' => 'ஞோ',
'«í£' => 'ணோ',
'«ì£' => 'டோ',
'«î£' => 'தோ',
'«ï£' => 'நோ',
'«ñ£' => 'மோ',
'«ó£' => 'ரோ',
'«ò£' => 'யோ',
'«ô£' => 'லோ',
'«ö£' => 'ழோ',
'«õ£' => 'வோ',
'«ø£' => 'றோ',
'«ú£' => 'ஸோ',
'«ù£' => 'னோ',
'«û£' => 'ஷோ',
'«ü£' => 'ஜோ',
'«ý£' => 'ஹோ',
'ª÷÷' => 'ளௌ',
'ª÷£' => 'ளொ',
'ªð÷' => 'பௌ',
'ªð£' => 'பொ',
'ªé÷' => 'ஙௌ',
'ªè÷' => 'கௌ',
'ªê÷' => 'சௌ',
'ªë÷' => 'ஞௌ',
'ªé£' => 'ஙொ',
'ªè£' => 'கொ',
'ªê£' => 'சொ',
'ªë£' => 'ஞொ',
'ªí÷' => 'ணௌ',
'ªì÷' => 'டௌ',
'ªî÷' => 'தௌ',
'ªï÷' => 'நௌ',
'ªí£' => 'ணொ',
'ªì£' => 'டொ',
'ªî£' => 'தொ',
'ªï£' => 'நொ',
'ªñ÷' => 'மௌ',
'ªñ£' => 'மொ',
'ªó÷' => 'ரௌ',
'ªò÷' => 'யௌ',
'ªô÷' => 'லௌ',
'ªö÷' => 'ழௌ',
'ªõ÷' => 'வௌ',
'ªø÷' => 'றௌ',
'ªó£' => 'ரொ',
'ªò£' => 'யொ',
'ªô£' => 'லொ',
'ªö£' => 'ழொ',
'ªõ£' => 'வொ',
'ªø£' => 'றொ',
'ªú÷' => 'ஸௌ',
'ªù÷' => 'னௌ',
'ªû÷' => 'ஷௌ',
'ªü÷' => 'ஜௌ',
'ªú£' => 'ஸொ',
'ªù£' => 'னொ',
'ªû£' => 'ஷொ',
'ªü£' => 'ஜொ',
'ªý÷' => 'ஹௌ',
'ªý£' => 'ஹொ',
'è¢û' => 'க்ஷ',
'«÷' => 'ளே',
'«ð' => 'பே',
'«é' => 'ஙே',
'«è' => 'கே',
'«ê' => 'சே',
'«ë' => 'ஞே',
'«í' => 'ணே',
'«ì' => 'டே',
'«î' => 'தே',
'«ï' => 'நே',
'«ñ' => 'மே',
'«ó' => 'ரே',
'«ò' => 'யே',
'«ô' => 'லே',
'«ö' => 'ழே',
'«õ' => 'வே',
'«ø' => 'றே',
'«ú' => 'ஸே',
'«ù' => 'னே',
'«û' => 'ஷே',
'«ü' => 'ஜே',
'«ý' => 'ஹே',
'¬÷' => 'ளை',
'¬ð' => 'பை',
'¬é' => 'ஙை',
'¬è' => 'கை',
'¬ê' => 'சை',
'¬ë' => 'ஞை',
'¬í' => 'ணை',
'¬ì' => 'டை',
'¬î' => 'தை',
'¬ï' => 'நை',
'¬ñ' => 'மை',
'¬ó' => 'ரை',
'¬ò' => 'யை',
'¬ô' => 'லை',
'¬ö' => 'ழை',
'¬õ' => 'வை',
'¬ø' => 'றை',
'¬ú' => 'ஸை',
'¬ù' => 'னை',
'¬û' => 'ஷை',
'¬ü' => 'ஜை',
'¬ý' => 'ஹை',
'ª÷' => 'ளெ',
'å÷' => 'ஔ',
'ªð' => 'பெ',
'ªé' => 'ஙெ',
'ªè' => 'கெ',
'ªê' => 'செ',
'ªë' => 'ஞெ',
'ªí' => 'ணெ',
'ªì' => 'டெ',
'ªî' => 'தெ',
'ªï' => 'நெ',
'ªñ' => 'மெ',
'ªó' => 'ரெ',
'ªò' => 'யெ',
'ªô' => 'லெ',
'ªö' => 'ழெ',
'ªõ' => 'வெ',
'ªø' => 'றெ',
'ªú' => 'ஸெ',
'ªù' => 'னெ',
'ªû' => 'ஷெ',
'ªü' => 'ஜெ',
'ªý' => 'ஹெ',
'ð¦' => 'பீ',
'ð¢' => 'ப்',
'ð£' => 'பா',
'ð¤' => 'பி',
'é¦' => 'ஙீ',
'è¦' => 'கீ',
'ê¦' => 'சீ',
'ë¦' => 'ஞீ',
'é¢' => 'ங்',
'è¢' => 'க்',
'ê¢' => 'ச்',
'ë¢' => 'ஞ்',
'é£' => 'ஙா',
'è£' => 'கா',
'ê£' => 'சா',
'ë£' => 'ஞா',
'é¤' => 'ஙி',
'è¤' => 'கி',
'ê¤' => 'சி',
'ë¤' => 'ஞி',
'í¦' => 'ணீ',
'ì¦' => 'டீ',
'î¦' => 'தீ',
'ï¦' => 'நீ',
'í¢' => 'ண்',
'ì¢' => 'ட்',
'î¢' => 'த்',
'ï¢' => 'ந்',
'í£' => 'ணா',
'ì£' => 'டா',
'î£' => 'தா',
'ï£' => 'நா',
'í¤' => 'ணி',
'ì¤' => 'டி',
'î¤' => 'தி',
'ï¤' => 'நி',
'ñ¦' => 'மீ',
'ñ¢' => 'ம்',
'ñ£' => 'மா',
'ñ¤' => 'மி',
'ó¦' => 'ரீ',
'ò¦' => 'யீ',
'ô¦' => 'லீ',
'ö¦' => 'ழீ',
'õ¦' => 'வீ',
'ø¦' => 'றீ',
'ó¢' => 'ர்',
'ò¢' => 'ய்',
'ô¢' => 'ல்',
'ö¢' => 'ழ்',
'õ¢' => 'வ்',
'ø¢' => 'ற்',
'ó£' => 'ரா',
'ò£' => 'யா',
'ô£' => 'லா',
'ö£' => 'ழா',
'õ£' => 'வா',
'ø£' => 'றா',
'ó¤' => 'ரி',
'ò¤' => 'யி',
'ô¤' => 'லி',
'ö¤' => 'ழி',
'õ¤' => 'வி',
'ø¤' => 'றி',
'ú¦' => 'ஸீ',
'ù¦' => 'னீ',
'û¦' => 'ஷீ',
'ü¦' => 'ஜீ',
'ú¨' => 'ஸூ',
'û¨' => 'ஷூ',
'ü¨' => 'ஜூ',
'ú¢' => 'ஸ்',
'ù¢' => 'ன்',
'û¢' => 'ஷ்',
'ü¢' => 'ஜ்',
'ú£' => 'ஸா',
'ù£' => 'னா',
'û£' => 'ஷா',
'ü£' => 'ஜா',
'ú¤' => 'ஸி',
'ù¤' => 'னி',
'û¤' => 'ஷி',
'ü¤' => 'ஜி',
'ú§' => 'ஸு',
'û§' => 'ஷு',
'ü§' => 'ஜு',
'ý¦' => 'ஹீ',
'ý¨' => 'ஹூ',
'ý¢' => 'ஹ்',
'ÿ¢' => 'ஸ்ரீ',
'ý£' => 'ஹா',
'ý¤' => 'ஹி',
'ý§' => 'ஹு',
'´' => 'டு',
'¸' => 'நு',
'¿' => 'ழு',
'±' => 'ஙு',
'»' => 'யு',
'×' => 'வூ',
'÷' => 'ள',
'®' => 'டி',
'°' => 'கு',
'µ' => 'ணு',
'¶' => 'து',
'¼' => 'ரு',
'½' => 'லு',
'¾' => 'வு',
'¹' => 'பு',
'²' => 'சு',
'³' => 'ஞு',
'á' => 'ஊ',
'Á' => 'று',
'à' => 'உ',
'À' => 'ளு',
'â' => 'எ',
'Â' => 'னு',
'ä' => 'ஐ',
'Ä' => 'ஙூ',
'ã' => 'ஏ',
'Ã' => 'கூ',
'å' => 'ஒ',
'Å' => 'சூ',
'æ' => 'ஓ',
'Æ' => 'ஞூ',
'ç' => 'ஃ',
'Ç' => 'டூ',
'ð' => 'ப',
'é' => 'ங',
'É' => 'தூ',
'è' => 'க',
'È' => 'ணூ',
'ê' => 'ச',
'ë' => 'ஞ',
'Ë' => 'நூ',
'í' => 'ண',
'Í' => 'மூ',
'ì' => 'ட',
'Ì' => 'பூ',
'î' => 'த',
'Î' => 'யூ',
'ï' => 'ந',
'Ï' => 'ரூ',
'ñ' => 'ம',
'º' => 'மு',
'ó' => 'ர',
'ò' => 'ய',
'ô' => 'ல',
'Ö' => 'லூ',
'ö' => 'ழ',
'õ' => 'வ',
'Ø' => 'ழூ',
'ø' => 'ற',
'ß' => 'ஈ',
'Þ' => 'இ',
'Ú' => 'றூ',
'ú' => 'ஸ',
'Ù' => 'ளூ',
'ù' => 'ன',
'Û' => 'னூ',
'û' => 'ஷ',
'Ü' => 'அ',
'ü' => 'ஜ',
'Ý' => 'ஆ',
'ý' => 'ஹ',
'ÿ' => 'ஸ்ரீ'
);
	foreach ($Tab2Unicode as $k => $v) {
		$str = str_replace($k, $v, $str);
	}
	return $str;
}

function uni2tab($str) {
	$Unicode2Tab = Array(
'ளீ' => '÷¦',
'ள்' => '÷¢',
'ளா' => '÷£',
'ளி' => '÷¤',
'க்ஷோ' => 'è¢«û£',
'க்ஷௌ' => 'è¢ªû÷',
'க்ஷொ' => 'è¢ªû£',
'க்ஷே' => 'è¢«û',
'க்ஷை' => 'è¢¬û',
'க்ஷெ' => 'è¢ªû',
'க்ஷீ' => 'è¢û¦',
'க்ஷூ' => 'è¢û¨',
'க்ஷ்' => 'è¢û¢',
'க்ஷா' => 'è¢û£',
'க்ஷி' => 'è¢û¤',
'க்ஷு' => 'è¢û§',
'ளோ' => '«÷£',
'போ' => '«ð£',
'ஙோ' => '«é£',
'கோ' => '«è£',
'சோ' => '«ê£',
'ஞோ' => '«ë£',
'ணோ' => '«í£',
'டோ' => '«ì£',
'தோ' => '«î£',
'நோ' => '«ï£',
'மோ' => '«ñ£',
'ரோ' => '«ó£',
'யோ' => '«ò£',
'லோ' => '«ô£',
'ழோ' => '«ö£',
'வோ' => '«õ£',
'றோ' => '«ø£',
'ஸோ' => '«ú£',
'னோ' => '«ù£',
'ஷோ' => '«û£',
'ஜோ' => '«ü£',
'ஹோ' => '«ý£',
'ளௌ' => 'ª÷÷',
'ளொ' => 'ª÷£',
'பௌ' => 'ªð÷',
'பொ' => 'ªð£',
'ஙௌ' => 'ªé÷',
'கௌ' => 'ªè÷',
'சௌ' => 'ªê÷',
'ஞௌ' => 'ªë÷',
'ஙொ' => 'ªé£',
'கொ' => 'ªè£',
'சொ' => 'ªê£',
'ஞொ' => 'ªë£',
'ணௌ' => 'ªí÷',
'டௌ' => 'ªì÷',
'தௌ' => 'ªî÷',
'நௌ' => 'ªï÷',
'ணொ' => 'ªí£',
'டொ' => 'ªì£',
'தொ' => 'ªî£',
'நொ' => 'ªï£',
'மௌ' => 'ªñ÷',
'மொ' => 'ªñ£',
'ரௌ' => 'ªó÷',
'யௌ' => 'ªò÷',
'லௌ' => 'ªô÷',
'ழௌ' => 'ªö÷',
'வௌ' => 'ªõ÷',
'றௌ' => 'ªø÷',
'ரொ' => 'ªó£',
'யொ' => 'ªò£',
'லொ' => 'ªô£',
'ழொ' => 'ªö£',
'வொ' => 'ªõ£',
'றொ' => 'ªø£',
'ஸௌ' => 'ªú÷',
'னௌ' => 'ªù÷',
'ஷௌ' => 'ªû÷',
'ஜௌ' => 'ªü÷',
'ஸொ' => 'ªú£',
'னொ' => 'ªù£',
'ஷொ' => 'ªû£',
'ஜொ' => 'ªü£',
'ஹௌ' => 'ªý÷',
'ஹொ' => 'ªý£',
'க்ஷ' => 'è¢û',
'ளே' => '«÷',
'பே' => '«ð',
'ஙே' => '«é',
'கே' => '«è',
'சே' => '«ê',
'ஞே' => '«ë',
'ணே' => '«í',
'டே' => '«ì',
'தே' => '«î',
'நே' => '«ï',
'மே' => '«ñ',
'ரே' => '«ó',
'யே' => '«ò',
'லே' => '«ô',
'ழே' => '«ö',
'வே' => '«õ',
'றே' => '«ø',
'ஸே' => '«ú',
'னே' => '«ù',
'ஷே' => '«û',
'ஜே' => '«ü',
'ஹே' => '«ý',
'ளை' => '¬÷',
'பை' => '¬ð',
'ஙை' => '¬é',
'கை' => '¬è',
'சை' => '¬ê',
'ஞை' => '¬ë',
'ணை' => '¬í',
'டை' => '¬ì',
'தை' => '¬î',
'நை' => '¬ï',
'மை' => '¬ñ',
'ரை' => '¬ó',
'யை' => '¬ò',
'லை' => '¬ô',
'ழை' => '¬ö',
'வை' => '¬õ',
'றை' => '¬ø',
'ஸை' => '¬ú',
'னை' => '¬ù',
'ஷை' => '¬û',
'ஜை' => '¬ü',
'ஹை' => '¬ý',
'ளெ' => 'ª÷',
'ஔ' => 'å÷',
'பெ' => 'ªð',
'ஙெ' => 'ªé',
'கெ' => 'ªè',
'செ' => 'ªê',
'ஞெ' => 'ªë',
'ணெ' => 'ªí',
'டெ' => 'ªì',
'தெ' => 'ªî',
'நெ' => 'ªï',
'மெ' => 'ªñ',
'ரெ' => 'ªó',
'யெ' => 'ªò',
'லெ' => 'ªô',
'ழெ' => 'ªö',
'வெ' => 'ªõ',
'றெ' => 'ªø',
'ஸெ' => 'ªú',
'னெ' => 'ªù',
'ஷெ' => 'ªû',
'ஜெ' => 'ªü',
'ஹெ' => 'ªý',
'பீ' => 'ð¦',
'ப்' => 'ð¢',
'பா' => 'ð£',
'பி' => 'ð¤',
'ஙீ' => 'é¦',
'கீ' => 'è¦',
'சீ' => 'ê¦',
'ஞீ' => 'ë¦',
'ங்' => 'é¢',
'க்' => 'è¢',
'ச்' => 'ê¢',
'ஞ்' => 'ë¢',
'ஙா' => 'é£',
'கா' => 'è£',
'சா' => 'ê£',
'ஞா' => 'ë£',
'ஙி' => 'é¤',
'கி' => 'è¤',
'சி' => 'ê¤',
'ஞி' => 'ë¤',
'ணீ' => 'í¦',
'டீ' => 'ì¦',
'தீ' => 'î¦',
'நீ' => 'ï¦',
'ண்' => 'í¢',
'ட்' => 'ì¢',
'த்' => 'î¢',
'ந்' => 'ï¢',
'ணா' => 'í£',
'டா' => 'ì£',
'தா' => 'î£',
'நா' => 'ï£',
'ணி' => 'í¤',
'தி' => 'î¤',
'நி' => 'ï¤',
'மீ' => 'ñ¦',
'ம்' => 'ñ¢',
'மா' => 'ñ£',
'மி' => 'ñ¤',
'ரீ' => 'ó¦',
'யீ' => 'ò¦',
'லீ' => 'ô¦',
'ழீ' => 'ö¦',
'வீ' => 'õ¦',
'றீ' => 'ø¦',
'ர்' => 'ó¢',
'ய்' => 'ò¢',
'ல்' => 'ô¢',
'ழ்' => 'ö¢',
'வ்' => 'õ¢',
'ற்' => 'ø¢',
'ரா' => 'ó£',
'யா' => 'ò£',
'லா' => 'ô£',
'ழா' => 'ö£',
'வா' => 'õ£',
'றா' => 'ø£',
'ரி' => 'ó¤',
'யி' => 'ò¤',
'லி' => 'ô¤',
'ழி' => 'ö¤',
'வி' => 'õ¤',
'றி' => 'ø¤',
'ஸீ' => 'ú¦',
'னீ' => 'ù¦',
'ஷீ' => 'û¦',
'ஜீ' => 'ü¦',
'ஸூ' => 'ú¨',
'ஷூ' => 'û¨',
'ஜூ' => 'ü¨',
'ஸ்' => 'ú¢',
'ன்' => 'ù¢',
'ஷ்' => 'û¢',
'ஜ்' => 'ü¢',
'ஸா' => 'ú£',
'னா' => 'ù£',
'ஷா' => 'û£',
'ஜா' => 'ü£',
'ஸி' => 'ú¤',
'னி' => 'ù¤',
'ஷி' => 'û¤',
'ஜி' => 'ü¤',
'ஸு' => 'ú§',
'ஷு' => 'û§',
'ஜு' => 'ü§',
'ஹீ' => 'ý¦',
'ஹூ' => 'ý¨',
'ஹ்' => 'ý¢',
'ஸ்ரீ' => 'ÿ¢',
'ஹா' => 'ý£',
'ஹி' => 'ý¤',
'ஹு' => 'ý§',
'டு' => '´',
'நு' => '¸',
'ழு' => '¿',
'ஙு' => '±',
'யு' => '»',
'வூ' => '×',
'ள' => '÷',
'டி' => '®',
'கு' => '°',
'ணு' => 'µ',
'து' => '¶',
'ரு' => '¼',
'லு' => '½',
'வு' => '¾',
'பு' => '¹',
'சு' => '²',
'ஞு' => '³',
'ஊ' => 'á',
'று' => 'Á',
'உ' => 'à',
'ளு' => 'À',
'எ' => 'â',
'னு' => 'Â',
'ஐ' => 'ä',
'ஙூ' => 'Ä',
'ஏ' => 'ã',
'கூ' => 'Ã',
'ஒ' => 'å',
'சூ' => 'Å',
'ஓ' => 'æ',
'ஞூ' => 'Æ',
'ஃ' => 'ç',
'டூ' => 'Ç',
'ப' => 'ð',
'ங' => 'é',
'தூ' => 'É',
'க' => 'è',
'ணூ' => 'È',
'ச' => 'ê',
'ஞ' => 'ë',
'நூ' => 'Ë',
'ண' => 'í',
'மூ' => 'Í',
'ட' => 'ì',
'பூ' => 'Ì',
'த' => 'î',
'யூ' => 'Î',
'ந' => 'ï',
'ரூ' => 'Ï',
'ம' => 'ñ',
'மு' => 'º',
'ர' => 'ó',
'ய' => 'ò',
'ல' => 'ô',
'லூ' => 'Ö',
'ழ' => 'ö',
'வ' => 'õ',
'ழூ' => 'Ø',
'ற' => 'ø',
'ஈ' => 'ß',
'இ' => 'Þ',
'றூ' => 'Ú',
'ஸ' => 'ú',
'ளூ' => 'Ù',
'ன' => 'ù',
'னூ' => 'Û',
'ஷ' => 'û',
'அ' => 'Ü',
'ஜ' => 'ü',
'ஆ' => 'Ý',
'ஹ' => 'ý'
);
	foreach ($Unicode2Tab as $k => $v) {
		$str = str_replace($k, $v, $str);
	}
	return $str;
}




