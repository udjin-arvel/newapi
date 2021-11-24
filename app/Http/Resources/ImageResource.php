<?php

namespace App\Http\Resources;

use App\Models\Image;
use Illuminate\Http\Request;

/**
 * @mixin Image
 */
class ImageResource extends BaseResource
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
			'path'  => $this->path,
			'title' => $this->title,
			'user'  => UserResource::make($this->whenLoaded('user')),
		];
		
		return array_merge(parent::toArray($request), $data);
	}
}
