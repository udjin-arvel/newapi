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
	    return array_merge(parent::toArray($request), [
		    'title'      => $this->title,
		    'text'       => $this->text,
		    'is_public'  => (bool) $this->is_public,
		    'type'       => $this->type,
		    'level'      => $this->level,
		    'user'       => new UserResource($this->user),
		    'tags'       => TagResource::collection($this->tags),
		    'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
	    ]);
    }
}
