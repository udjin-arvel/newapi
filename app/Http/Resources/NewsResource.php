<?php

namespace App\Http\Resources;

use App\Models\News;
use Illuminate\Http\Request;

/**
 * @mixin News
 */
class NewsResource extends BaseResource
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
			'title'        => $this->title,
			'text'         => $this->text,
			'content_id'   => $this->content_id,
			'content_type' => $this->content_type,
			'action'       => $this->action,
		]);
	}
}
