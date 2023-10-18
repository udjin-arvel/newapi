<?php

namespace App\Http\Resources;

use App\Models\Fragment;
use Illuminate\Http\Request;

/**
 * @mixin Fragment
 */
class FragmentResource extends BaseResource
{
	/**
	 * Transform the resource into an array.
	 *
	 * @param Request $request
	 * @return array
	 */
	public function toArray($request)
	{
        return array_merge(parent::toArray($request), [
            'text'     => $this->text,
            'footnote' => $this->footnote,
            'order'    => $this->order,
        ]);
	}
}
