<?php

namespace App\Http\Requests;

class NotionRequest extends AbstractRequest
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
		    'type'      => 'required',
		    'user_id'   => 'required|exists:users,id',
		    'poster'    => 'required|max:255',
		    'level'     => 'max:20',
		    'is_public' => 'boolean',
		    'tags'      => 'array',
	    ];
    }
}
