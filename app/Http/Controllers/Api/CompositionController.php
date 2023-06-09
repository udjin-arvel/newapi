<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GalleryUploadTrait;
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
    use GalleryUploadTrait;
    
    /**
     * @var string
     */
    protected $directory = 'compositions';
    
    /**
     * @var string
     */
    protected $model = Composition::class;
    
    
	/**
	 * @param CompositionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(CompositionFilter $filter)
	{
		return CompositionResource::collection(
			Composition::filter($filter)
				->with(['user', 'tags', 'likes', 'images'])
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
			Composition::findOrFail($id)->load(['stories', 'user', 'tags', 'likes', 'images'])
		);
	}
	
	/**
	 * @param CompositionRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CompositionRequest $request)
	{
		$composition = Composition::create($request->all());
		
		if ($request->has('tags')) {
			$composition->tags()->attach($request->get('tags'));
		}
		
		return (new CompositionResource($composition))
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
		$composition = Composition::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$composition->syncTags($request->get('tags'));
		}
		
		return (new CompositionResource($composition))
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
