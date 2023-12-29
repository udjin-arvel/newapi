<?php

namespace App\Http\Resources;

use App\Models\Character;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class CharacterResource
 * @package App\Http\Resources
 *
 * @mixin Character
 */
class CharacterResource extends BaseResource
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
            'name'         => $this->name,
            'description'  => $this->description,
            'character'    => $this->character,
            'habitat'      => $this->habitat,
            'ability'      => $this->ability,
            'race'         => $this->race,
            'poster'       => $this->poster,
            'birthday_eon' => $this->birthday_eon,
            'power_level'  => $this->power_level,
            'is_public'    => $this->is_public,
            'gallery'      => ImageResource::collection($this->whenLoaded('images')),
            'tags'         => TagResource::collection($this->whenLoaded('tags')),
        ]);
    }
}
