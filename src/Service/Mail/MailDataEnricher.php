<?php

namespace App\Service\Mail;

class MailDataEnricher implements MailDataEnricherInterface
{

    public function enrich(array $mailData): array
    {
        return $mailData;
    }
}
