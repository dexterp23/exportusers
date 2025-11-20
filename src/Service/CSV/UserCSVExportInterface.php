<?php

namespace App\Service\CSV;

interface UserCSVExportInterface
{
    public function add(array $users, array $header): void;
    public function export(): string;
}
