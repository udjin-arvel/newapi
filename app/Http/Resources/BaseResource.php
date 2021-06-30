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
        $response = ['id' => $this->id];
        
        if ($this->created_at instanceof Carbon) {
            $response['created_at'] = $this->created_at->format('d.m.Y H:i');
        }
    
        if ($this->updated_at instanceof Carbon) {
            $response['updated_at'] = $this->updated_at->format('d.m.Y H:i');
        }
        
        if (isset($this->user_id)) {
            $response['user_id'] = $this->user_id;
        }
    
        if (isset($this->poster)) {
            $response['poster'] = $this->poster;
        }
        
        return $response;
    }
}
