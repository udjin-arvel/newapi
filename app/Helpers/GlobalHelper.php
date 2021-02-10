<?php

namespace App\Helpers;

/**
 * Class GlobalHelper
 * @package App\Helpers
 */
class GlobalHelper
{
    /**
     * Отрезать кусок от текста, если есть минимальное и максимальное количество, отрезанный кусок должен попадать в интервал
     *
     * @param string $text
     * @param int $percentage (from 0% to 100%)
     * @param int $min
     * @param int $max
     * @return string
     */
    public static function getPieceOfText(
        string $text,
        int $percentage,
        int $min = null,
        int $max = null
    ): string
    {
        $cutLength = (int)(strlen($text) * $percentage / 100);
        
        if ($min && $cutLength <= $min) {
            return $text;
        }
        
        if ($max && $cutLength > $max) {
            $cutLength = $max;
        }
        
        return iconv_substr($text, 0, $cutLength, 'UTF-8');
    }
}