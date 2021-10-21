<?php

namespace App\Http\Requests;

class DescriptionRequest extends BaseRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'title'     => 'required|max:255',
			'text'      => 'required',
		];
	}
}
