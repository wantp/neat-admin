<?php

namespace Wantp\Neat\Observers;

use Wantp\Neat\Models\Role;
use \Exception;

class RoleObserver
{
    public function deleteting(Role $role)
    {
        if ($role->isAdministrator()) {
            throw new Exception(__('neat.role.delete_admin'));
        }
    }
}