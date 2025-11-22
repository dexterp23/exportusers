<?php

namespace Dexlib\ExportUsers\Service\Mail;

class MailDataEnricher implements MailDataEnricherInterface
{

    public function enrich(array $mailData): array
    {
        return $mailData;
    }
}
