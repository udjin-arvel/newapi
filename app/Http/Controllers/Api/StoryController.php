<?php

namespace App\Http\Controllers\Api;

use App\Events\NewsProcessed;
use App\Events\RewardProcessed;
use App\Events\ViewProcessed;
use App\Http\Controllers\Controller;
use App\Http\Filters\StoryFilter;
use App\Http\Requests\StoryRequest;
use App\Http\Resources\StoryResource;
use App\Models\Composition;
use App\Models\News;
use App\Models\Story;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Resources\Json\JsonResource;
use Log;

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
				->with(['user', 'tags', 'composition', 'likes', 'fragments'])
				->orderByDesc('chapter')
				->orderByDesc('created_at')
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
			'reminders',
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
        $story->fragments()->createMany($request->get('fragments'));
        
		if ($request->has('composition')) {
		    $story->assignComposition($request->get('composition'));
        }
		if ($request->has('descriptions')) {
			$story->syncDescriptions($request->get('descriptions'));
		}
		if ($request->has('tags')) {
			$story->tags()->attach($request->get('tags'));
		}
        if ($request->has('reminders')) {
            $story->reminders()->createMany($request->get('reminders'));
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
		$story = Story::where('id', $id)
			->with(['tags', 'descriptions', 'fragments'])
			->first()
			->assignComposition($request->get('composition'))
			->syncFragments($request->get('fragments'))
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
		$model = Story::findOrFail($id);
		$model->syncDescriptions(null)->syncTags(null)->delete();
		
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
    
    /**
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     * @throws \Exception
     */
	public function getAdjacentChapters(int $compositionId, int $storyId)
    {
        $composition = Composition::findOrFail($compositionId)
            ->with('stories')
            ->first();
    
        $prev = $next = [];
        $stories = $composition->stories()->orderBy('chapter')->get()->toArray();
        
        foreach ($stories as $key => $story) {
            if ($story['id'] === $storyId) {
                if (isset($stories[$key - 1])) {
                    $prev = [
                        'id' => $stories[$key - 1]['id'],
                        'title' => $stories[$key - 1]['title'],
                        'chapter' => $stories[$key - 1]['chapter'],
                    ];
                }
                
                if (isset($stories[$key + 1])) {
                    $next = [
                        'id' => $stories[$key + 1]['id'],
                        'title' => $stories[$key + 1]['title'],
                        'chapter' => $stories[$key - 1]['chapter'],
                    ];
                }
                
                break;
            }
        }
        
        return (new JsonResource([
            'prev' => $prev,
            'next' => $next,
        ]))
            ->response()
            ->setStatusCode(200);
    }
}
