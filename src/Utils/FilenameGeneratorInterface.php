<?php

namespace Dexlib\ExportUsers\Utils;

interface FilenameGeneratorInterface
{
    public function generate(string $prefix, string $extension): string;
}
