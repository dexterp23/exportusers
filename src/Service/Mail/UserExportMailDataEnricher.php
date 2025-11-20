<?php

namespace App\Service\Mail;

class UserExportMailDataEnricher implements MailDataEnricherInterface
{
    private RoleNameResolver $roleNameResolver;

    public function __construct(RoleNameResolver $roleNameResolver)
    {
        $this->roleNameResolver = $roleNameResolver;
    }

    public function enrich(array $mailData): array
    {
        if (empty($mailData['role'])) {
            return $mailData;
        }

        $mailData['role'] = $this->roleNameResolver->resolveRoleNames($mailData['role']);

        return $mailData;
    }
}
