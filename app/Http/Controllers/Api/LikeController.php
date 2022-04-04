<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;
use Cog\Likeable\Enums\LikeType;
use Cog\Likeable\Traits\Likeable;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class LikeController extends Controller
{
	/**
	 * @param LikeRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Cog\Likeable\Exceptions\LikerNotDefinedException
	 */
	public function like(LikeRequest $request)
	{
		list($contentId,  $contentType, $type) = collect($request->all())->sort()->values()->all();
		
		/**
		 * @var Likeable $model
		 */
		$model = app($contentType)->findOrFail($contentId);
		$type === LikeType::LIKE
			? $model->like(\Auth::id())
			: $model->dislike(\Auth::id());
		
		return $this->sendSuccess(['likesCount' => $model->likes()]);
	}
	
	/**
	 * @param LikeRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 * @throws \Cog\Likeable\Exceptions\LikerNotDefinedException
	 */
	public function likeToggle(LikeRequest $request)
	{
		list($contentType, $contentId) = collect($request->all())->values()->sort()->all();
		
		/**
		 * @var Likeable $model
		 */
		$model = app($contentType)->findOrFail($contentId);
		$model->likeToggle(\Auth::id());
		
		return $this->sendSuccess(['likesCount' => $model->likes()]);
	}
}
