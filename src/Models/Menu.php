<?php

namespace Wantp\Neat\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Wantp\Neat\Models\Traits\NeatModel;

class Menu extends Model
{
    use NeatModel, SoftDeletes;

    /**
     * @return \Illuminate\Config\Repository|\Illuminate\Contracts\Foundation\Application|mixed|string
     */
    public function getTable()
    {
        return $this->getTableName('menus');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class, $this->getTableName('role_menu'), 'menu_id', 'role_id');
    }
}