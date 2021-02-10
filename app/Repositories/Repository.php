<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Player;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

/**
 * Репозиторий для выдачи наборов данных сущности.
 *
 * Class Repository
 *
 * @package App\Repositories
 *
 * @property User $user
 * @property Player $player
 */
abstract class Repository implements IWriteableRepository
{
	/**
	 * @var Model
	 */
	protected $model;
    
    /**
     * @var User
     */
    protected $user;
    
    /**
     * @var Player
     */
    protected $player;
    
    /**
     * Repository constructor.
     */
	public function __construct()
	{
        $this->model  = app($this->getModelClass());
        $this->user   = Auth::user();
        $this->player = $this->user->player;
	}
	
	/**
	 * @return mixed
	 */
	abstract protected function getModelClass();
    
    /**
     * Статический вызов публичного метода
     *
     * @param string $method
     * @return mixed
     * @throws TBError
     */
	public static function call(string $method)
    {
        $className = static::class;
        $model = new $className;

        if (!method_exists($model, $method)) {
            throw new TBError(TBError::METHOD_NOT_EXIST);
        }

        return $model->{$method}();
    }
	
    /**
     * @param array $data
     * @return mixed
     * @throws TBError
     */
    public function save(array $data) {
        $model = $this->getModel($data['id']);
    
        $model->setRawAttributes($data);
        
        if (Schema::hasColumn($model->getTable(), 'user_id')) {
            $model->user_id = $this->user->id;
        }
    
        if (!$model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
    
        return $model->toArray();
    }
    
    /**
     * @param int $id
     * @return array
     * @throws TBError
     */
    public function getOne(int $id) {
        return $this->getModel($id)->toArray();
    }
    
    /**
     * @return array
     * @throws TBError
     */
    public function getAll() {
        $model = get_class($this->model);
        
        $records = $model::select('*')
            ->orderBy('created_at', 'desc')
            ->get();
        
        if (empty($records)) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        return $records;
    }
    
    /**
     * @param int $id
     * @return mixed
     * @throws TBError
     * @throws \Exception
     */
	public function delete(int $id)
    {
        $model = $this->getModel($id);
        
        if (!$model->delete()) {
            throw new TBError(TBError::DELETE_ERROR);
        }
        
        return $model;
    }
    
    /**
     * Получить конкретную модель или экземпляр
     *
     * @param int $id
     * @return \Eloquent
     * @throws TBError
     */
    public function getModel(int $id = null)
    {
        if (empty($id)) {
            $model = new $this->model;
        } else {
            $model = get_class($this->model)::where(['id' => $id])->first();
            
            if (empty($model)) {
                throw new TBError(TBError::CONTENT_NOT_FOUND);
            }
        }
        
        return $model;
    }
}