<?php

namespace App\Utils;

interface FilenameGeneratorInterface
{
    public function generate(string $prefix, string $extension): string;
}