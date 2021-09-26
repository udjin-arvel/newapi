<?php

namespace App\Http\Resources;

use App\Models\Subscription;
use Illuminate\Http\Request;

/**
 * @mixin Subscription
 */
class SubscriptionResource extends BaseResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		return array_merge(parent::toArray($request), [
			'text'         => $this->getSubscriptionText(),
			'content_id'   => $this->content_id,
			'content_type' => $this->content_type,
			'user'         => new UserResource($this->user),
			'updated_at'   => optional($this->updated_at)->format('d.m.Y H:i'),
		]);
	}
}
