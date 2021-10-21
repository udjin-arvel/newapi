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
		    'text'         => 'required|max:2048',
		    'parent_id'    => 'integer',
		    'content_id'   => 'required|integer',
		    'content_type' => 'required|string',
		    'user_id'      => 'required|integer',
	    ];
    }
}
