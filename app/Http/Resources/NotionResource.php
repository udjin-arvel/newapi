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
            'title'           => $this->title,
            'text'            => $this->text,
            'is_public'       => (bool)$this->is_public,
            'type'            => $this->type,
            'level'           => $this->level,
            'poster'          => $this->poster,
            'tags'            => TagResource::collection($this->whenLoaded('tags')),
            'params'          => NotionParamResource::collection($this->whenLoaded('params')),
            'gallery'         => ImageResource::collection($this->whenLoaded('images')),
            'leveledContents' => LeveledContentResource::collection($this->whenLoaded('leveledContents')),
        ]);
    }
}
