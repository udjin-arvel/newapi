<?php

namespace App\Http\Resources;

use App\Models\Comment;

/**
 * Class CommentResource
 * @package App\Http\Resources
 *
 * @mixin Comment
 */
class CommentResource extends BaseResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return array_merge(parent::toArray($request), [
            'text'      => $this->text,
            'parent_id' => $this->parent_id,
            'children'  => CommentResource::collection($this->whenLoaded('children')),
            'user'      => optional(UserResource::make($this->whenLoaded('user')))->enableSkimpyMode(),
        ]);
    }
}
