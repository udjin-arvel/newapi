<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\CompositionFilter;
use App\Http\Requests\CompositionRequest;
use App\Http\Resources\CompositionResource;
use App\Models\Composition;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CompositionController extends Controller
{
	/**
	 * @param CompositionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(CompositionFilter $filter)
	{
		return CompositionResource::collection(
			Composition::filter($filter)
				->with(['user', 'tags', 'likes'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return CompositionResource
	 */
	public function show(int $id)
	{
		return new CompositionResource(
			Composition::findOrFail($id)->load(['user', 'tags'])
		);
	}
	
	/**
	 * @param CompositionRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CompositionRequest $request)
	{
		$loreItem = Composition::create($request->all());
		
		if ($request->has('tags')) {
			$loreItem->tags()->attach($request->get('tags'));
		}
		
		return (new CompositionResource($loreItem))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param CompositionRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(CompositionRequest $request, int $id)
	{
		$notion = Composition::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$notion->syncTags($request->get('tags'));
		}
		
		return (new CompositionResource($notion))
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
		Composition::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
