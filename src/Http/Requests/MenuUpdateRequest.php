<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class MenuUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'name' => 'string',
            'path' => 'string',
        ];
    }
}