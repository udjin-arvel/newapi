<?php

namespace App\Http\Resources;

use App\Models\Note;
use Illuminate\Http\Request;

/**
 * @mixin Note
 */
class NoteResource extends BaseResource
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
            'title'                 => $this->title,
            'text'                  => $this->text,
            'importance'            => $this->importance,
            'is_additional_content' => $this->is_additional_content,
            'tags'                  => TagResource::collection($this->whenLoaded('tags')),
        ]);
    }
}
