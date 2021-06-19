<?php

namespace App\Helpers;

use App\Exceptions\TBError;
use Config;
use Image;

class ImageHelper {
    /**
     * Mimes
     */
    const MIME_JPG  = 'image/jpg';
    const MIME_JPEG = 'image/jpeg';
    const MIME_PNG  = 'image/png';
    
    /**
     * Sizes
     */
    const IMAGE_SIZES = [
        'large'  => 960,
        'medium' => 480,
        'small'  => 240,
    ];
    
    /**
     * Max file size
     */
    const MAX_FILE_SIZE = 20 * 1024 * 1024;
    
    /**
     * Сохранить изображение из base64 строки
     *
     * @param string $base64_string
     * @return string
     * @throws TBError
     */
    public static function store(string $base64_string): string
    {
        if (false === strripos($base64_string, 'base64')) {
            return $base64_string;
        }
        
        $data        = explode(',', $base64_string);
        $image       = Image::make(base64_decode($data[1]));
        $type        = self::getImageTypeByMime($image->mime());
        $filename    = uniqid() . '.' . $type;
        $storagePath = self::getImagesStoragePath();
        $path        = $storagePath . $filename;
        
        $image->save($path);
        
        if ($image->filesize() > self::MAX_FILE_SIZE) {
            self::deleteImages($filename);
            throw new TBError(TBError::BIG_FILE);
        }
        
        foreach (self::IMAGE_SIZES as $size => $width) {
            if ($image->width() > $width) {
                $path = $storagePath . $size . '.' . $filename;
                
                $image->resize($width, null,
                    function ($constraint) {
                        optional($constraint)->aspectRatio();
                        optional($constraint)->upsize();
                    })
                    ->save($path, 85); // можно вынести в константу, но большой нужды нет
            }
        }
        
        return $filename;
    }
    
    /**
     * Удалить изображения
     *
     * @param string $filename
     * @return bool
     */
    public static function deleteImages(string $filename): bool
    {
        $storagePath = self::getImagesStoragePath();
        
        foreach (self::IMAGE_SIZES as $size => $width) {
            $path = $storagePath . $size . '.' . $filename;
            if (is_file($path)) {
                unlink($path);
            }
        }
    
        $imageOriginal = $storagePath . $filename;
        if (is_file($imageOriginal)) {
            unlink($imageOriginal);
        }
        
        return true;
    }
    
    /**
     * @param string $mime
     * @return string
     * @throws TBError
     */
    public static function getImageTypeByMime(string $mime): string
    {
        switch ($mime) {
            case self::MIME_JPEG: return 'jpeg';
            case self::MIME_JPG: return 'jpg';
            case self::MIME_PNG: return 'png';
        }
        
        throw new TBError(TBError::WRONG_IMAGE_MIME);
    }
    
    /**
     * @return string
     */
    public static function getImagesStoragePath(): string
    {
        return public_path(Config::get('app.path.images').'/');
    }
}