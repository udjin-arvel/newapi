<?php

namespace App\Http\Resources;

use App\Facades\Enum;
use App\Models\Notification;
use Illuminate\Http\Request;

/**
 * @mixin Notification
 */
class NotificationResource extends BaseResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param  Request  $request
	 * @return array
	 */
	public function toArray($request)
	{
		$data = [
			'content_id'   => $this->content_id,
			'content_type' => $this->content_type ? Enum::aliasByModel($this->content_type) : '',
			'message'      => $this->message,
			'user'         => new UserResource($this->user),
			'updated_at'   => optional($this->updated_at)->format('d.m.Y H:i'),
		];
		
		return array_merge(parent::toArray($request), $data);
	}
}
