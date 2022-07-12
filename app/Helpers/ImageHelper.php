<?php

namespace App\Helpers;

use App\Jobs\ImageResize;
use Illuminate\Http\UploadedFile;
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
	 * @param string $directory
	 *
	 * @return bool
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public static function previewResize(string $filename, string $directory = ''): bool
	{
		$fullPath = $directory ? $directory . DIRECTORY_SEPARATOR .  $filename : $filename;
		
		if (! Storage::exists($fullPath)) {
			return false;
		}
		
		$mimeType = Storage::mimeType($fullPath);
		
		if (!in_array($mimeType, self::ALLOWED_MIMES)) {
			return false;
		}
		
		$path = Storage::path($directory);
		$image = Image::make(Storage::get($fullPath));
		
		foreach (self::PREVIEW_SIZES as $size => $width) {
			$previewPath = $path . $size . '_' . $filename;
			$image
				->resize($width, null, function ($constraint) {
					optional($constraint)->aspectRatio();
					optional($constraint)->upsize();
				})
				->save($previewPath, self::PREVIEW_QUALITY[$size]);
		}
		
		return true;
	}
	
	/**
	 * Сохранить и отресайзить файл
	 *
	 * @param UploadedFile $file
	 * @param string $directory
	 *
	 * @return string
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public static function saveFileAndResize(UploadedFile $file, string $directory = ''): string
	{
		$directory = $directory ? $directory . DIRECTORY_SEPARATOR : '';
		$filename = uniqid() . '.' . $file->getClientOriginalExtension();
		
		$file->storeAs($directory, $filename);
		self::previewResize($filename, $directory);
		// dispatch((new ImageResize($filename)));
		
		return $filename;
	}
	
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
	 * @param string $directory
	 *
	 * @return bool
	 */
	public static function deleteImageWithThumbnails($filename, $directory = ''): bool
	{
		if (! $filename) {
			return true;
		}
		
		$directory = $directory ? $directory . DIRECTORY_SEPARATOR : '';
		$files = [$directory . $filename];
		
		foreach (array_keys(self::PREVIEW_SIZES) as $size) {
			$files[] = "{$directory}{$size}_{$filename}";
		}
		
		return Storage::delete($files);
	}
}
