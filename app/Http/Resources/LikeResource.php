<?php

namespace App\Http\Resources;

use Cog\Likeable\Models\Like;
use Illuminate\Http\Request;

/**
 * @mixin Like
 */
class LikeResource extends BaseResource
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
			'user_id' => $this->user_id,
			'type_id' => $this->type_id,
		]);
	}
}
