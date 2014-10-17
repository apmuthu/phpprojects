<?php 
/*
// Program      : Get a Google Translated String of a given (default English) string
// Author       : Ap.Muthu <apmuthu@usa.net>
// Version      : 1.0
// Release Date : 2014-10-17
//
// // Usage:
// $a = 'Brinjals are purple in colour.' . chr(10) . 'Roses are red in colour.';
// echo get_tamil($a, 'ta');
//
// May have to use UTF-8 Encoding html / php header to view strings of some languages
*/


function get_tamil($str, $tl, $sl='en') {

	// $url = 'https://translate.google.com/translate_a/single?client=t&sl=auto&tl=ta&hl=en&dt=bd&dt=ex&dt=ld&dt=md&dt=qc&dt=rw&dt=rm&dt=ss&dt=t&dt=at&dt=sw&ie=UTF-8&oe=UTF-8&ssel=0&tsel=4&pc=1&otf=1&q=Hello%2C%20this%20is%20a%20test%20of%20a%20translation';

	$url = "https://translate.google.com/translate_a/single?client=t&sl=$sl&tl=$tl&hl=en&dt=rm&dt=t&q=" . urlencode($str);

	$a = file_get_contents($url);

	$b = explode('[[', $a);
	$c = explode(']]',$b[1]);
	$d = explode('],[',$c[0]);
	array_pop($d);

	$out = '';
	foreach ($d as $e) {
		$s=explode('"', $e);
		$out .= trim($s[1]);
	}

	$out = str_replace(' :',':',$out);
	$out = str_replace(' ,',',',$out);
	$out = str_replace(' .','.',$out);

	return $out;
}

function return_languages(){

// Returns an array of all available Google Translate Languages and their codes (https://translate.google.com/)

	$languages=array();

	$languages['af']    = 'Afrikaans';
	$languages['sq']    = 'Albanian';
	$languages['ar']    = 'Arabic';
	$languages['hy']    = 'Armenian';
	$languages['az']    = 'Azerbaijani';
	$languages['eu']    = 'Basque';
	$languages['be']    = 'Belarusian';
	$languages['bn']    = 'Bengali';
	$languages['bs']    = 'Bosnian';
	$languages['bg']    = 'Bulgarian';
	$languages['ca']    = 'Catalan';
	$languages['ceb']   = 'Cebuano';
	$languages['zh-CN'] = 'Chinese';
	$languages['hr']    = 'Croatian';
	$languages['cs']    = 'Czech';
	$languages['da']    = 'Danish';
	$languages['nl']    = 'Dutch';
	$languages['en']    = 'English';
	$languages['eo']    = 'Esperanto';
	$languages['et']    = 'Estonian';
	$languages['tl']    = 'Filipino';
	$languages['fi']    = 'Finnish';
	$languages['fr']    = 'French';
	$languages['gl']    = 'Galician';
	$languages['ka']    = 'Georgian';
	$languages['de']    = 'German';
	$languages['el']    = 'Greek';
	$languages['gu']    = 'Gujarati';
	$languages['ht']    = 'Haitian Creole';
	$languages['ha']    = 'Hausa';
	$languages['iw']    = 'Hebrew';
	$languages['hi']    = 'Hindi';
	$languages['hmn']   = 'Hmong';
	$languages['hu']    = 'Hungarian';
	$languages['is']    = 'Icelandic';
	$languages['ig']    = 'Igbo';
	$languages['id']    = 'Indonesian';
	$languages['ga']    = 'Irish';
	$languages['it']    = 'Italian';
	$languages['ja']    = 'Japanese';
	$languages['jw']    = 'Javanese';
	$languages['kn']    = 'Kannada';
	$languages['km']    = 'Khmer';
	$languages['ko']    = 'Korean';
	$languages['lo']    = 'Lao';
	$languages['la']    = 'Latin';
	$languages['lv']    = 'Latvian';
	$languages['lt']    = 'Lithuanian';
	$languages['mk']    = 'Macedonian';
	$languages['ms']    = 'Malay';
	$languages['mt']    = 'Maltese';
	$languages['mi']    = 'Maori';
	$languages['mr']    = 'Marathi';
	$languages['mn']    = 'Mongolian';
	$languages['ne']    = 'Nepali';
	$languages['no']    = 'Norwegian';
	$languages['fa']    = 'Persian';
	$languages['pl']    = 'Polish';
	$languages['pt']    = 'Portuguese';
	$languages['pa']    = 'Punjabi';
	$languages['ro']    = 'Romanian';
	$languages['ru']    = 'Russian';
	$languages['sr']    = 'Serbian';
	$languages['sk']    = 'Slovak';
	$languages['sl']    = 'Slovenian';
	$languages['so']    = 'Somali';
	$languages['es']    = 'Spanish';
	$languages['sw']    = 'Swahili';
	$languages['sv']    = 'Swedish';
	$languages['ta']    = 'Tamil';
	$languages['te']    = 'Telugu';
	$languages['th']    = 'Thai';
	$languages['tr']    = 'Turkish';
	$languages['uk']    = 'Ukrainian';
	$languages['ur']    = 'Urdu';
	$languages['vi']    = 'Vietnamese';
	$languages['cy']    = 'Welsh';
	$languages['yi']    = 'Yiddish';
	$languages['yo']    = 'Yoruba';
	$languages['zu']    = 'Zulu';
		
	return $languages;
}

?>
