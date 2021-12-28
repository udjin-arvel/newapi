<?php

namespace App\Http\Resources;

use App\Helpers\ImageHelper;
use App\Models\LoreItem;
use Illuminate\Http\Request;

/**
 * @mixin LoreItem
 */
class LoreItemResource extends BaseResource
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
		    'title'      => $this->title,
		    'text'       => $this->text,
		    'level'      => $this->level,
		    'is_public'  => (bool) $this->is_public,
		    'poster'     => ImageHelper::getPosterUrl($this->poster),
		    'user'       => UserResource::make($this->whenLoaded('user')),
		    'tags'       => TagResource::collection($this->whenLoaded('tags')),
		    'images'     => ImageResource::collection($this->whenLoaded('images')),
		    'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
	    ]);
    }
}
