<?php

namespace App\Helpers;

use App\Jobs\ImageResize;
use Image;
use Storage;
use Log;

/**
 * Class Helpers
 * @package App\Helpers
 */
class ImageHelper
{
	/**
	 * Максимальные размеры превью
	 */
	const PREVIEW_SIZES = [
		'small'  => 420,
		'medium' => 960,
		'large'  => 1440,
	];
	
	/**
	 * Качество превьюшек
	 */
	const PREVIEW_QUALITY = [
		'small'  => 75,
		'medium' => 85,
		'large'  => 100,
	];
	
	/**
	 * Допустимые расширения изображений
	 */
	const ALLOWED_IMAGE_EXTENSIONS = [
		'jpg',
		'jpeg',
		'png',
		'gif',
		'webp',
	];
	
	/**
	 * Сделать превьюшки изображения
	 *
	 * @param $directory $path
	 * @param string $filename
	 * @return bool
	 */
	public static function previewResize(string $filename, string $directory): bool
	{
		$directory     = $directory ? $directory . DIRECTORY_SEPARATOR : '';
		$path          = 'storage' . DIRECTORY_SEPARATOR . $directory;
		$imageOriginal = public_path($path . $filename);
		$pathInfo      = pathinfo($imageOriginal);
		
		if (!in_array($pathInfo['extension'], self::ALLOWED_IMAGE_EXTENSIONS)) {
			return false;
		}
		
		$image = Image::make($imageOriginal);
		
		foreach (self::PREVIEW_SIZES as $size => $width) {
			// Путь к превьюшке
			$thumbnailPath = public_path($path . $size . '.' . $filename);
			$image->resize($width, null, function ($constraint) {
					optional($constraint)->aspectRatio();
					optional($constraint)->upsize();
				})
				->save($thumbnailPath, self::PREVIEW_QUALITY[$size]);
		}
		
		return true;
	}
	
	/**
	 * Получить полный путь до постера
	 *
	 * @param string|null $path
	 * @return string
	 */
	public static function getPosterUrl(?string $path)
	{
		if (is_null($path)) {
			return null;
		}
		
		if (isset($_SERVER['REQUEST_SCHEME'], $_SERVER['HTTP_HOST'])) {
			return "{$_SERVER['REQUEST_SCHEME']}://{$_SERVER['HTTP_HOST']}/storage/{$path}";
		}
		
		return env('APP_URL');
	}
	
	/**
	 * Сохранить изображение из base64 строки
	 *
	 * @param {string} $base64_string
	 * @param string $directory
	 * @return string
	 */
	public static function saveFromBase64($base64, $directory = ''): string
	{
		$imageBody = explode(',', $base64);
		
		if (isset($imageBody[1])) {
			$content   = base64_decode($imageBody[1]);
			$filename  = uniqid() . '.' . explode('/', mime_content_type($base64))[1];
			$directory = $directory ? $directory . DIRECTORY_SEPARATOR : '';
			$path      = $directory . $filename;
			
			if (Storage::disk(config('filesystems.disks.default'))->put($path, $content)) {
				dispatch((new ImageResize($filename, $directory)));
				return $path;
			}
		}
		
		Log::error('Не удалось сохранить файл из base64: ' . $base64);
		return '';
	}
	
	/**
	 * Удалить изображение
	 *
	 * @param string $path
	 * @return bool
	 */
	public static function removeFile($path)
	{
		return Storage::disk(config('filesystems.disks.default'))->delete($path);
	}
}
