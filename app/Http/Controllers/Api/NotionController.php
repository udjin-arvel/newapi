<?php

namespace App\Http\Controllers\Api;

use App\Helpers\ImageHelper;
use App\Http\Filters\NotionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotionRequest;
use App\Http\Resources\ImageResource;
use App\Http\Resources\NotionResource;
use App\Models\Image;
use App\Models\Notion;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Log;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NotionController extends Controller
{
	/**
	 * @var string
	 */
	private $directory = 'notions';
	
	
	/**
	 * @param NotionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(NotionFilter $filter)
	{
		return NotionResource::collection(
			Notion::filter($filter)
				->with(['user', 'tags', 'images'])
				->get()
		);
	}
	
	/**
	 * @param NotionRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(NotionRequest $request)
	{
		/**
		 * @var Notion $notion
		 */
		$notion = Notion::create($request->all());
		
		if ($request->has('tags')) {
			$notion->tags()->attach($request->get('tags'));
		}
		
		return (new NotionResource($notion))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param NotionRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(NotionRequest $request, int $id)
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
	
	/**
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
	 */
	public function saveGallery(Request $request)
	{
		$notion = Notion::findOrFail($request->get('notionId'));
		
		if ($request->hasfile('gallery')) {
			foreach ($request->file('gallery') as $key => $file) {
				$filename = ImageHelper::saveFileAndResize($file, $this->directory);
				
				$image = new Image([
					'title'        => $notion->title.' pic#'.($key + 1),
					'filename'     => $filename,
					'directory'    => $this->directory,
					'content_id'   => $notion->id,
					'content_type' => Notion::class,
					'user_id'      => \Auth::id(),
				]);
				
				if (! $image->save()) {
					ImageHelper::deleteImageWithThumbnails($this->directory);
					Log::error('Не удалось сохранить изображение для понятия: ' . $notion->id);
				}
			}
		}
		
		return (ImageResource::collection($notion->images))
			->response()
			->setStatusCode(200);
	}
}
