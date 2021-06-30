<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\AModel;
use App\Models\Player;
use App\Models\User;
use Auth;
use Schema;

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
abstract class Repository
{
    /**
     * @var AModel
     */
    protected $model;
    
    /**
     * @var User
     */
    protected $user;
    
    /**
     * Repository constructor.
     */
    public function __construct()
    {
        $this->model = app($this->getModelClass());
        $this->user  = Auth::user();
    }
    
    /**
     * @return string
     */
    abstract protected function getModelClass(): string;
    
    /**
     * Получить конкретную модель или экземпляр
     *
     * @param int $id
     * @return self
     */
    protected function take(int $id = null): self
    {
        if (is_null($id)) {
            return $this;
        }
        
        $this->model = $this->model::where(['id' => $id])->first();
    
        if (null === $this->model) {
            $this->model = app($this->getModelClass());
        }
        
        return $this;
    }
    
    /**
     * @param array $data
     * @return self
     * @throws TBError
     */
    protected function store(array $data): self
    {
        $this->model->fill($data);
        
        if (! ($this->model->save() && $this->model->storeRelations($data))) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $this;
    }
    
    /**
     * @return AModel
     */
    protected function model()
    {
        return optional($this->model);
    }
}