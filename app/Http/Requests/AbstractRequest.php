<?php

namespace App\Http\Requests;

use HttpResponseException;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class AbstractRequest extends FormRequest
{
	/**
	 * Determine if the user is authorized to make this request.
	 * @return bool
	 */
	public function authorize()
	{
		return \Auth::check();
	}
	
	/**
	 * Send 422 Response if Validator fails.
	 *
	 * @param Validator $validator
	 * @throws HttpResponseException
	 */
	protected function failedValidation(Validator $validator) {
		throw new HttpResponseException(response()->json($validator->errors(), 422));
	}
}
