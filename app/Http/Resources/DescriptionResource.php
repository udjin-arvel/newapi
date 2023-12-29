<?php

namespace App\Http\Resources;

use App\Capacitors\AliasCapacitor;
use App\Models\Description;
use Illuminate\Http\Request;

/**
 * @mixin Description
 */
class DescriptionResource extends BaseResource
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
			'title'         => $this->title,
			'text'          => $this->text,
			'type'          => $this->type,
			'content_id'    => $this->content_id,
			'content_type'  => $this->getContentType(),
			'content_title' => optional($this->content)->title,
			'importance'    => (int) $this->importance,
			'is_public'     => (bool) $this->is_public,
			'tags'          => TagResource::collection($this->whenLoaded('tags')),
			'realized_at'   => optional($this->realized_at)->format('d.m.Y H:i'),
		]);
	}
}
