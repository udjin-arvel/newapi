<?php

namespace App\Http\Resources;

use App\Models\Short;
use Illuminate\Http\Request;

/**
 * @mixin Short
 */
class ShortResource extends BaseResource
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
			'title'     => $this->title,
			'text'      => $this->text,
			'is_public' => $this->is_public,
		]);
	}
}
