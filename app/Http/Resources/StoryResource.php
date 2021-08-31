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
        return array_merge(parent::toArray($request), [
            'title'          => $this->title,
            'chapter'        => $this->chapter,
            'epigraph'       => $this->epigraph,
            'composition_id' => $this->composition_id,
            'type'           => $this->type,
            'is_public'   => (bool) $this->is_public,
            'fragments'      => $this->fragments,
            'notions'        => $this->notions,
            'remarks'        => $this->remarks,
            'tags'           => $this->tags,
        ]);
    }
}
