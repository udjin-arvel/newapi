<?php

namespace App\Http\Resources;

use App\Models\Notion;
use Illuminate\Http\Request;

/**
 * @mixin Notion
 */
class NotionResource extends BaseResource
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
		    'title'      => $this->title,
		    'text'       => $this->text,
		    'is_public'  => (bool) $this->is_public,
		    'type'       => $this->type,
		    'level'      => $this->level,
		    'poster'     => $this->poster,
		    'created_at' => optional($this->created_at)->format('d.m.Y'),
		    'user'       => UserResource::make($this->whenLoaded('user')),
		    'tags'       => TagResource::collection($this->whenLoaded('tags')),
            'params'     => NotionParamResource::collection($this->whenLoaded('params')),
		    'gallery'    => ImageResource::collection($this->whenLoaded('images')),
	    ];

	    return array_merge(parent::toArray($request), $data);
    }
}
