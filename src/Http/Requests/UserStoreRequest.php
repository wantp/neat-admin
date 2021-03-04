<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\User;

class UserStoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $user = new User();
        return [
            'username' => [
                'required',
                'string',
                Rule::unique($user->getConnectionName() . '.' . $user->getTable())->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'password' => 'required|string|confirmed',
        ];
    }
}