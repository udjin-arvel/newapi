<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;


/**
 * Class Image
 * @package App\Models
 *
 * @property int    $id
 * @property string $path
 * @property int    $content_id
 * @property int    $user_id
 * @property string $content_type
 */
class Image extends Model
{
    const TYPE_NOTION = 'type-notion';
    
    /**
     * Сохранить изображение из base64 строки
     *
     * @param {string} $base64_string
     * @return string
     */
	public static function storedImageFromBase64($base64_string)
	{
	    if (!self::isImageInBase64($base64_string)) {
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
    public static function deleteImage($path)
    {
        return Storage::disk('public')->delete($path);
    }
}
