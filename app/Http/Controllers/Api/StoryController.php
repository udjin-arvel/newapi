<?php

namespace App\Http\Controllers\Api;

use App\Events\NewsProcessed;
use App\Events\RewardProcessed;
use App\Events\ViewProcessed;
use App\Http\Controllers\Controller;
use App\Http\Filters\StoryFilter;
use App\Http\Requests\StoryRequest;
use App\Http\Resources\StoryResource;
use App\Models\News;
use App\Models\Story;
use Illuminate\Database\Eloquent\Relations\HasMany;
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
				->isPublic()
				->with(['user', 'tags', 'composition', 'likes', 'fragments' => function(HasMany $query) {
					return $query->take(3);
				}])
				->orderBy('created_at', 'desc')
				->paginate(request()->get('perPage', config('tb.pageSize.middle')))
		);
	}
	
	/**
	 * @param int $id
	 * @return StoryResource
	 */
	public function show(int $id)
	{
		$story = Story::findOrFail($id)->load([
			'user',
			'tags',
			'fragments',
			'composition',
			'descriptions',
			'comments',
			'likesAndDislikes',
		]);
		
		event(new ViewProcessed($story));
		return new StoryResource($story);
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
		
		event(new NewsProcessed($story, News::ACTION_CREATE));
		event(new RewardProcessed($story));
		
		return (new StoryResource($story->load(['user', 'tags', 'composition', 'fragments'])))
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
			->first()
			->syncTags($request->get('tags'))
			->syncDescriptions($request->get('descriptions'))
			->update($request->all());
		
		event(new NewsProcessed($story, News::ACTION_UPDATE));
		
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
			->setStatusCode(204);
	}
}
