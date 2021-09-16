<?php

namespace App\Http\Resources;

use App\Models\Comment;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CommentResource
 * @package App\Http\Resources
 *
 * @mixin Comment
 */
class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'           => $this->id,
            'text'         => $this->text,
            'parent_id'    => $this->parent_id,
            'content_id'   => $this->content_id,
            'content_type' => $this->content_type,
            'children'     => CommentResource::collection($this->children),
	        'user'         => new UserResource($this->user),
        ];
    }
}
