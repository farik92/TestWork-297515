<?php

defined("DUPXABSPATH") or die("");
/**
 * Class used to update and edit web server configuration files
 * for .htaccess, web.config and user.ini
 *
 * Standard: PSR-2
 *
 * @link http://www.php-fig.org/psr/psr-2 Full Documentation
 *
 * @package SC\DUPX\Crypt
 */
class DUPX_Crypt
{
    /**
     * Encrypt a string
     *
     * @param string $key    The key to use for encryption
     * @param string $string The string to encrypt
     *
     * @return string
     */
    public static function encrypt($key, $string)
    {
        $result = '';
        for ($i = 0; $i < strlen($string); $i++) {
            $char    = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char    = chr(ord($char) + ord($keychar));
            $result .= $char;
        }

        return urlencode(base64_encode($result));
    }

    /**
     * Decrypt a string
     *
     * @param string $key    The key to use for decryption
     * @param string $string The string to decrypt
     *
     * @return string
     */
    public static function decrypt($key, $string)
    {
        $result = '';
        $string = urldecode($string);
        $string = base64_decode($string);

        for ($i = 0; $i < strlen($string); $i++) {
            $char    = substr($string, $i, 1);
            $keychar = substr($key, ($i % strlen($key)) - 1, 1);
            $char    = chr(ord($char) - ord($keychar));
            $result .= $char;
        }

        return $result;
    }

    /**
     * Scramble a string
     *
     * @param string $string The string to scramble
     *
     * @return string
     */
    public static function scramble($string)
    {
        return self::encrypt(self::sk1() . self::sk2(), $string);
    }

    /**
     * Unscramble a string
     *
     * @param string $string The string to unscramble
     *
     * @return string
     */
    public static function unscramble($string)
    {
        return self::decrypt(self::sk1() . self::sk2(), $string);
    }

    /**
     * Get the first key
     *
     * @return string
     */
    public static function sk1()
    {
        return 'fdas' . self::encrypt('abx', 'v1');
    }

    /**
     * Get the second key
     *
     * @return string
     */
    public static function sk2()
    {
        return 'fres' . self::encrypt('ad3x', 'v2');
    }
}
