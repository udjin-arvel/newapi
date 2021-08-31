<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotionPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

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
