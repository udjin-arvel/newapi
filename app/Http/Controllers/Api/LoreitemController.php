<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\GalleryUploadTrait;
use App\Http\Filters\LoreItemFilter;
use App\Http\Requests\LoreItemRequest;
use App\Http\Resources\LoreItemResource;
use App\Models\LoreItem;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LoreItemController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class LoreitemController extends Controller
{
	use GalleryUploadTrait;
	
	/**
	 * @var string
	 */
	protected $directory = 'lore';
	
	/**
	 * @var string
	 */
	protected $model = LoreItem::class;
	
	/**
	 * @param LoreItemFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(LoreItemFilter $filter)
	{
		return LoreItemResource::collection(
			LoreItem::filter($filter)
				->with(['user', 'tags', 'images'])
				->get()
		);
	}
	
	/**
	 * @param int $id
	 * @return LoreItemResource
	 */
	public function show(int $id)
	{
		return new LoreItemResource(
			LoreItem::findOrFail($id)->load(['user', 'tags', 'images'])
		);
	}
	
	/**
	 * @param LoreItemRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(LoreItemRequest $request)
	{
		$loreItem = LoreItem::create($request->all());
		
		if ($request->has('tags')) {
			$loreItem->tags()->attach($request->get('tags'));
		}
		
		return (new LoreItemResource($loreItem->load(['user', 'tags'])))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param LoreItemRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(LoreItemRequest $request, int $id)
	{
		$loreItem = LoreItem::findOrFail($id)->update($request->all());
		
		if ($request->has('tags')) {
			$loreItem->syncTags($request->get('tags'));
		}
		
		return (new LoreItemResource($loreItem->load(['user', 'tags'])))
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
        $model = LoreItem::findOrFail($id)
            ->with('images')
            ->first();
        
        $this->removeContentGallery($model);
        $model->delete();
        
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
