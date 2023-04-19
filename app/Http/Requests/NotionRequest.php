<?php

namespace App\Http\Requests;

class NotionRequest extends BaseRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title'          => 'required|min:2|max:255',
            'text'           => 'required|min:20',
            'type'           => 'required',
            'user_id'        => 'required|exists:users,id',
            'level'          => 'integer|max:20',
            'is_public'      => 'boolean',
            'tags'           => 'sometimes|array',
            'tags.*.name'    => ['required', 'string', 'max:255'],
            'params'         => 'sometimes|array',
            'params.*.title' => ['required', 'string', 'max:255'],
            'params.*.value' => ['required', 'string', 'max:255'],
            'params.*.order' => ['present', 'integer', 'nullable', 'max:255'],
        ];
    }
}
