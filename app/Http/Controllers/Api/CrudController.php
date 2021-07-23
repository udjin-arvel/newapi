<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TBError;
use App\Http\Controllers\Controller;
use App\Http\Filters\Filter;
use App\Http\Resources\BaseResource;
use App\Repositories\CrudRepository;
use Illuminate\Http\JsonResponse;

/**
 * Class CrudController
 * @package App\Http\Controllers
 *
 * @property array $input
 * @property CrudRepository $repository
 * @property string|BaseResource $resourceClass
 */
abstract class CrudController extends Controller
{
    /**
     * @var CrudRepository
     */
    protected $repository;
    
    /**
     * @var string
     */
    protected $resourceClass;
    
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->repository    = new CrudRepository($this->getModelClass());
        $this->resourceClass = $this->getResourceClass();
    }
    
    /**
     * @return string
     */
    abstract protected function getModelClass(): string;
    
    /**
     * @return string|null
     */
    abstract protected function getResourceClass();
    
    /**
     * @return Filter|null
     */
    abstract protected function getFilter();
    
    /**
     * Получить информацию об одной записи
     *
     * @param int $id
     * @return JsonResponse
     * @throws TBError
     */
    public function one(int $id): JsonResponse
    {
        $result = $this->repository->one($id);
    
        event('crud.one', arrayToObject([
            'model'     => $this->repository->model(),
            'viewer_id' => auth()->id(),
        ]));
        
        return $this->sendSuccess(new $this->resourceClass($result));
    }
    
    /**
     * Получить доступные пользователю записи
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        $result = $this->repository->all($this->getFilter());
        return $this->sendSuccess($this->resourceClass::collection($result));
    }
    
    /**
     * Сохранить или изменить запись
     *
     * @return JsonResponse
     * @throws TBError
     */
    public function save(): JsonResponse
    {
        $result = $this->repository->save(request()->all());
        event(request()->get('id') ? 'crud.update' : 'crud.create', $this->repository->model());
        
        return $this->sendSuccess($result);
    }
    
    /**
     * Удалить запись
     *
     * @param int $id
     * @return JsonResponse
     * @throws TBError
     */
    public function delete(int $id): JsonResponse
    {
        $result = $this->repository->delete($id);
        event('crud.delete', $this->repository->model());
        
        return $this->sendSuccess($result);
    }
}
