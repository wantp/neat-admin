<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MenuStoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'parent_id' => 'required',
            'name' => 'required|string',
            'path' => 'required|string',
        ];
    }
}