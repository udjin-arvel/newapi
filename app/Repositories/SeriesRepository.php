<?php

namespace App\Repositories;

use App\Models\Series;
use App\Exceptions\TBError;

/**
 * Class SeriesRepository
 * @package App\Repositories
 */
class SeriesRepository extends Repository implements Chaptered
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Series::class;
    }
    
    /**
     * Получить экземпляр книги
     *
     * @param int $id
     * @return \Eloquent
     * @throws TBError
     */
    public function one(int $id)
    {
        return $this->getModel($id);
    }
    
    /**
     * Получить список книг\
     * @return array
     */
    public function all(): array
    {
        return Series::orderBy('created_at', 'desc')->get();
    }
    
    /**
     * Получить главы истории
     *
     * @param int $id
     * @return array
     * @throws TBError
     */
    public function getChapters(int $id): array
    {
        /**
         * @type Series $series
         */
        $series = $this->getModel($id);
        $chapters = [];
        
        if (!empty($series->stories)) {
            foreach ($series->stories as $story) {
                $chapters[] = [
                    'id'         => $story->id,
                    'title'      => $story->title,
                    'chapter'    => $story->chapter,
                    'is_project' => false,
                ];
            }
        }
        
        return [
            'id'       => $series->id,
            'title'    => $series->title,
            'chapters' => $chapters,
        ];
    }
    
    /**
     * Сохранить книгу
     *
     * @param array $data
     * @return Series
     * @throws TBError
     */
    public function save(array $data)
    {
        /**
         * @type Series $model
         */
        $model = $this->getModel($data['id']);
        
        $model->title       = $data['title'];
        $model->description = $data['description'];
        $model->user_id     = $this->user->id;
        
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
        
        return $model;
    }
}
