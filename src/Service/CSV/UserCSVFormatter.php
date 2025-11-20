<?php

namespace App\Service\CSV;

use Users\Entity\User;

class UserCSVFormatter implements UserCSVFormatterInterface
{
    public function format(User $user): array
    {
        return [
            $user->getOldUsername(),
            $user->getFirstName(),
            $user->getLastName(),
            $user->getEmail(),
            $this->formatRoles($user),
        ];
    }

    private function formatRoles(User $user): string
    {
        $roles = $user->getRolesNames();

        if (empty($roles)) {
            return '';
        }

        return implode(PHP_EOL, $roles);
    }
}
