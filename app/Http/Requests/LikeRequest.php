<?php

namespace App\Http\Requests;

class LikeRequest extends BaseRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'content_id'   => 'required|integer',
			'content_type' => 'required|string',
			'type'         => 'required|string',
		];
	}
}
