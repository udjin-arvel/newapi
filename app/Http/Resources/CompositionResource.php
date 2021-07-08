<?php

namespace App\Http\Resources;

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
            'era'         => $this->era,
            'size'        => json_decode($this->size, true),
            'parent_id'   => $this->parent_id,
            'type'        => $this->type,
        ]);
    }
}
