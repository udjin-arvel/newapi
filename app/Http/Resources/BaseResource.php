<?php

namespace App\Http\Resources;

use App\Models\BaseModel;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin BaseModel
 */
class BaseResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return ['id' => (int) $this->id];
    }
}
