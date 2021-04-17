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
}
