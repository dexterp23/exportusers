<?php

namespace Dexlib\ExportUsers\Service\Export;

interface ExportUsersServiceInterface
{
    public function start(): void;
    public function getData(): array;
    public function setData(array $data): self;
}
