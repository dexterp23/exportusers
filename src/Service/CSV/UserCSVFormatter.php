<?php

namespace Dexlib\ExportUsers\Service\CSV;

use Users\Entity\User;

class UserCSVFormatter implements UserCSVFormatterInterface
{
    public function format(array $user): array
    {
        return array_values($user);
    }
}
