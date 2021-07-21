<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Log;

/**
 * Class AModel
 * @package App\Models
 *
 * @property int    $id
 * @property int    $user_id
 * @property string $poster
 * @property Carbon $created_at
 * @property Carbon $updated_at
 *
 * @mixin \Eloquent
 */
class AModel extends Model {
    /**
     * @var array
     */
    protected $related = [];
    
    /**
     * @var array
     */
    protected $contracts = [];
    
    /**
     * @return Collection
     */
    public function contracts(): Collection
    {
        return collect($this->contracts)->map(function ($contractClass) {
            return new $contractClass;
        });
    }
    
    /**
     * @param string $contract
     * @return bool
     */
    public function hasContract(string $contract): bool
    {
        return $this->contracts()->has($contract);
    }
    
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
//    protected static function boot()
//    {
//        parent::boot();
//
//        static::creating(function (self $model) {
//            /**
//             * @var AModel $model
//             */
//            if (!empty($model->poster)) {
//                $model->poster = ImageHelper::store($model->poster);
//            }
//
//            if (isset($model->user_id)) {
//                $model->user_id = optional(\Auth::user())->id;
//            }
//        });
//
//        static::updating(function (self $model) {
//            /**
//             * @var AModel $model
//             */
//            if (isset($model->poster) && $model->poster !== $model->getOriginal('poster'))
//            {
//                if ($model->getOriginal('poster') && !ImageHelper::deleteImages($model->poster)) {
//                    Log::warning("Изображение ({$model->poster}) не было удалено.");
//                }
//
//                $model->poster = ImageHelper::store($model->poster);
//            }
//        });
//
//        static::deleting(function (self $model) {
//            /**
//             * @var AModel $model
//             */
//            if (!empty($model->poster)) {
//                ImageHelper::deleteImages($model->poster);
//            }
//        });
//    }
    
    /**
     * Сохранить связанные модели
     *
     * @param array $data
     * @return bool
     */
    public function storeRelations(array $data): bool
    {
        try {
            foreach ($this->related as $relation) {
                $relationData = $data[$relation];
                
                if (!empty($relationData) && is_array($relationData)) {
                    if (is_array($relationData[0])) {
                        $this->{$relation}()->createMany($relationData);
                    } else if (is_int($relationData[0])) {
                        $this->{$relation}()->attach($relationData);
                    }
                }
            }
        } catch (\Exception $e) {
            Log::error('Возникла ошибка при сохранении связанных моделей:' . $e->getMessage());
            return false;
        }
        
        return true;
    }
}