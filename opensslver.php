<?php
// OPENSSL_VERSION_NUMBER parser, works from OpenSSL v.0.9.5b+ (e.g. for use with version_compare())
// OPENSSL_VERSION_NUMBER is a numeric release version identifier for OpenSSL
// Syntax: MNNFFPPS: major minor fix patch status (HEX)
// The status nibble meaning: 0 => development, 1 to e => betas, f => release
// Examples:
// - 0x000906023 => 0.9.6b beta 3
// - 0x00090605f => 0.9.6e release
// - 0x1000103f  => 1.0.1c
/**
* @param Return Patch-Part as decimal number for use with version_compare
* @param OpenSSL version identifier as hex value $openssl_version_number
*/

// CLI Usage: php -f "opensslver.php"
echo get_openssl_version_number(); // 0.9.81
echo get_openssl_version_number(true); // 0.9.8.12

function get_openssl_version_number($patch_as_number=false,$openssl_version_number=null) {
    if (is_null($openssl_version_number)) $openssl_version_number = OPENSSL_VERSION_NUMBER;
    $openssl_numeric_identifier = str_pad((string)dechex($openssl_version_number),8,'0',STR_PAD_LEFT);

    $openssl_version_parsed = array();
    $preg = '/(?<major>[[:xdigit:]])(?<minor>[[:xdigit:]][[:xdigit:]])(?<fix>[[:xdigit:]][[:xdigit:]])';
    $preg.= '(?<patch>[[:xdigit:]][[:xdigit:]])(?<type>[[:xdigit:]])/';
    preg_match_all($preg, $openssl_numeric_identifier, $openssl_version_parsed);
    $openssl_version = false;
    if (!empty($openssl_version_parsed)) {
        $alphabet = array(1=>'a',2=>'b',3=>'c',4=>'d',5=>'e',6=>'f',7=>'g',8=>'h',9=>'i',10=>'j',11=>'k',
                                       12=>'l',13=>'m',14=>'n',15=>'o',16=>'p',17=>'q',18=>'r',19=>'s',20=>'t',21=>'u',
                                       22=>'v',23=>'w',24=>'x',25=>'y',26=>'z');
        $openssl_version = intval($openssl_version_parsed['major'][0]).'.';
        $openssl_version.= intval($openssl_version_parsed['minor'][0]).'.';
        $openssl_version.= intval($openssl_version_parsed['fix'][0]);
        $patchlevel_dec = hexdec($openssl_version_parsed['patch'][0]);
        if (!$patch_as_number && array_key_exists($patchlevel_dec, $alphabet)) {
            $openssl_version.= $alphabet[$patchlevel_dec]; // ideal for text comparison
        }
        else {
            $openssl_version.= '.'.$patchlevel_dec; // ideal for version_compare
        }
    }
    return $openssl_version;
}
?>