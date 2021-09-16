<?php

namespace App\Http\Controllers\Api;

use App\Exceptions\TBError;
use App\Http\Controllers\Controller;
use App\Http\Requests\LikeRequest;

/**
 * Class BookController
 * @package App\Http\Controllers\Api
 */
class LikeController extends Controller
{
	/**
	 * @param LikeRequest $request
	 * @throws TBError
	 */
	public function like(LikeRequest $request)
	{
		$data = $request->all();
		$className = $data['content_type'];
		$contentId = 333; // $data['content_id'];
		$model = app($className)->find($contentId);
		
		if (null === $model) {
			throw new TBError(TBError::CONTENT_NOT_FOUND);
		}
		
		dd($model);
	}
	
	/**
	 * @param LikeRequest $request
	 */
	public function dislike(LikeRequest $request)
	{
	
	}
	
	/**
	 * @param LikeRequest $request
	 */
	public function likeToggle(LikeRequest $request)
	{
	
	}
}
