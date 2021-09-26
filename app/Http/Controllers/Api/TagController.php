<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\TagFilter;
use App\Http\Requests\TagRequest;
use App\Http\Resources\TagResource;
use App\Models\Tag;
use DB;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class TagController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class TagController extends Controller
{
	/**
	 * @param TagFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(TagFilter $filter)
	{
		return TagResource::collection(
			Tag::filter($filter)
				->with(['user'])
				->get()
		);
	}
	
	/**
	 * @param TagRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(TagRequest $request)
	{
		$tag = Tag::create($request->all());
		return (new TagResource($tag))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param TagRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(TagRequest $request, int $id)
	{
		$tag = Tag::findOrFail($id)->update($request->all());
		return (new TagResource($tag))
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
		Tag::findOrFail($id)->delete();
		DB::table('taggables')->where('tag_id', $id)->delete();
		
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
