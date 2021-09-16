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
		    'is_public'      => (bool) $this->is_public,
		    'composition'    => CompositionResource::make($this->composition),
		    'fragments'      => FragmentResource::collection($this->fragments),
		    'user'           => UserResource::make($this->user),
		    'tags'           => TagResource::collection($this->tags),
	    ];
    	
    	if ($this->user->canRedact($this)) {
		    $data['descriptions'] = DescriptionResource::collection($this->descriptions);
	    }
    	
        return array_merge(parent::toArray($request), $data);
    }
}
