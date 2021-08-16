<?php

namespace App\Http\Resources;

use App\Models\AModel;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin AModel
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
        $response = [
        	'id' => $this->id,
        	'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
        	'updated_at' => optional($this->updated_at)->format('d.m.Y H:i'),
        ];
        
        if (isset($this->user_id)) {
            $response['user_id'] = $this->user_id;
        }
    
        if (isset($this->poster)) {
            $response['poster'] = env('APP_URL') . '/storage/' .  $this->poster;
        }
        
        return $response;
    }
}
