<?php

namespace App\Http\Requests;

class CommentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
	    return [
		    'text'         => 'required|min:15|max:2048',
		    'parent_id'    => 'nullable|integer',
		    'content_id'   => 'required|integer',
		    'content_type' => 'required|string',
	    ];
    }
}
