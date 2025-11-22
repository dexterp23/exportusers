<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailBodyBuilderInterface
{
    public function build(array $mailData, string $templateType): string;
}
