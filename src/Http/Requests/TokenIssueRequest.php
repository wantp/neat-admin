<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TokenIssueRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        return [
            'username' => 'required|string',
            'password' => 'required|string',
        ];
    }
}