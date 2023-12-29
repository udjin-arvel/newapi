<?php

namespace App\Http\Controllers\Api;

use App\Capacitors\AliasCapacitor;
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
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function like(LikeRequest $request)
	{
		list($contentId, $contentType, $type) = collect($request->all())->sort()->values()->all();
		
		/**
		 * @var \Conner\Likeable\Likeable $model
		 */
		$model = app(AliasCapacitor::getClassByAlias($contentType))->findOrFail($contentId);
		
		if ($type === 'like') {
		    $model->like(\auth()->id());
        } else {
            $model->unlike(\auth()->id());
        }
		
		return $this->sendSuccess(['likesCount' => $model->likeCount]);
	}
	
	/**
	 * @param LikeRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function likeToggle(LikeRequest $request)
	{
		list($contentType, $contentId) = collect($request->all())->values()->sort()->all();
		
		/**
		 * @var \Conner\Likeable\Likeable $model
		 */
		$model = app(AliasCapacitor::getClassByAlias($contentType))->findOrFail($contentId);
		
		if ($model->liked(\auth()->id())) {
            $model->unlike(\auth()->id());
        } else {
            $model->like(\auth()->id());
        }
		
		return $this->sendSuccess(['likesCount' => $model->likeCount]);
	}
}
