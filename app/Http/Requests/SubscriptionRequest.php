<?php

namespace App\Http\Requests;

/**
 * Class SubscriptionRequest
 * @package App\Http\Requests
 */
class SubscriptionRequest extends AbstractRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return [
			'content_type' => 'required',
			'content_id'   => 'integer',
		];
	}
}
