<?php
/*
// Program       : PHP equivalent of MySQL LIKE operator
// Author        : Ap.Muthu <apmuthu@usa.net>
// Version       : 1.0
// Release Date  : 2021-03-08
// Return Value  : Boolean
// Reference     : https://stackoverflow.com/questions/4912294/php-like-thing-similar-to-mysql-like-for-if-statement
// Usage Notes   : Unicode aware
//		like('Hello 🙃', 'Hello _'); // true
//		like('Hello 🙃', '_e%o__');  // true
//		like('asdfas \\🙃H\\\\%🙃É\\l\\_🙃\\l\\o asdfasf', '%' . escapeLike('\\🙃h\\\\%🙃e\\l\\_🙃\\l\\o') . '%'); // true
*/

/**
 * Removes the diacritical marks from a string.
 *
 * Diacritical marks: {@link https://unicode-table.com/blocks/combining-diacritical-marks/}
 *
 * @param string $string The string from which to strip the diacritical marks.
 * @return string Stripped string.
 */
function stripDiacriticalMarks(string $string): string
{
    return preg_replace('/[\x{0300}-\x{036f}]/u', '', \Normalizer::normalize($string , \Normalizer::FORM_KD));
}

/**
 * Escapes a string in a way that `UString::like` will match it as-is, thus '%' and '_'
 * would match a literal '%' and '_' respectively (and not behave as in a SQL LIKE
 * condition).
 *
 * @param string $str The string to escape.
 * @return string The escaped string.
 */
function escapeLike(string $str): string
{
    return strtr($str, ['\\' => '\\\\', '%' => '\%', '_' => '\_']);
}

/**
 * Checks if the string $haystack is like $needle, $needle can contain '%' and '_'
 * characters which will behave as if used in a SQL LIKE condition. Character escaping
 * is supported with '\'.
 *
 * @param string $haystack The string to check if it is like $needle.
 * @param string $needle The string used to check if $haystack is like it.
 * @param bool $ai Whether to check likeness in an accent-insensitive manner.
 * @param bool $ci Whether to check likeness in a case-insensitive manner.
 * @return bool True if $haystack is like $needle, otherwise, false.
 */
function like(string $haystack, string $needle, bool $ai = true, bool $ci = true): bool
{
    if ($ai) {
        $haystack = stripDiacriticalMarks($haystack);
        $needle = stripDiacriticalMarks($needle);
    }

    $needle = preg_quote($needle, '/');

    $tokens = [];

    $needleLength = strlen($needle);
    for ($i = 0; $i < $needleLength;) {
        if ($needle[$i] === '\\') {
            $i += 2;
            if ($i < $needleLength) {
                if ($needle[$i] === '\\') {
                    $tokens[] = '\\\\';
                    $i += 2;
                } else {
                    $tokens[] = $needle[$i];
                    ++$i;
                }
            } else {
                $tokens[] = '\\\\';
            }
        } else {
            switch ($needle[$i]) {
                case '_':
                    $tokens[] = '.';
                    break;
                case '%':
                    $tokens[] = '.*';
                    break;
                default:
                    $tokens[] = $needle[$i];
                    break;
            }
            ++$i;
        }
    }

    return preg_match('/^' . implode($tokens) . '$/u' . ($ci ? 'i' : ''), $haystack) === 1;
}

?>
