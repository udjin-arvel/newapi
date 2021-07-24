<?php

namespace App\Libraries;

/**
 * Класс с различными вспомогательными функциями
 * Class Tools
 */
class Tools {
	/**
	 * Превращение строки в тэг
	 *
	 * @param string $string
	 * @return string
	 */
	public static function tagized(string $string): string
	{
		return strtolower(preg_replace('![\s]+!', "_", $string));
	}
	
	/**
	 * Превращение строки в тэг
	 *
	 * @param string $text
	 * @param int $wordsCount
	 * @return string
	 */
	public static function cutOffByWords(string $text, int $wordsCount = 20): string
	{
		return Str::words($text, $wordsCount);
	}
	
	/**
	 * Метод заворачивает массив в объект
	 *
	 * @param array $data
	 * @return stdClass
	 */
	public static function arrayToObject(array $data): stdClass
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