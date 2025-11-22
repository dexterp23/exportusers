<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface EmailTemplatesInterface
{
    public function getMailTemplate(string $key): string;
    public function getMailSubject(string $key): string;
}
