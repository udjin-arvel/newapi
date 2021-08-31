<?php

namespace App\Http\Controllers\Api;

use App\Http\Filters\NotionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotionPostRequest;
use App\Http\Resources\NotionResource;
use App\Models\Notion;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NotionController extends Controller
{
	/**
	 * @param NotionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(NotionFilter $filter)
	{
		return NotionResource::collection(
			Notion::filter($filter)
				->with(['user', 'tags'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return NotionResource
	 */
	public function show(int $id)
	{
		return new NotionResource(
			Notion::findOrFail($id)->load(['user', 'tags'])
		);
	}
	
	/**
	 * @param NotionPostRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NotionPostRequest $request)
	{
		$notion = Notion::create($request->all());
		
		if ($request->has('tags')) {
			$notion->tags()->attach($request->get('tags'));
		}
		
		return (new NotionResource($notion))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param NotionPostRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(NotionPostRequest $request, int $id)
	{
		$notion = Notion::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$notion->syncTags($request->get('tags'));
		}
		
		return (new NotionResource($notion))
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
		Notion::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
