<?php

if (! function_exists('getExecutionTime')) {
    /**
     * Метод позволяет замерить время от начала работы laravel
     */
    function getExecutionTime(): void
    {
        $time_end = microtime(true);
        $time = $time_end - LARAVEL_START;
        printf('Скрипт выполнялся %.4F сек.', $time);
        dd($time);
    }
}

if (! function_exists('tagized')) {
    /**
     * Превращение строки в тэг
     *
     * @param string $string
     * @return string
     */
    function tagized(string $string): string
    {
        return strtolower(preg_replace('![\s]+!', "_", $string));
    }
}

if (! function_exists('cutOffByWords')) {
    /**
     * Превращение строки в тэг
     *
     * @param string $text
     * @param int $wordsCount
     * @return string
     */
    function cutOffByWords(string $text, int $wordsCount = 20): string
    {
        return Str::words($text, $wordsCount);
    }
}

if (! function_exists('arrayToObject')) {
    /**
     * Метод заворачивает массив в объект
     *
     * @param array $data
     * @return stdClass
     */
    function arrayToObject(array $data): stdClass
    {
        $object = new stdClass();
        
        foreach ($data as $key => $item) {
            if ($item) {
                $object->{$key} = $item;
            }
        }
        
        return $object;
    }
}