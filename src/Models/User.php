<?php

namespace Wantp\Neat\Models;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\HasApiTokens;
use Wantp\Neat\Models\Traits\NeatModel;
use Wantp\Neat\Models\Traits\HasPermissions;

/**
 * Class User
 * @package Wantp\Admin\Models
 *
 * @property Role[] $roles
 */
class User extends Authenticatable
{
    use NeatModel, SoftDeletes, HasApiTokens, HasPermissions;

    protected $hidden = ['password'];

    public function getTable()
    {
        return $this->getTableName('users');
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class, $this->getTableName('role_user'), 'user_id', 'role_id');
    }

    public function getAvatarAttribute($value)
    {
        return $value ? Storage::disk(config('neat.filesystem.disk'))->url($value) : $value;
    }
}