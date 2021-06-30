<?php

namespace App\Http\Resources;

use App\Models\LoreItem;
use Illuminate\Http\Request;

/**
 * @mixin LoreItem
 */
class LoreItemResource extends BaseResource
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
            'title'        => $this->title,
            'text'         => $this->text,
            'is_published' => $this->is_published,
        ]);
    }
}
