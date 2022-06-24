<?php

namespace App\Http\Requests;

class NameRequest extends BaseRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'name' => 'required|unique:names|max:255',
		];
	}
}
