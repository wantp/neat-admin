<?php

namespace Wantp\Neat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wantp\Neat\Models\Traits\NeatModel;

class Role extends Model
{
    use NeatModel, SoftDeletes;

    const ADMINISTRATOR_SLUG = 'Administrator';


    public function getTable()
    {
        return $this->getTableName('roles');
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, $this->getTableName('role_permission'), 'role_id', 'permission_id');
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, $this->getTableName('role_menu'), 'role_id', 'menu_id');
    }


    public function isAdministrator()
    {
        return $this->slug == Role::ADMINISTRATOR_SLUG;
    }
}