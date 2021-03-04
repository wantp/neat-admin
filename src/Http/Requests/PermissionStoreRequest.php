<?php

namespace Wantp\Neat\Http\Requests;

use Illuminate\Database\Query\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Wantp\Neat\Models\Permission;

class PermissionStoreRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules()
    {
        $permission = new Permission();
        $table = $permission->getConnectionName() . '.' . $permission->getTable();
        return [
            'parent_id' => 'required',
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
            'method' => 'required|array',
            'method.*' => [Rule::in(HTTP_METHODS),],
            'http_path' => 'string',
            'remarks' => 'string',
        ];
    }
}