<?php

namespace Wantp\Neat\Models\Traits;

use Illuminate\Support\Collection;
use Wantp\Neat\Models\Role;

trait HasPermissions
{
    protected $allPermissions;

    public function allPermissions(): Collection
    {
        if ($this->allPermissions) {
            return $this->allPermissions;
        }

        return $this->allPermissions = $this->roles->pluck('permissions')->flatten()->keyBy($this->getKeyName());
    }

    public function isAdministrator()
    {
        return $this->isRole(Role::ADMINISTRATOR_SLUG);
    }

    public function isRole(string $roleSlug)
    {
        return $this->roles->pluck('slug')->contains($roleSlug);
    }
}