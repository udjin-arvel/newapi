<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Correction as Model;

/**
 * Class CorrectionRepository
 * @package App\Repositories
 */
class CorrectionRepository extends Repository
{
    /**
     * @return mixed|string
     */
    protected function getModelClass() {
        return Model::class;
    }
    
    /**
     * @param mixed $data
     * @return Model
     * @throws TBError
     */
    public function save(array $data)
    {
        $dataForSave = [
          'correction' => $data['fixedWord'],
          'comment' => $data['comment'],
          'supposed_offset' => $data['supposedOffset'],
          'story_id' => $data['storyId'],
          'fragment_id' => $data['fragmentId'],
        ];
    
        $model = new Model;
        $model->setRawAttributes($dataForSave);
    
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $model;
    }
}