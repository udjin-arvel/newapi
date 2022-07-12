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
			'id'         => $this->id,
			'directory'  => $this->directory,
			'filename'   => $this->filename,
			'title'      => $this->title,
			'user'       => UserResource::make($this->whenLoaded('user')),
			'created_at' => optional($this->created_at)->format('d.m.Y'),
		];
		
		return array_merge(parent::toArray($request), $data);
	}
}
