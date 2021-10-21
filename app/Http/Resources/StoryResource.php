<?php

namespace App\Http\Resources;

use App\Models\Story;
use Illuminate\Http\Request;

/**
 * @mixin Story
 */
class StoryResource extends BaseResource
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
		    'title'          => $this->title,
		    'chapter'        => $this->chapter,
		    'epigraph'       => $this->epigraph,
		    'type'           => $this->type,
		    'likes'          => LikeResource::collection($this->whenLoaded('likesAndDislikes')),
		    'liked'          => $this->liked,
		    'is_public'      => (bool) $this->is_public,
		    'created_at'     => optional($this->created_at)->format('d.m.Y H:i'),
		    'composition'    => CompositionResource::make($this->whenLoaded('composition')),
		    'fragments'      => FragmentResource::collection($this->whenLoaded('fragments')),
		    'user'           => UserResource::make($this->whenLoaded('user')),
		    'tags'           => TagResource::collection($this->whenLoaded('tags')),
		    'comments'       => CommentResource::collection($this->whenLoaded('comments')),
		    'descriptions'   => $this->when(optional($this->user)->canRedact($this), function () {
			    return DescriptionResource::collection($this->whenLoaded('descriptions'));
		    }),
	    ];
    	
        return array_merge(parent::toArray($request), $data);
    }
}
