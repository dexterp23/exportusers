<?php

namespace App\Service\Mail;

interface RoleNameResolverInterface
{
    public function resolveRoleNames(string $roleIds): string;
}
