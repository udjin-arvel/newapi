<?php

namespace App\Http\Requests;

class FragmentRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'order' => 'integer',
            'text'  => 'required',
        ];
    }
}
