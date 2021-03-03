<?php
	
namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Note as Model;

/**
 * Class NoteRepository
 * @package App\Repositories
 */
class NoteRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Model::class;
    }
    
    /**
     * Сохранить заметку
     *
     * @param array $data
     * @return bool
     * @throws TBError
     */
    public function save(array $data)
    {
        /**
         * @type Model $model
         */
        $model = $this->getModel($data['id']);
    
        $model->title        = $data['title'];
        $model->text         = $data['text'];
        $model->interest     = $data['interest'];
        $model->is_published = (bool) $data['is_published'];
        $model->user_id      = $this->user->id;
    
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $model->id;
    }
}