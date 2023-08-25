<?php

namespace App\Http\Controllers\Traits;

use App\Models\Role;
use App\Models\User;
use App\Models\UserTenant;

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

    public function tenantChildUserTree($parentId)
    {
        $userIds = [];

        $userTenant = UserTenant::with('user')
            ->where('parent_id', $parentId)
            ->get();

        foreach ($userTenant as $user) {
            $userIds[] = $user->user_id;
            $childUserIds = $this->tenantChildUserTree($user->user_id);
            $userIds = array_merge($userIds, $childUserIds);
        }

        return $userIds;
    }

    function flattenArray($array, &$result = [])
    {
        foreach ($array as $value) {
            $result[] = array_diff_key($value, array_flip(["children"]));

            if (isset($value['children']) && is_array($value['children'])) {
                $this->flattenArray($value['children'], $result);
            }
        }

        return $result;
    }

    function unflattering($flatArray): array
    {
        $refs = array();
        $result = array();

        while (count($flatArray) > 0) {
            for ($i = count($flatArray) - 1; $i >= 0; $i--) {
                if ($flatArray[$i]["tt_parent"] == 0) {
                    $result[$flatArray[$i]["tt_key"]] = $flatArray[$i];
                    $refs[$flatArray[$i]["tt_key"]] = &$result[$flatArray[$i]["tt_key"]];
                    unset($flatArray[$i]);
                    $flatArray = array_values($flatArray);
                } else if (array_key_exists($flatArray[$i]["tt_parent"], $refs)) {
                    $o = $flatArray[$i];
                    $refs[$flatArray[$i]["tt_key"]] = $o;
                    $refs[$flatArray[$i]["tt_parent"]]["children"][] = &$refs[$flatArray[$i]["tt_key"]];
                    unset($flatArray[$i]);
                    $flatArray = array_values($flatArray);
                }
            }
        }
        return $result;
    }

}
