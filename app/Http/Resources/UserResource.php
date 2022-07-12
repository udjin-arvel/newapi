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
		    'name'       => $this->name,
		    'status'     => $this->status,
		    'level'      => $this->level,
		    'experience' => $this->experience,
		    'poster'     => $this->poster,
		    'social'     => $this->social,
		    'email'      => $this->email,
		    'info'       => $this->info,
		    'created_at' => optional($this->created_at)->format('d.m.Y H:i'),
	    ]);
    }
}
