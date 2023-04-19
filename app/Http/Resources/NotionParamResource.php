<?php

namespace App\Http\Resources;

use App\Models\NotionParam;
use Illuminate\Http\Request;

/**
 * @mixin NotionParam
 */
class NotionParamResource extends BaseResource
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
            'title' => $this->title,
            'value' => $this->value,
            'order' => $this->order,
        ]);
    }
}
