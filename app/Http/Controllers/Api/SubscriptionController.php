<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Filters\SubscriptionFilter;
use App\Http\Requests\SubscriptionRequest;
use App\Http\Resources\SubscriptionResource;
use App\Models\Subscription;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class SubscriptionController
 * @package App\Http\Controllers\Api
 *
 * @property mixed $input
 */
class SubscriptionController extends Controller
{
	/**
	 * @param SubscriptionFilter $filter
	 * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
	 */
	public function index(SubscriptionFilter $filter)
	{
		return SubscriptionResource::collection(
			Subscription::filter($filter)
				->with('user')
				->get()
		);
	}
	
	/**
	 * @param SubscriptionRequest $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function store(SubscriptionRequest $request)
	{
		$subscription = Subscription::create($request->all());
		return (new SubscriptionResource($subscription))
			->response()
			->setStatusCode(201);
	}
	
	/**
	 * @param SubscriptionRequest $request
	 * @param int $id
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function update(SubscriptionRequest $request, int $id)
	{
		$subscription = Subscription::findOrFail($id)->update($request->all());
		return (new SubscriptionResource($subscription))
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
		Subscription::findOrFail($id)->delete();
		return (new JsonResource(collect($id)))
			->response()
			->setStatusCode(200);
	}
}
