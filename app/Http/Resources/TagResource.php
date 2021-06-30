<?php

namespace App\Http\Resources;

use App\Models\Tag;
use Illuminate\Http\Request;

/**
 * @mixin Tag
 */
class TagResource extends BaseResource
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
            'name' => $this->name,
            'stem' => $this->stem,
        ]);
    }
}
