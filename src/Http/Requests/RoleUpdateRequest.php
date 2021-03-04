<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\Role;

class RoleUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $role = new Role();
        $table = $role->getConnectionName() . '.' . $role->getTable();
        return [
            'name' => [
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->route('role')),
            ],
            'slug' => [
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->route('role')),
            ],
            'remarks' => 'string',
        ];
    }
}