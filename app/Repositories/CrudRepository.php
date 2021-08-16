<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Http\Filters\Filter;
use App\Models\AModel;
use App\Models\Interfaces\PosterableInterface;
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
class CrudRepository
{
    /**
     * @var AModel
     */
    protected $model;
    
    /**
     * Repository constructor.
     * @param string $modelClass
     */
    public function __construct(string $modelClass)
    {
        $this->model = app($modelClass);
    }
    
    /**
     * Получить конкретную модель или экземпляр
     *
     * @param int $id
     * @param array $withModels
     * @return self
     * @throws TBError
     */
    protected function take(int $id = null, array $withModels = []): self
    {
        if (is_null($id)) {
            return $this;
        }
        
        $taking = $this->model::where(['id' => $id]);
        
        if (count($withModels)) {
            $taking = $taking->with($withModels);
        }
        
        $taking = $taking->first();
        
        if (null === $taking) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        $this->model = $taking;
        
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
	    $this->model->user_id = \Auth::id();
     
	    if ($this->model instanceof PosterableInterface) {
		    $this->model->storePoster();
	    }
        
        if (!$this->model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
        
        if (method_exists($this->model, 'storeRelations')
            && !$this->model->storeRelations($data)
        ) {
            throw new TBError(TBError::MODEL_ERROR);
        }
        
        return $this;
    }
    
    /**
     * @return AModel
     */
    public function model()
    {
        return $this->model;
    }
    
    /**
     * Получить одну модель
     *
     * @param int $id
     * @param array $withModels
     * @return Model
     * @throws TBError
     */
    public function one(int $id, array $withModels = [])
    {
        return $this->take($id, $withModels)->model;
    }
    
    /**
     * @param Filter $filter
     * @return Collection
     */
    public function all(Filter $filter = null)
    {
        /**
         * @var \Eloquent $query
         */
        $query = $this->model::orderBy('created_at', 'desc');
    
        if (null !== $filter) {
            $query = $filter->addFiltersToQuery($query);
        }
        if (!empty($this->model->related())) {
            $query = $query->with($this->model->related());
        }
        
        return $query->get();
    }
    
    /**
     * @param array $data
     * @return int
     * @throws TBError
     */
    public function save(array $data): int
    {
        return $this
            ->take($data['id'] ?? null)
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
        if (!$this->take($id)->model()->delete()) {
            throw new TBError(TBError::DELETE_ERROR);
        }
        
        return $this->model()->id;
    }
}