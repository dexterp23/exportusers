<?php

namespace App\Service\Mail;

interface MailDataEnricherInterface
{
    public function enrich(array $mailData): array;
}
