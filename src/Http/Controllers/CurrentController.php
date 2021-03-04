<?php

namespace Wantp\Neat\Http\Controllers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Wantp\Neat\ArrayTree;
use Wantp\Neat\Http\Resources\PermissionResource;
use Wantp\Neat\Http\Resources\UserResource;
use Wantp\Neat\Models\Menu;
use Wantp\Neat\Models\Permission;
use Wantp\Neat\Models\User;
use Wantp\Neat\Models\Role;
use Wantp\Neat\Http\Resources\MenuResource;

class CurrentController extends Controller
{
    /**
     * @return mixed
     */
    public function user(Request $request)
    {
        $user = $request->user();

        return new UserResource($user);
    }

    /**
     * @return array
     */
    public function roles(Request $request)
    {
        /**
         * @var $user User
         */
        $user = $request->user();

        $user->roles;
        if ($user->isAdministrator()) {
            $user->roles = Role::all();
        }

        return array_column($user->roles->toArray(), 'name');
    }

    /**
     * @return mixed
     */
    public function menus(Request $request, ArrayTree $arrayTree)
    {
        /**
         * @var $user User
         */
        $user = $request->user();

        $query = Menu::orderBy('order');
        if (!$user->isAdministrator()) {
            $rolesId = array_column($user->roles->toArray(), 'id');
            $query = $query->whereHas('roles', function (Builder $query) use ($rolesId) {
                $query->whereIn('role_id', $rolesId);
            });
        }
        $currentMenus = array_column($query->get()->toArray(), 'name', 'id');
        $menuTree = $arrayTree->build(MenuResource::collection(Menu::orderBy('order')->get())->resolve());

        return $arrayTree->prune($menuTree, $currentMenus);
    }


    /**
     * @return \Illuminate\Database\Eloquent\Collection|Permission[]
     */
    public function permissions(Request $request)
    {
        /**
         * @var $user User
         */
        $user = $request->user();

        if ($user->isAdministrator()) {
            $permissions = Permission::all();
        } else {
            $rolesId = array_column($user->roles->toArray(), 'id');
            $permissions = Permission::whereHas('roles', function (Builder $query) use ($rolesId) {
                $query->whereIn('role_id', $rolesId);
            })->get();
        }

        return PermissionResource::collection($permissions);
    }


}
