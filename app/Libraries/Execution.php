<?php

namespace App\Libraries;

/**
 * Class Statistics
 * @package App\Admin\Services
 */
class Execution
{
    /**
     * @var float
     */
    static $startTime;
    
    /**
     * Запустить таймер
     */
    public static function startTimer()
    {
        self::$startTime = microtime(true);
    }
    
    /**
     * Остановить таймер
     */
    public static function stopTimer()
    {
        $time = microtime(true) - self::$startTime;
        printf('Скрипт выполнялся %.4F сек.', $time);
        dd($time);
    }
    
    /**
     * Посмотреть сколько времени занял скрипт от запуска laravel
     */
    public static function getExecutionTime()
    {
        $time_end = microtime(true);
        $time = $time_end - LARAVEL_START;
        printf('Скрипт выполнялся %.4F сек.', $time);
        dd($time);
    }
}
