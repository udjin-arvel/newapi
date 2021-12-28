<?php

namespace App\Http\Resources;

use App\Helpers\ImageHelper;
use App\Models\User;

/**
 * @mixin User
 */
class UserResource extends BaseResource
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
		    'name'   => $this->name,
		    'login'  => $this->login,
		    'status' => $this->status,
		    'poster' => ImageHelper::getPosterUrl($this->poster),
	    ]);
    }
}
