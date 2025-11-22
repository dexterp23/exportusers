<?php

namespace Dexlib\ExportUsers\Service\CSV;

use Users\Entity\User;

interface UserCSVFormatterInterface
{
    public function format(array $user): array;
}
