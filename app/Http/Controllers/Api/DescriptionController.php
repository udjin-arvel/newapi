<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\CompositionFilter;
use App\Http\Filters\DescriptionFilter;
use App\Http\Requests\DescriptionRequest;
use App\Http\Resources\DescriptionResource;
use App\Models\Description;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class DescriptionController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class DescriptionController extends Controller
{
	/**
	 * @param CompositionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(DescriptionFilter $filter)
	{
		return DescriptionResource::collection(
			Description::filter($filter)
				->byUser()
				->with(['user', 'tags'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return DescriptionResource
	 */
	public function show(int $id)
	{
		return new DescriptionResource(
			Description::findOrFail($id)->load(['user', 'tags', 'content'])
		);
	}
	
	/**
	 * @param DescriptionRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(DescriptionRequest $request)
	{
		$description = Description::create($request->all());
		
		if ($request->has('tags')) {
			$description->tags()->attach($request->get('tags'));
		}
		
		return (new DescriptionResource($description))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param DescriptionRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(DescriptionRequest $request, int $id)
	{
		$description = Description::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$description->syncTags($request->get('tags'));
		}
		
		return (new DescriptionResource($description))
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
		Description::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
