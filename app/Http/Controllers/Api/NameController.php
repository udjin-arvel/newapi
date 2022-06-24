<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\NameRequest;
use App\Http\Resources\NameResource;
use App\Models\Name;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NameController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NameController extends Controller
{
	/**
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index()
	{
		return NameResource::collection(Name::all());
	}
	
	/**
	 * @param int $id
	 * @return NameResource
	 */
	public function show(int $id)
	{
		return new NameResource(
			Name::findOrFail($id)
		);
	}
	
	/**
	 * @param NameRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NameRequest $request)
	{
		$model = Name::create($request->all());
		
		return (new NameResource($model))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param NameRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(NameRequest $request, int $id)
	{
		$model = Name::findOrFail($id)->update($request->all());
		
		return (new NameResource($model))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Exception
	 */
	public function destroy(int $id)
	{
		Name::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
	
	/**
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function useName(int $id)
	{
		$model = Name::findOrFail($id);
		$model->is_used = ! $model->is_used;
		$model->save();
		
		return (new NameResource($model))
			->response()
			->setStatusCode(200);
	}
}
