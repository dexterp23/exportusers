<?php

namespace Dexlib\ExportUsers\Service\Mail;

interface MailSenderInterface
{
    public function send(MailMessageInterface $message): void;
}
