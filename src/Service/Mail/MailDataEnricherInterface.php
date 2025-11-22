<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailDataEnricherInterface
{
    public function enrich(array $mailData): array;
}
