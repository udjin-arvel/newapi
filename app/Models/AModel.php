<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Helpers\ImageHelper;
use Log;
use Schema;

/**
 * Class AModel
 * @package App\Models
 *
 * @property string $poster
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AModel extends Model {
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    public static function boot()
    {
        parent::boot();
    
        static::creating(function (self $model) {
            /**
             * @var AModel $model
             */
            if (isset($model->poster)) {
                $model->poster = ImageHelper::store($model->poster);
            }
            
            // $model->created_at = now();
        });
    
        static::updating(function (self $model) {
            /**
             * @var AModel $model
             */
            if (Schema::hasColumn($model->getTable(), 'poster')
                && $model->poster !== $model->getOriginal('poster'))
            {
                if ($model->getOriginal('poster') && !ImageHelper::deleteImages($model->poster)) {
                    Log::warning("Изображение ({$model->poster}) не было удалено.");
                }
            
                $model->poster = ImageHelper::store($model->poster);
            }
    
            // $model->updated_at = now();
        });
    
        static::deleting(function (self $model) {
            /**
             * @var AModel $model
             */
            if (!empty($model->poster)) {
                ImageHelper::deleteImages($model->poster);
            }
        });
    }
}