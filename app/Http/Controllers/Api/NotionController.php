<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Traits\GalleryUploadTrait;
use App\Http\Filters\NotionFilter;
use App\Http\Controllers\Controller;
use App\Http\Requests\NotionRequest;
use App\Http\Resources\NotionResource;
use App\Models\Notion;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class NotionController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class NotionController extends Controller
{
	use GalleryUploadTrait;

	/**
	 * @var string
	 */
	protected $directory = 'notions';

	/**
	 * @var string
	 */
	protected $model = Notion::class;


	/**
	 * @param NotionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(NotionFilter $filter)
	{
		return NotionResource::collection(
			Notion::filter($filter)
				->with(['user', 'tags', 'images', 'params', 'leveledContents'])
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
			Notion::findOrFail($id)->load(['user', 'tags', 'images', 'params', 'leveledContents'])
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
        if ($request->has('parameters')) {
            $notion->params()->createMany($request->get('params'));
        }
        if ($request->has('leveledContents')) {
            $notion->leveledContents()->createMany($request->get('leveledContents'));
        }

		return (new NotionResource($notion->load(['user', 'images'])))
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
        if ($request->has('parameters')) {
            $notion->params()->saveMany($request->get('params'));
        }
        if ($request->has('leveledContents')) {
            $notion->leveledContents()->delete();
            $notion->leveledContents()->createMany($request->get('leveledContents'));
        }

		return (new NotionResource($notion->load(['user', 'images'])))
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
        $model = Notion::findOrFail($id)
            ->with('images')
            ->first();

        $this->removeContentGallery($model);
        $model->delete();

		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
