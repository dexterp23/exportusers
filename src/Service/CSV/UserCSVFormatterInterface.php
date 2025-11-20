<?php

namespace App\Service\CSV;

use Users\Entity\User;

interface UserCSVFormatterInterface
{
    public function format(User $user): array;
}
