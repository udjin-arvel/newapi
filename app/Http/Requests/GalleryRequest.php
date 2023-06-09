<?php

namespace App\Http\Requests;

class GalleryRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'contentId' => 'required',
            'gallery.*' => 'required|mimes:jpeg,png,jpg|max:20480',
        ];
    }
}
