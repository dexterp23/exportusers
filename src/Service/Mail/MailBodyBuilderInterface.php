<?php

namespace App\Service\Mail;

interface MailBodyBuilderInterface
{
    public function build(array $mailData, string $templateType): string;
}
