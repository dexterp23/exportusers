<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailRendererInterface
{
    public function render(string $templateName, array $data): string;
}
