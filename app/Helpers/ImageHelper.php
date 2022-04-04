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
		'small'  => 320,
		'medium' => 720,
	];
	
	/**
	 * Качество превьюшек
	 */
	const PREVIEW_QUALITY = [
		'small'  => 80,
		'medium' => 90,
	];
	
	/**
	 * Допустимые mime-type изображений
	 */
	const ALLOWED_MIMES = [
		'image/jpeg',
		'image/png',
		'image/gif',
		'image/webp',
	];
	
	/**
	 * Сделать превьюшки изображения
	 *
	 * @param string $filename
	 * @return bool
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public static function previewResize(string $filename): bool
	{
		$mimeType = Storage::mimeType($filename);
		
		if (!in_array($mimeType, self::ALLOWED_MIMES)) {
			return false;
		}
		
		$image = Image::make(Storage::get($filename));
		
		foreach (self::PREVIEW_SIZES as $size => $width) {
			$previewPath = storage_path('app/tb/' . $size . '_' . $filename);
			$image
				->resize($width, null, function ($constraint) {
					optional($constraint)->aspectRatio();
					optional($constraint)->upsize();
				})
				->save($previewPath, self::PREVIEW_QUALITY[$size]);
		}
		
		return true;
	}
	
//	/**
//	 * Получить полный путь до постера
//	 *
//	 * @param string|null $filename
//	 * @return string
//	 */
//	public static function getImageUrl($filename)
//	{
//		return $filename ? request()->root() . '/file/' . $filename : '';
//	}
	
	/**
	 * Сохранить изображение из base64 строки
	 *
	 * @param string $base64
	 * @return string
	 */
	public static function saveImageFromBase64(string $base64): string
	{
		$imageBody = explode(',', $base64);
		
		if (isset($imageBody[1])) {
			$filename = uniqid() . '.' . explode('/', mime_content_type($base64))[1];
			$content  = base64_decode($imageBody[1]);
			
			if (Storage::put($filename, $content)) {
				dispatch((new ImageResize($filename)));
				return $filename;
			}
		}
		
		Log::error('Не удалось сохранить файл из base64: ' . $base64);
		return '';
	}
	
	/**
	 * Удалить все связанные изображения
	 *
	 * @param string $filename
	 * @return bool
	 */
	public static function deleteImageWithThumbnails($filename): bool
	{
		if (! $filename) {
			return true;
		}
		
		$files = [$filename];
		foreach (array_keys(self::PREVIEW_SIZES) as $size) {
			$files[] = "{$size}_{$filename}";
		}
		
		return Storage::delete($files);
	}
}
