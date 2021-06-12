<?php

namespace App\Repositories\Traits;

use App\Exceptions\TBError;


/**
 * todo: Trait only for Repository children!
 *
 * Trait BaseRepositoryMethodsTrait
 * @package App\Repositories\Traits
 *
 * @property $model
 * @property $user
 */
trait BaseRepositoryMethodsTrait {
    /**
     * @param int $id
     * @return array
     */
    public function one(int $id) {
        return $this->getModel($id)->model;
    }
    
    /**
     * @return array
     */
    public function all()
    {
        return get_class($this->model)::orderBy('created_at', 'desc')->get();
    }
    
    /**
     * @param array $data
     * @return mixed
     */
    public function save(array $data)
    {
        return $this->getModel($data['id'])
            ->fillModelFromArray($data)
            ->saveModel()
            ->model
            ->id;
    }
    
    /**
     * @param int $id
     * @return int
     * @throws TBError
     */
    public function delete(int $id): int
    {
        $this->getModel($id);
        
        if (! $this->model->delete()) {
            throw new TBError(TBError::DELETE_ERROR);
        }
        
        return $this->model->id;
    }
}