<?php

namespace Wantp\Neat\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Wantp\Neat\Models\Permission as PermissionModel;
use Wantp\Neat\Models\User;

/**
 * Permission Middleware
 *
 * Class Permission
 * @package Wantp\ApiAdmin\Http\Middleware
 */
class Permission
{
    /**
     * @var Request
     */
    protected $request;

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /**
         * @var User $user
         */
        $user = $request->user();

        if ($user->isAdministrator()) {
            return $next($request);
        }

        if (!$user->allPermissions()->first(function (PermissionModel $permission) use ($request) {
            return $permission->hasPermission();
        })) {
            abort(403, __('neat.auth.permission_denied'));
        }

        return $next($request);
    }
}