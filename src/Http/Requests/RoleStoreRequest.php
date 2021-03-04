<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\Role;

class RoleStoreRequest extends FormRequest
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
                'required',
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'slug' => [
                'required',
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                }),
            ],
            'remarks' => 'string',
        ];
    }
}