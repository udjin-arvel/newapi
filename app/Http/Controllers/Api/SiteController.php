<?php

namespace App\Http\Controllers\Api;

use App\Capacitors\AliasCapacitor;
use App\Exceptions\TBError;
use App\Http\Controllers\Controller;
use App\Http\Filters\NotificationFilter;
use App\Http\Resources\NewsResource;
use App\Http\Resources\NotificationResource;
use App\Http\Resources\TagResource;
use App\Models\News;
use App\Models\Notification;
use App\Models\Tag;

/**
 * Class SiteController
 * @package App\Http\Controllers\Api
 */
class SiteController extends Controller
{
	/**
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function news()
	{
		return NewsResource::collection(
			News::orderBy('created_at', 'desc')
				->paginate(request()->get('perPage', config('tb.pageSize.large')))
		);
	}
	
	/**
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function tags()
	{
		return TagResource::collection(Tag::orderBy('name')->get());
	}
	
	/**
	 * @param NotificationFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function notifications(NotificationFilter $filter)
	{
		return NotificationResource::collection(
			Notification::filter($filter)
				->with('user')
				->get()
		);
	}
	
	/**
	 * @param string $alias
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function types(string $alias)
	{
		return $this->sendSuccess(AliasCapacitor::getTypesByAlias($alias));
	}
	
	/**
	 * @param string $alias
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function statuses(string $alias)
	{
		return $this->sendSuccess(AliasCapacitor::getStatusesByAlias($alias));
	}
}
