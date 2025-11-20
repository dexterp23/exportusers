<?php

namespace Dexlib\Service\Export;

class ExportUsers
{
    protected array $data;
    
    public function getData(): array
    {
        return $this->data;
    }

    public function setData(array $data): self
    {
        $this->data = $data;
        return $this;
    }

    private function validate(): void
    {
        if (empty($this->data)) {
            throw new \InvalidArgumentException('Data cannot be empty');
        }
    }
}