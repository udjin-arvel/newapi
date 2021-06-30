<?php

namespace App\Repositories\Traits;

use App\Exceptions\TBError;
use DB;
use Log;
use Mockery\Exception;


/**
 * !!! Only Repository Trait !!!
 *
 * Trait MassSaveTrait
 * @package App\Repositories\Traits
 *
 * @property $model
 * @property $user
 */
trait MassSaveTrait {
    /**
     * @var string
     */
    protected $relatedField = 'story_id'; // Массовое сохранение нужно только для отношений сущности Story
    
    /**
     * Статический прокси для massSave метода
     *
     * @param int $relatedId
     * @param array $data
     * @param string $table
     * @param string $pivotKey
     * @throws TBError
     */
    public function massSaveProvider(int $relatedId, array $data = [], string $table = '', $pivotKey = '')
    {
        $this->massSave($relatedId, $data, $table, $pivotKey);
    }
    
    /**
     * @param int $relatedId
     * @param array $data
     * @param string $table
     * @param string $pivotKey
     * @return mixed
     * @throws TBError
     */
    public function massSave(int $relatedId, array $data = [], string $table = '', $pivotKey = '')
    {
        try {
            // Если существует $table, значит отношение ManyToMany и сохранение идет в смежную таблицу
            $isManyToManyRelation = (bool) $table;
            $table = $table ?: $this->model->getTable();
    
            DB::table($table)->where($this->relatedField, $relatedId)->delete();
            
            if (!empty($data)) {
                foreach ($data as $idOrArray) {
                    if ($isManyToManyRelation) {
                        DB::table($table)->insert([$this->relatedField => $relatedId, $pivotKey => $idOrArray]);
                    } else {
                        $this->fillModelFromArray($idOrArray)->saveModel();
                    }
                }
            }
        } catch (Exception $e) {
            Log::error('Не удалось произвести массовое сохранение. Причина: ' . $e->getMessage());
            throw new TBError(TBError::MASS_SAVING_ERROR);
        }
    }
}