<?php

namespace App\Models\Interfaces;

/**
 * Interface ITypes
 */
interface ITypes
{
    /**
     * Получить типы модели
     * @return array
     */
    public static function getTypes(): array;
}