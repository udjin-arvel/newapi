<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * Class BaseRequest
 * @package App\Http\Requests
 */
class BaseRequest extends FormRequest
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
	 * @return \Illuminate\Http\JsonResponse
	 */
	protected function failedValidation(Validator $validator) {
        throw new HttpResponseException(response()->json([
            'error' => $validator->errors(),
            'code'  => 422,
        ], 200));
	}
}
