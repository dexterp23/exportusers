<?php

namespace App\Service\Mail;

use Roles\Repository\RolesRepository;

class RoleNameResolver implements RoleNameResolverInterface
{
    private RolesRepository $roleRepository;

    public function __construct(RolesRepository $roleRepository)
    {
        $this->roleRepository = $roleRepository;
    }

    public function resolveRoleNames(string $roleIds): string
    {
        if (empty($roleIds)) {
            return '';
        }

        $roleIdArray = explode(',', $roleIds);
        $roles = $this->roleRepository->getRolesByIds($roleIdArray);

        $roleNames = array_map(
            fn($role) => $role->getName(),
            $roles
        );

        return implode(', ', $roleNames);
    }
}
