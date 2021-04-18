<?php


namespace App\Helpers;


/**
 * Class StringHelper
 * @package App\Helpers
 */
class StringHelper
{
    /**
     * @param string $param
     * @return array|string|string[]|null
     */
    public static function clearField($param)
    {
        if (empty($param)) {
            return '';
        }

        return str_replace(['.', '-', '/', '(', ')', ' '], '', $param);
    }

    public static function formatPhoneNumber($phoneNumber)
    {
        $new = substr_replace($phoneNumber, '(', 0, 0);
        if (strlen($phoneNumber) == 10) {
            $new = substr_replace($new, '9', 3, 0);
        }
        return substr_replace($new, ')', 3, 0);
    }
}
