<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\CommentFilter;
use App\Http\Requests\CommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class StoryController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class CommentController extends Controller
{
	/**
	 * @param CommentFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(CommentFilter $filter)
	{
		return CommentResource::collection(
			Comment::filter($filter)
				->onlyParents()
				->with(['user', 'children'])
				->get()
		);
	}
	
	/**
	 * @param CommentRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(CommentRequest $request)
	{
		$comment = Comment::create($request->all());
		return (new CommentResource($comment->load(['user', 'children'])))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param CommentRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(CommentRequest $request, int $id)
	{
		$comment = Comment::findOrFail($id)->update($request->all());
		return (new CommentResource($comment->load(['user', 'children'])))
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
	    $model = Comment::findOrFail($id);
	    
	    if ($model->delete()) {
            Comment::where('parent_id', $id)->delete();
        }
	    
		return (new JsonResource($model))
			->response()
			->setStatusCode(200);
	}
}
