<?php

namespace App\Http\Resources;

use App\Capacitors\AliasCapacitor;
use App\Helpers\ImageHelper;
use App\Models\Composition;
use Illuminate\Http\Request;

/**
 * @mixin Composition
 */
class CompositionResource extends BaseResource
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
		    'title'       => $this->title,
		    'description' => $this->description,
		    'poster'      => $this->poster,
		    'era'         => $this->era,
		    'parent_id'   => $this->parent_id,
		    'is_public'   => $this->is_public,
		    'level'       => $this->level,
		    'chapter'     => $this->chapter,
		    'stories'     => StoryResource::collection($this->whenLoaded('stories')),
		    'user'        => UserResource::make($this->whenLoaded('user')),
		    'tags'        => TagResource::collection($this->whenLoaded('tags')),
		    'created_at'  => optional($this->created_at)->format('d.m.Y H:i'),
		    'type'        => [
			    'id'    => $this->type,
			    'label' => AliasCapacitor::getTypeNameByAliasAndType(AliasCapacitor::COMPOSITION, $this->type),
		    ],
	    ]);
    }
}
