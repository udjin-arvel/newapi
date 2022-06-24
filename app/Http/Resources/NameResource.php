<?php

namespace App\Http\Resources;

use App\Models\Name;
use Illuminate\Http\Request;

/**
 * @mixin Name
 */
class NameResource extends BaseResource
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
			'name'       => $this->name,
			'is_used'    => $this->is_used,
			'user'       => ['id' => $this->user_id],
			'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
		]);
	}
}
