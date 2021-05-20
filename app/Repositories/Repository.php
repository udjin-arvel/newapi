<?php

namespace App\Repositories;

use App\Exceptions\TBError;
use App\Models\Player;
use App\Models\Story;
use App\Models\User;
use Auth;
use Illuminate\Database\Eloquent\Model;
use Schema;

/**
 * Репозиторий для выдачи наборов данных сущности.
 *
 * Class Repository
 *
 * @package App\Repositories
 *
 * @method static void massSave(int $relatedId, array $data, string $table, string $pivotKey)
 * @method public Repository delete(int $id)
 *
 * @property Model|Story $model
 * @property User $user
 * @property Player $player
 */
abstract class Repository
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
     * @return Repository
     */
    public static function getInstance(): Repository
    {
        $className = static::class;
        return new $className;
    }
	
    /**
     * Статический вызов публичного метода
     *
     * @param string $method
     * @param mixed $params
     * @return mixed
     * @throws TBError
     */
    public static function call(string $method, ...$params)
    {
        $model = self::getInstance();
        
        if (! method_exists($model, $method)) {
            throw new TBError(TBError::METHOD_NOT_EXIST);
        }
        
        return $model->{$method}(...$params);
    }
    
    /**
     * Получить конкретную модель или экземпляр
     *
     * @param int $id
     * @param bool $emptyIdAllow
     * @return Repository
     * @throws TBError
     */
    public function getModel(int $id = null, bool $emptyIdAllow = true): Repository
    {
        if (! empty($id)) {
            $this->model = get_class($this->model)::where(['id' => $id])->first();
            
            if (null === $this->model) {
                throw new TBError(TBError::CONTENT_NOT_FOUND);
            }
        } elseif (! $emptyIdAllow) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        return $this;
    }
    
    /**
     * @param $data
     * @return Repository
     * @throws TBError
     */
    public function fillModelFromArray($data): Repository
    {
        if (empty($this->model)) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        foreach ($data as $key => $input) {
            if (Schema::hasColumn($this->model->getTable(), $key)) {
                $this->model->{$key} = $input;
            }
        }
        
        return $this;
    }
    
    /**
     * @return Repository
     * @throws TBError
     */
    public function saveModel(): Repository
    {
        if (empty($this->model->id)) {
            throw new TBError(TBError::CONTENT_NOT_FOUND);
        }
        
        if (! $this->model->save()) {
            throw new TBError(TBError::SAVE_ERROR);
        }
        
        return $this;
    }
}