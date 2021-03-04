<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\User;

class UserUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $user = new User();
        $table = $user->getConnectionName() . '.' . $user->getTable();
        return [
            'username' => [
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->route('user')),
            ],
            'password' => 'string|confirmed',
            'name' => 'string',
            'is_admin' => 'in:0,1',
        ];
    }
}