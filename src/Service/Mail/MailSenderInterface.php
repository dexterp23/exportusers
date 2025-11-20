<?php

namespace App\Service\Mail;

interface MailSenderInterface
{
    public function send(MailMessageInterface $message): void;
}
