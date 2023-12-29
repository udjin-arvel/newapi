<?php

namespace App\Http\Resources;

use App\Helpers\ImageHelper;
use App\Models\User;
use JetBrains\PhpStorm\ArrayShape;

/**
 * Class UserResource
 * @package App\Http\Resources
 *
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
    public function toArray($request): array
    {
	    return array_merge(parent::toArray($request), [
            'name'       => mb_strtolower($this->name),
            'poster'     => $this->poster,
            'status'     => $this->status,
            'level'      => $this->level,
            'experience' => $this->experience,
            'social'     => $this->social,
            'email'      => $this->email,
            'info'       => $this->info,
        ]);
    }
    
    /**
     * @inheritDoc
     * @return array
     */
    #[ArrayShape(['id' => "int", 'name' => "string", 'poster' => "string"])]
    protected function toSkimpyArray(): array
    {
        return [
            'id'     => $this->id,
            'name'   => mb_strtolower($this->name),
            'poster' => $this->poster,
        ];
    }
}
