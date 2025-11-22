<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface RoleNameResolverInterface
{
    public function resolveRoleNames(string $roleIds): string;
}
