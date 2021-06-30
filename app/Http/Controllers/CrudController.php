<?php

namespace App\Http\Controllers;

use App\Exceptions\TBError;
use App\Http\Resources\BaseResource;
use App\Repositories\CrudRepository;
use App\Repositories\Repository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use Illuminate\Http\Response;

/**
 * Class CrudController
 * @package App\Http\Controllers
 *
 * @property array $input
 * @property Repository|CrudRepository $repository
 */
abstract class CrudController extends Controller
{
    /**
     * @var array|Request|string
     */
    protected $input;
    
    /**
     * @var Repository
     */
    protected $repository;
    
    /**
     * BookController constructor.
     */
    public function __construct()
    {
        $this->input      = request()->all();
        $this->repository = $this->getRepository();
    }
    
    /**
     * @return Repository
     */
    abstract protected function getRepository(): Repository;
    
    /**
     * @return Repository
     */
    abstract protected function getResourceClass(): string;
    
    /**
     * Получить информацию об одной записи
     *
     * @param int $id
     * @return JsonResponse
     */
    public function one(int $id): JsonResponse
    {
        $resourceClass = $this->getResourceClass();
        return $this->sendSuccess(new $resourceClass($this->repository->one($id)));
    }
    
    /**
     * Получить доступные пользователю записи
     *
     * @return JsonResponse
     */
    public function all(): JsonResponse
    {
        /**
         * @var BaseResource $resourceClass
         */
        $resourceClass = $this->getResourceClass();
        return $this->sendSuccess($resourceClass::collection($this->repository->all()));
    }
    
    /**
     * Сохранить или изменить запись
     *
     * @return JsonResponse
     * @throws TBError
     */
    public function save(): JsonResponse
    {
        return $this->sendSuccess($this->repository->save($this->input));
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
        return $this->sendSuccess($this->repository->delete($id));
    }
}
