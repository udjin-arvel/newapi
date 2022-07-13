<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageHelper;
use App\Http\Controllers\Controller;
use App\Http\Filters\LoreItemFilter;
use App\Http\Requests\LoreItemRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\LoreItemResource;
use App\Models\Image;
use App\Models\LoreItem;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Log;

/**
 * Class LoreItemController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class LoreItemController extends Controller
{
	/**
	 * @var string
	 */
	private $directory = 'lore';
	
	
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
			LoreItem::findOrFail($id)->load(['user', 'tags'])
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
		
		return (new LoreItemResource($loreItem))
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
		
		return (new LoreItemResource($loreItem))
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
		LoreItem::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function saveGallery(Request $request)
	{
		$model = LoreItem::findOrFail($request->get('id'));
		
		if ($request->hasfile('gallery')) {
			foreach ($request->file('gallery') as $key => $file) {
				$filename = ImageHelper::saveFileAndResize($file, $this->directory);
				
				$image = new Image([
					'title'        => $model->title.' pic#'.($key + 1),
					'filename'     => $filename,
					'directory'    => $this->directory,
					'content_id'   => $model->id,
					'content_type' => LoreItem::class,
					'user_id'      => \Auth::id(),
				]);
				
				if (! $image->save()) {
					ImageHelper::deleteImageWithThumbnails($this->directory);
					Log::error('Не удалось сохранить изображение для понятия: ' . $model->id);
				}
			}
		}
		
		return (ImageResource::collection($model->images))
			->response()
			->setStatusCode(200);
	}
}
