<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\StoryFilter;
use App\Http\Requests\StoryRequest;
use App\Http\Resources\StoryResource;
use App\Models\Story;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class StoryController extends Controller
{
	/**
	 * @param StoryFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(StoryFilter $filter)
	{
		return StoryResource::collection(
			Story::filter($filter)
				->with(['user', 'tags', 'fragments', 'composition'])
				->get()
				->map(function ($story) {
					$story->fragments = $story->fragments->slice(0, 3);
					return $story;
				})
		);
	}
	
	/**
	 * @param int $id
	 * @return StoryResource
	 */
	public function show(int $id)
	{
		return new StoryResource(Story::findOrFail($id)
			->load(['user', 'tags', 'fragments', 'composition', 'descriptions'])
		);
	}
	
	/**
	 * @param StoryRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(StoryRequest $request)
	{
		/**
		 * @var Story $story
		 */
		$story = Story::create($request->all());
		
		if ($request->has('fragments')) {
			$story->fragments()->createMany($request->get('fragments'));
		}
		if ($request->has('descriptions')) {
			$story->descriptions()->createMany($request->get('descriptions'));
		}
		if ($request->has('tags')) {
			$story->tags()->attach($request->get('tags'));
		}
		
		return (new StoryResource($story))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param StoryRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(StoryRequest $request, int $id)
	{
		/**
		 * @var Story $story
		 */
		$story = Story::findOrFail($id)
			->with(['tags', 'descriptions'])
			->update($request->all())
			->syncTags($request->get('tags'))
			->syncDescriptions($request->get('descriptions'));
		
		return (new StoryResource($story))
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
		Story::findOrFail($id)
			->with(['tags', 'descriptions'])
			->syncDescriptions(null)
			->syncTags(null)
			->delete();
		
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
