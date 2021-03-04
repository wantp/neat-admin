<?php

namespace Wantp\Neat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wantp\Neat\Http\Auth\Permission as PermissionChecker;
use Wantp\Neat\Models\Traits\AdminModel;

class Permission extends Model
{
    use AdminModel, SoftDeletes;

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed|string
     */
    public function getTable()
    {
        return $this->getTableName('permissions');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, $this->getTableName('role_permission'), 'permission_id', 'role_id');
    }

    /**
     * @return bool
     */
    public function hasPermission()
    {
        if (!$this->http_path) {
            return false;
        }
        if (!PermissionChecker::checkMethod($this->method)) {
            return false;
        }
        if (!PermissionChecker::checkPath($this->http_path)) {
            return false;
        }

        return true;
    }

    /**
     * @param $method
     */
    public function setMethodAttribute($method)
    {
        $this->attributes['method'] = is_array($method) ? implode(',', $method) : $method;
    }

    /**
     * @param $method
     *
     * @return array
     */
    public function getMethodAttribute($method)
    {
        if (is_string($method)) {
            return array_filter(explode(',', $method));
        }

        return $method;
    }
}