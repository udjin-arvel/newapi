<?php

namespace App\Http\Resources;

use App\Models\LeveledContent;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class LeveledContentResource
 * @package App\Http\Resources
 *
 * @mixin LeveledContent
 */
class LeveledContentResource extends JsonResource
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
            'id'      => $this->id,
            'text'    => $this->text,
            'level'   => $this->level,
            'user_id' => $this->user_id,
        ];
    }
}
