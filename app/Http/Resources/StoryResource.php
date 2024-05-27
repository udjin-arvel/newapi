<?php

namespace App\Http\Resources;

use App\Capacitors\AliasCapacitor;
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
            'title'       => $this->title,
            'chapter'     => $this->chapter,
            'epigraph'    => $this->epigraph,
            'is_public'   => (bool)$this->is_public,
            'names'       => json_decode($this->names),
            'fast_notes'  => json_decode($this->fast_notes),
            'composition' => CompositionResource::make($this->whenLoaded('composition')),
            'fragments'   => FragmentResource::collection($this->whenLoaded('fragments')),
            'tags'        => TagResource::collection($this->whenLoaded('tags')),
            'comments'    => CommentResource::collection($this->whenLoaded('comments')),
            'descriptions' => $this->when(optional($this->user)->canRedact($this), function () {
                return DescriptionResource::collection($this->whenLoaded('descriptions'));
            }),
            'likeData' => [
                'likes' => LikeResource::collection($this->whenLoaded('likesAndDislikes')),
                'liked' => $this->liked,
                'disliked' => $this->disliked,
            ],
            'type' => [
                'id' => $this->type,
                'label' => AliasCapacitor::getTypeNameByAliasAndType(AliasCapacitor::STORY, $this->type),
            ],
        ]);
    }
}
