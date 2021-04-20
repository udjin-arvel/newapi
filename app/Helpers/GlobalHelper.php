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
    
    /**
     * Превращение строки в тэг
     *
     * @param string $string
     * @return string
     */
    public static function tagized(string $string): string
    {
        return strtolower(preg_replace('![\s]+!', "_" , $string));
    }
    
    /**
     * Проверка текста на шаблоны замены
     *
     * @param string $text
     * @return string
     */
    public static function checkTextOnPattern(string $text): string
    {
        if (!$text) {
            return '';
        }
        
        $result  = '';
        $matches = [];
    
        preg_match_all('/\/(.+?)\//', $text, $matches);
        
        if (isset($matches[0])) {
            foreach ($matches[0] as $number => $match) {
                $position = mb_strpos($text, $match);
                $meanings = explode('!=', $matches[1][$number]);
                $span = "<span class='meaning-span' title='{$meanings[1]}'>{$meanings[0]}</span>";
                $result .= mb_substr($text, 0, $position) . $span;
                $text = mb_substr($text, $position + mb_strlen($match));
            }
    
            $result .= $text;
        }
        
        return $result;
    }
}