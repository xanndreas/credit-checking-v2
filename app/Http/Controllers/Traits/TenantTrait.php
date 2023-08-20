<?php

namespace App\Http\Controllers\Traits;

use App\Models\Role;
use App\Models\User;

trait TenantTrait
{
    public function hierarchy($roleId, $getter)
    {
        // roleId => hierarchy
        $roleHierarchy = [
            'parent' => [
                5 => [4, 3, 2],
                4 => [3, 2],
                3 => [2],
                2 => [],
            ],

            'child' => [
                5 => [],
                4 => [5],
                3 => [4, 5],
                2 => [3, 4, 5],
            ]
        ];

        return isset($roleHierarchy[$getter]) ? ($roleHierarchy[$getter][$roleId] ?? []) : [];
    }

    public function tenantParent(Role $role)
    {
        return $this->hierarchy($role->id, 'parent');
    }

    public function tenantChild(Role $role)
    {
        return $this->hierarchy($role->id, 'child');
    }

    public function tenantParentUser(User $user): array
    {
        $user->load('roles');
        $tenantParent = [];

        foreach ($user->roles as $item) {
            array_merge($tenantParent, $this->hierarchy($item->id, 'parent'));
        }

        return $tenantParent;
    }

    public function tenantChildUser(User $user): array
    {
        $user->load('roles');
        $tenantChild = [];

        foreach ($user->roles as $item) {
            array_merge($tenantChild, $this->hierarchy($item->id, 'child'));
        }

        return $tenantChild;
    }

}
