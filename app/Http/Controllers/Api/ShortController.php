<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\LoreItemFilter;
use App\Http\Filters\ShortFilter;
use App\Http\Requests\LoreItemRequest;
use App\Http\Requests\ShortRequest;
use App\Http\Resources\LoreItemResource;
use App\Http\Resources\ShortResource;
use App\Models\LoreItem;
use App\Models\Short;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class ShortController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class ShortController extends Controller
{
	/**
	 * @param ShortFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(ShortFilter $filter)
	{
		return ShortResource::collection(
			Short::filter($filter)
				->with(['user', 'tags'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return ShortResource
	 */
	public function show(int $id)
	{
		return new ShortResource(
			Short::findOrFail($id)->load(['user', 'tags'])
		);
	}
	
	/**
	 * @param ShortRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(ShortRequest $request)
	{
		$short = Short::create($request->all());
		
		if ($request->has('tags')) {
			$short->tags()->attach($request->get('tags'));
		}
		
		return (new ShortResource($short))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param ShortRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(ShortRequest $request, int $id)
	{
		$short = Short::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$short->syncTags($request->get('tags'));
		}
		
		return (new ShortResource($short))
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
		Short::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
