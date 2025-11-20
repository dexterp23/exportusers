<?php

namespace App\Service\Mail;

interface MailRendererInterface
{
    public function render(string $templateName, array $data): string;
}
