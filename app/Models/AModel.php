<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Storage;
use Log;
use Schema;

/**
 * Class AModel
 * @package App\Models
 *
 * @property string $poster
 */
class AModel extends Model {
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
    
        static::creating(function (Model $model) {
            /**
             * @var AModel $model
             */
            if (isset($model->poster)) {
                $model->poster = Image::storedImageFromBase64($model->poster);
            }
        });
    
        static::updating(function ($model) {
            /**
             * @var AModel $model
             */
            if (Schema::hasColumn($model->getTable(), 'poster')
                && $model->poster !== $model->getOriginal('poster'))
            {
                if ($model->getOriginal('poster') && !Image::deleteImage($model->poster)) {
                    Log::warning("Изображение ({$model->poster}) не было удалено.");
                }
            
                $model->poster = Image::storedImageFromBase64($model->poster);
            }
        });
    
        static::deleting(function ($model) {
            /**
             * @var AModel $model
             */
            if (isset($model->poster)) {
                Storage::disk('public')->delete($model->poster);
            }
        });
    }
}