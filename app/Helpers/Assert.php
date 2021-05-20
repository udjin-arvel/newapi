<?php

namespace App\Helpers;

use App\Exceptions\TBError;

/**
 * Class Assert
 * @package App\Helpers
 */
class Assert
{
    /**
     * Проверить, что переданный аргумент - строка
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function string($value, $message = '')
    {
        if (!is_string($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалась строка. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - непустая строка
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function stringNotEmpty($value, $message = '')
    {
        static::string($value, $message);
        static::notEq($value, '', $message);
    }
    
    /**
     * Проверить, что переданный аргумент - целое число
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function integer($value, $message = '')
    {
        if (!is_int($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось целое число. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент имеет численный тип
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function integerish($value, $message = '')
    {
        if (!is_numeric($value) || $value != (int) $value) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидался численный тип. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент имеет вещественный тип
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function float($value, $message = '')
    {
        if (!is_float($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидался вещественный тип. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - численное
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function numeric($value, $message = '')
    {
        if (!is_numeric($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось число. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - натуральное число
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function natural($value, $message = '')
    {
        if (!is_int($value) || $value < 0) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось натуральное число. Получено %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - булево значение
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function boolean($value, $message = '')
    {
        if (!is_bool($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось булево значение. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - integer, float, string или boolean
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function scalar($value, $message = '')
    {
        if (!is_scalar($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось скалярное значение. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - объект
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function object($value, $message = '')
    {
        if (!is_object($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидался объект. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - функция
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function isCallable($value, $message = '')
    {
        if (!is_callable($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалась функция. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - массив
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function isArray($value, $message = '')
    {
        if (!is_array($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидался массив. Получено: %s',
                static::typeToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент имеет соответствующий экземпляр класса
     *
     * @param $value
     * @param string $class
     * @param string $message
     * @throws TBError
     */
    public static function isInstanceOf($value, $class, $message = '')
    {
        if (!($value instanceof $class)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что класс содержит экземпляр %2$s. Получено: %s',
                static::typeToString($value),
                $class
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент не имеет соответствующий экземпляр класса
     *
     * @param $value
     * @param string $class
     * @param string $message
     * @throws TBError
     */
    public static function notInstanceOf($value, $class, $message = '')
    {
        if ($value instanceof $class) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что класс не содержит экземпляр %2$s. Получено: %s',
                static::typeToString($value),
                $class
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент имеет хотя бы один из переданных экземпляров класса
     *
     * @param $value
     * @param array $classes
     * @param string $message
     * @throws TBError
     */
    public static function isInstanceOfAny($value, array $classes, $message = '')
    {
        foreach ($classes as $class) {
            if ($value instanceof $class) {
                return;
            }
        }
        
        static::reportInvalidArgument(sprintf(
            $message ?: 'Ожидалось, что класс содержит какой-либо экземпляр класса из %2$s. Получено: %s',
            static::typeToString($value),
            implode(', ', array_map(array('static', 'valueToString'), $classes))
        ));
    }
    
    /**
     * Проверить, что переданный аргумент - пустое значение
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function isEmpty($value, $message = '')
    {
        if (!empty($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось пустое значение. Получено: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - не пустое значение
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function notEmpty($value, $message = '')
    {
        if (empty($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось непустое значение. Got: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - ip
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function ip($value, $message = '')
    {
        if (false === filter_var($value, FILTER_VALIDATE_IP)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидался ip. Получено: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - массив, имеющий уникальные значения
     *
     * @param array $values
     * @param string $message
     * @throws TBError
     */
    public static function uniqueValues(array $values, $message = '')
    {
        $allValues = count($values);
        $uniqueValues = count(array_unique($values));
        
        if ($allValues !== $uniqueValues) {
            $difference = $allValues - $uniqueValues;
            
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что массив имеет уникальные значения, но %s имеет дубликаты',
                $difference,
                (1 === $difference ? 'is' : 'are')
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - соответствует ожидаемому значению
     *
     * @param $value
     * @param $expect
     * @param string $message
     * @throws TBError
     */
    public static function eq($value, $expect, $message = '')
    {
        if ($expect != $value) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение будет равно %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($expect)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - не соответствует ожидаемому значению
     *
     * @param $value
     * @param $expect
     * @param string $message
     * @throws TBError
     */
    public static function notEq($value, $expect, $message = '')
    {
        if ($expect == $value) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение не будет равно %s.',
                static::valueToString($expect)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - точно соответствует ожидаемому значению
     *
     * @param $value
     * @param $expect
     * @param string $message
     * @throws TBError
     */
    public static function same($value, $expect, $message = '')
    {
        if ($expect !== $value) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение будет равно %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($expect)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент - не точно соответствует ожидаемому значению
     *
     * @param $value
     * @param $expect
     * @param string $message
     * @throws TBError
     */
    public static function notSame($value, $expect, $message = '')
    {
        if ($expect === $value) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение не будет равно %s.',
                static::valueToString($expect)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент больше или равен, чем переданный лимит
     *
     * @param $value
     * @param $limit
     * @param string $message
     * @throws TBError
     */
    public static function greaterThan($value, $limit, $message = '')
    {
        if ($value <= $limit) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение больше или равно %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($limit)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент больше, чем переданный лимит
     *
     * @param $value
     * @param $limit
     * @param string $message
     * @throws TBError
     */
    public static function greaterThanEq($value, $limit, $message = '')
    {
        if ($value < $limit) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение больше %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($limit)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент меньше, чем переданный лимит
     *
     * @param $value
     * @param $limit
     * @param string $message
     * @throws TBError
     */
    public static function lessThan($value, $limit, $message = '')
    {
        if ($value >= $limit) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение меньше %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($limit)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент меньше или равен, чем переданный лимит
     *
     * @param $value
     * @param $limit
     * @param string $message
     * @throws TBError
     */
    public static function lessThanEq($value, $limit, $message = '')
    {
        if ($value > $limit) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение меньше или равно %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($limit)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент входит в заданные рамки
     *
     * @param $value
     * @param $min
     * @param $max
     * @param string $message
     * @throws TBError
     */
    public static function range($value, $min, $max, $message = '')
    {
        if ($value < $min || $value > $max) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что значение расположено между %2$s и %3$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($min),
                static::valueToString($max)
            ));
        }
    }
    
    /**
     * Проверить, что массив имеет все переданные ключи
     *
     * @param $keys
     * @param array $array
     * @param string $message
     * @throws TBError
     */
    public static function keysExist(array $keys, array $array, string $message)
    {
        if (array_intersect($keys, array_keys($array)) !== $keys) {
            static::reportInvalidArgument($message);
        }
    }
    
    /**
     * Проверить, что массив имеет все переданные ключи и значения по ключам не пусты
     *
     * @param array $keys
     * @param array $array
     * @param string $message
     * @param bool $atLeastOne
     * @throws TBError
     */
    public static function keysExistAndValued(array $keys, array $array, string $message, bool $atLeastOne = false)
    {
        $checked = !$atLeastOne;
        
        foreach ($keys as $key) {
            $checked = !empty($array[$key]);
            
            if ($atLeastOne && $checked) {
                break;
            }
        }
        
        if (!$checked) {
            static::reportInvalidArgument($message);
        }
    }
    
    /**
     * Проверить, что переданный аргумент содержится в массиве
     *
     * @param $value
     * @param array $values
     * @param string $message
     * @throws TBError
     */
    public static function oneOf($value, array $values, $message = '')
    {
        if (!in_array($value, $values, true)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что аргумент содержится в: %2$s. Получено: %s',
                static::valueToString($value),
                implode(', ', array_map(array('static', 'valueToString'), $values))
            ));
        }
    }
    
    /**
     * Проверить, что строка содержит переданную подстроку
     *
     * @param $value
     * @param string $subString
     * @param string $message
     * @throws TBError
     */
    public static function contains($value, $subString, $message = '')
    {
        if (false === strpos($value, $subString)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка будет содержать %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($subString)
            ));
        }
    }
    
    /**
     * Проверить, что строка не содержит переданную подстроку
     *
     * @param $value
     * @param string $subString
     * @param string $message
     * @throws TBError
     */
    public static function notContains($value, $subString, $message = '')
    {
        if (false !== strpos($value, $subString)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка не будет содержать %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($subString)
            ));
        }
    }
    
    /**
     * Проверить, что строка начинается с
     *
     * @param $value
     * @param string $prefix
     * @param string $message
     * @throws TBError
     */
    public static function startsWith($value, $prefix, $message = '')
    {
        if (0 !== strpos($value, $prefix)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка начинается с %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($prefix)
            ));
        }
    }
    
    /**
     * Проверить, что строка заканчивается на
     *
     * @param $value
     * @param string $suffix
     * @param string $message
     * @throws TBError
     */
    public static function endsWith($value, $suffix, $message = '')
    {
        if ($suffix !== substr($value, -static::strlen($suffix))) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка закончися на %2$s. Получено: %s',
                static::valueToString($value),
                static::valueToString($suffix)
            ));
        }
    }
    
    /**
     * Проверить, что строка заканчивается на
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function digits($value, $message = '')
    {
        $locale = setlocale(LC_CTYPE, 0);
        setlocale(LC_CTYPE, 'C');
        $valid = !ctype_digit($value);
        setlocale(LC_CTYPE, $locale);
        
        if ($valid) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка содержит только числа. Получено: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что строка имеет минимальную длину
     *
     * @param $value
     * @param string $min
     * @param string $message
     * @throws TBError
     */
    public static function minLength($value, $min, $message = '')
    {
        if (static::strlen($value) < $min) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка имеет минимальную длину %2$s. Получено: %s',
                static::valueToString($value),
                $min
            ));
        }
    }
    
    /**
     * Проверить, что строка имеет максимальную длину
     *
     * @param $value
     * @param string $max
     * @param string $message
     * @throws TBError
     */
    public static function maxLength($value, $max, $message = '')
    {
        if (static::strlen($value) > $max) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Ожидалось, что строка имеет максимальную длину %2$s. Получено: %s',
                static::valueToString($value),
                $max
            ));
        }
    }
    
    /**
     * Проверить, что файл существует
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function fileExists($value, $message = '')
    {
        static::string($value);
        
        if (!file_exists($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Файл не существует',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент соответствует пути файла
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function file($value, $message = '')
    {
        static::fileExists($value, $message);
        
        if (!is_file($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Это не путь к файлу: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что переданный аргумент соответствует пути директории
     *
     * @param $value
     * @param string $message
     * @throws TBError
     */
    public static function directory($value, $message = '')
    {
        static::fileExists($value, $message);
        
        if (!is_dir($value)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Это не путь к директории: %s',
                static::valueToString($value)
            ));
        }
    }
    
    /**
     * Проверить, что указанный класс имеет соответствующий метод
     *
     * @param $classOrObject
     * @param $method
     * @param string $message
     * @throws TBError
     */
    public static function methodExists($classOrObject, $method, $message = '')
    {
        if (!method_exists($classOrObject, $method)) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Метод не существует в указанном классе: %s',
                static::valueToString($method)
            ));
        }
    }
    
    /**
     * Проверить, что переданный массив имеет соответствующий ключ
     *
     * @param $array
     * @param $key
     * @param string $message
     * @throws TBError
     */
    public static function keyExists($array, $key, $message = '')
    {
        if (!(isset($array[$key]) || array_key_exists($key, $array))) {
            static::reportInvalidArgument(sprintf(
                $message ?: 'Данный ключ не найдет в указанном массиве: %s',
                static::valueToString($key)
            ));
        }
    }
    
    /**
     * Привести значение к строке
     *
     * @param $value
     * @return string
     */
    protected static function valueToString($value)
    {
        if (null === $value) {
            return 'null';
        }
        
        if (true === $value) {
            return 'true';
        }
        
        if (false === $value) {
            return 'false';
        }
        
        if (is_array($value)) {
            return 'array';
        }
        
        if (is_object($value)) {
            if (method_exists($value, '__toString')) {
                return get_class($value).': '.self::valueToString($value->__toString());
            }
            
            return get_class($value);
        }
        
        if (is_resource($value)) {
            return 'resource';
        }
        
        if (is_string($value)) {
            return '"'.$value.'"';
        }
        
        return (string) $value;
    }
    
    /**
     * @param $value
     * @return string
     */
    protected static function typeToString($value)
    {
        return is_object($value) ? get_class($value) : gettype($value);
    }
    
    /**
     * Сообщить об ошибке
     *
     * @param $message
     * @throws TBError
     */
    protected static function reportInvalidArgument($message)
    {
        throw new TBError($message);
    }
    
    private function __construct() {}
}
