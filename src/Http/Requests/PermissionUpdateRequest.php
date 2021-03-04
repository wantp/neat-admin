<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\Permission;

class PermissionUpdateRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $permission = new Permission();
        $table = $permission->getConnectionName() . '.' . $permission->getTable();
        return [
            'name' => [
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->route('permission')),
            ],
            'slug' => [
                'string',
                Rule::unique($table)->where(function (Builder $query) {
                    return $query->where('deleted_at', null);
                })->ignore($this->route('permission')),
            ],
            'method' => 'array',
            'method.*' => [Rule::in(HTTP_METHODS),],
            'http_path' => 'string',
            'remarks' => 'string',
        ];
    }
}