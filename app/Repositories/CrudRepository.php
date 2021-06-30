<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\AModel;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Репозиторий для выдачи наборов данных сущности.
 *
 * Class Repository
 *
 * @package App\Repositories
 *
 * @property AModel $model
 * @property User $user
 * @property Player $player
 */
class CrudRepository extends Repository
{
    /**
     * @return string
     * @throws TBError
     */
    protected function getModelClass(): string
    {
        throw new TBError(TBError::REPOSITORY_ERROR);
    }
    
    /**
     * @param int $id
     * @return Model
     */
    public function one(int $id)
    {
        return $this->take($id)->model;
    }
    
    /**
     * @return Collection
     */
    public function all()
    {
        return $this->model::orderBy('created_at', 'desc')->get();
    }
    
    /**
     * @param array $data
     * @return int
     * @throws TBError
     */
    public function save(array $data): int
    {
        return $this
            ->take($data['id'])
            ->store($data)
            ->model()
            ->id;
    }
    
    /**
     * @param int $id
     * @return int
     * @throws TBError
     * @throws \Exception
     */
    public function delete(int $id): int
    {
        if (! $this->take($id)->model->delete()) {
            throw new TBError(TBError::DELETE_ERROR);
        }
        
        return $this->model->id;
    }
}