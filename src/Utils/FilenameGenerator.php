<?php

namespace App\Utils;

class FilenameGenerator implements FilenameGeneratorInterface
{
    private string $dateFormat;

    public function __construct()
    {
        $this->setDateformat();
    }

    public function setDateformat(string $dateFormat = 'Y-m-d'): self
    {
        $this->dateFormat = $dateFormat;
        return $this;
    }

    public function generate(string $prefix, string $extension): string
    {
        $date = date($this->dateFormat);
        return sprintf('%s_%s.%s', $prefix, $date, $extension);
    }
}
