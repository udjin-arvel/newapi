<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Class Helpers
 * @package App\Helpers
 */
class ImageHelper
{
	/**
	 * Сохранить изображение из base64 строки
	 *
	 * @param {string} $base64_string
	 * @return string
	 */
	public static function store($base64_string)
	{
		if (!$base64_string || !self::isImageInBase64($base64_string)) {
			return $base64_string;
		}
		
		$data = explode(',', $base64_string);
		$type = strripos($data[0], 'png') ? 'png' : 'jpg';
		$name = Str::random(32);
		$path = $name . '.' . $type;
		$content = base64_decode($data[1]);
		
		Storage::disk('public')->put($path, $content);
		
		return $path;
	}
	
	/**
	 * Строка в формате base64
	 *
	 * @param $string
	 * @return bool
	 */
	public static function isImageInBase64($string)
	{
		return false !== strripos($string, 'base64');
	}
	
	/**
	 * Удалить изображение
	 * @param string $path
	 * @return bool
	 */
	public static function delete($path)
	{
		return Storage::disk('public')->delete($path);
	}
}
